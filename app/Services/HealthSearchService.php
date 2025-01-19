<?php

namespace App\Services;

use App\Contracts\Services\GooglePlacesServiceInterface;
use App\DTOs\Google\HealthSearchCriteriaDTO;
use App\DTOs\Health\HealthFilterDTO;
use Illuminate\Support\Facades\Cache;

class HealthSearchService
{
    private const PAGE_SIZE = 5;

    public function __construct(
        private readonly GooglePlacesServiceInterface $googlePlacesService
    ) {}

    public function searchResults(HealthSearchCriteriaDTO $criteriaDTO)
    {
        $cacheKey = sprintf(
            'health_search:%s:%s:%s:%s',
            $criteriaDTO->province,
            $criteriaDTO->district ?? 'all',
            $criteriaDTO->facilityType ?? 'all',
            $criteriaDTO->specialization ?? 'all'
        );

        $results = Cache::remember(
            $cacheKey,
            now()->addHours(1),
            fn() => $this->fetchAndEnrichResults($criteriaDTO)
        );

        // Tüm sonuçları ve sayfa numarasını cache'le
        Cache::put('last_search_results', $results, now()->addHours(1));
        Cache::put('current_page', 0, now()->addHours(1));
        
        return $this->getPageResults($results);
    }

    public function getNextPage(): array
    {
        $results = Cache::get('last_search_results');
        if (!$results) {
            throw new \RuntimeException('Önce arama yapmalısınız.');
        }

        $currentPage = Cache::get('current_page', 0);
        $totalResults = count($results['results']);
        
        // Eğer sonraki sayfa için yeterli sonuç yoksa current_page'i artırma
        if (($currentPage + 1) * self::PAGE_SIZE >= $totalResults) {
            return [
                'results' => [],
                'total' => $totalResults,
                'meta' => [
                    'has_more' => false,
                    'current_page' => $currentPage
                ]
            ];
        }

        $currentPage++;
        Cache::put('current_page', $currentPage, now()->addHours(1));

        return $this->getPageResults($results);
    }

    private function getPageResults(array $results): array
    {
        $currentPage = Cache::get('current_page', 0);
        $start = $currentPage * self::PAGE_SIZE;
        $totalResults = count($results['results']);
        
        if ($start >= $totalResults) {
            return [
                'results' => [],
                'total' => $totalResults,
                'meta' => [
                    'has_more' => false,
                    'current_page' => $currentPage
                ]
            ];
        }

        $pageResults = array_slice($results['results'], $start, self::PAGE_SIZE);
        $hasMore = ($start + self::PAGE_SIZE) < $totalResults;

        return [
            'results' => $pageResults,
            'total' => $totalResults,
            'meta' => [
                'has_more' => $hasMore,
                'current_page' => $currentPage
            ]
        ];
    }

    public function filterResults(HealthFilterDTO $filterDTO)
    {
        $lastSearchResults = Cache::get('last_search_results');

        if (!$lastSearchResults) {
            throw new \RuntimeException('Önce arama yapmalısınız.');
        }

        return $this->applyFilters($lastSearchResults, $filterDTO);
    }

    private function fetchAndEnrichResults(HealthSearchCriteriaDTO $criteriaDTO): array
    {
        // Merkez noktasını belirle ve cache'le
        $centerLocation = $this->getCenterLocation($criteriaDTO->province, $criteriaDTO->district);
        Cache::put('search_center_location', $centerLocation, now()->addHours(1));

        $results = $this->googlePlacesService->searchHealthFacilities($criteriaDTO);
        $enrichedResults = $this->enrichWithPhotos($results['places'] ?? []);

        Cache::put('last_search_results', [
            'places' => $enrichedResults,
            'meta' => [
                'center_location' => $centerLocation
            ]
        ], now()->addHours(1));

        return [
            'results' => $enrichedResults,
            'total' => count($enrichedResults),
            'meta' => [
                'search_criteria' => [
                    'province' => $criteriaDTO->province,
                    'district' => $criteriaDTO->district,
                    'facilityType' => $criteriaDTO->facilityType,
                    'specialization' => $criteriaDTO->specialization
                ],
                'center_location' => $centerLocation,
                'timestamp' => now()
            ]
        ];
    }

    private function enrichWithPhotos(array $results): array
    {
        return array_map(function ($result) {
            $photoReference = $result['photos'][0]['name'] ?? null;
            return array_merge($result, [
                'main_photo_url' => $photoReference
                    ? $this->googlePlacesService->getPhotoUrl($photoReference)
                    : null
            ]);
        }, $results);
    }

    private function applyFilters(array $results, HealthFilterDTO $filterDTO): array
    {
        $filteredResults = $results['places'] ?? [];
        $centerLocation = $results['meta']['center_location'] ?? null;

        // Rating (Puan) filtresi (1-5)
        if ($filterDTO->rating) {
            $filteredResults = array_filter(
                $filteredResults,
                fn($item) => ($item['rating'] ?? 0) >= $filterDTO->rating
            );
        }

        // Mesafe filtresi (1km-10km)
        if ($filterDTO->distance && $centerLocation) {
            $filteredResults = array_filter($filteredResults, function ($item) use ($filterDTO, $centerLocation) {
                // Lokasyon bilgilerini al
                $facilityLocation = [
                    'lat' => $item['location']['latitude'] ?? 0,
                    'lng' => $item['location']['longitude'] ?? 0
                ];

                // İki nokta arasındaki mesafeyi hesapla
                $distance = $this->calculateDistance($facilityLocation, $centerLocation);

                return $distance <= $filterDTO->distance;
            });
        }

        // Açık/Kapalı durumu
        if ($filterDTO->isOpen) {
            $filteredResults = array_filter(
                $filteredResults,
                fn($item) => ($item['currentOpeningHours']['openNow'] ?? false) === true
            );
        }

        // Hizmet ismi filtresi
        if ($filterDTO->services) {
            $filteredResults = array_filter($filteredResults, function ($item) use ($filterDTO) {
                $serviceName = strtolower($item['displayName']['text'] ?? '');
                foreach ($filterDTO->services as $service) {
                    if (str_contains($serviceName, strtolower($service))) {
                        return true;
                    }
                }
                return false;
            });
        }

        $filteredResults = array_values($filteredResults);

        return [
            'results' => $filteredResults,
            'total' => count($filteredResults),
            'meta' => [
                'filters_applied' => [
                    'rating' => $filterDTO->rating,
                    'distance' => $filterDTO->distance,
                    'is_open' => $filterDTO->isOpen,
                    'services' => $filterDTO->services
                ],
                'center_location' => $centerLocation
            ]
        ];
    }

    private function calculateDistance(array $location1, array $location2): float
    {
        $earthRadius = 6371; // Dünya yarıçapı (km)

        $lat1 = deg2rad($location1['lat']);
        $lng1 = deg2rad($location1['lng']);
        $lat2 = deg2rad($location2['lat']);
        $lng2 = deg2rad($location2['lng']);

        $latDelta = $lat2 - $lat1;
        $lngDelta = $lng2 - $lng1;

        $angle = 2 * asin(sqrt(
            pow(sin($latDelta / 2), 2) +
                cos($lat1) * cos($lat2) * pow(sin($lngDelta / 2), 2)
        ));

        return $angle * $earthRadius;
    }

    private function getCenterLocation(string $province, ?string $district = null): array
    {
        return $this->googlePlacesService->getCoordinates($province, $district);
    }

    public function findPlaceInResults(string $placeId): array
    {
        $lastSearchResults = Cache::get('last_search_results');

        if (!$lastSearchResults) {
            throw new \RuntimeException('Önce arama yapmalısınız.');
        }

        $place = collect($lastSearchResults['places'])->firstWhere('id', $placeId);

        if (!$place) {
            throw new \RuntimeException('Belirtilen yer bulunamadı.');
        }

        // Tüm fotoğrafları işle
        $photoUrls = [];
        if (isset($place['photos']) && is_array($place['photos'])) {
            // İlk fotoğraf yerine diğer 4 fotoğrafı al
            $photos = array_slice($place['photos'], 1, 5);
            foreach ($photos as $photo) {
                if (isset($photo['name'])) {
                    $photoUrls[] = $this->googlePlacesService->getPhotoUrl($photo['name']);
                }
            }
        }

        // Ana veriyi fotoğraf URL'leri ile birleştir
        return array_merge($place, [
            'photo_urls' => $photoUrls,
            // 'main_photo_url' => $photoUrls[0] ?? null
        ]);
    }
}
