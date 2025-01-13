<?php

namespace App\Services\Google;

use App\Contracts\Services\GooglePlacesServiceInterface;
use App\DTOs\Google\PlaceSearchDTO;
use App\DTOs\Google\PlaceDetailsDTO;
use App\DTOs\Google\HealthSearchCriteriaDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GooglePlacesServiceV2 implements GooglePlacesServiceInterface
{
    private string $apiKey;
    private const CACHE_TTL = 3600; // 1 hour

    public function __construct()
    {
        $this->apiKey = config('services.google.places_api_key');
    }

    public function searchHealthFacilities(HealthSearchCriteriaDTO $criteria): Collection
    {
        $cacheKey = "places_search:" . md5(json_encode($criteria));
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($criteria) {
            // 1. Önce lokasyonu bul
            $geocodeResponse = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $criteria->district 
                    ? "{$criteria->district}, {$criteria->province}, Türkiye" 
                    : "{$criteria->province}, Türkiye",
                'language' => 'tr',
                'key' => $this->apiKey
            ]);

            if (!$geocodeResponse->successful()) {
                throw new \Exception('Konum bulunamadı');
            }

            $location = $geocodeResponse->json('results.0.geometry.location');
            if (!$location) {
                throw new \Exception('Konum bulunamadı');
            }

            // 2. Text Search API ile arama yap
            $searchTypes = [];
            if ($criteria->facilityType) {
                $searchTypes[] = match($criteria->facilityType) {
                    'hospital' => 'hastane',
                    'clinic' => 'sağlık merkezi OR tıp merkezi OR klinik OR poliklinik',
                    'doctor' => 'doktor OR uzman hekim',
                    default => null
                };
            } else {
                $searchTypes = ['hastane', 'sağlık merkezi', 'tıp merkezi', 'klinik', 'poliklinik', 'doktor'];
            }

            $allResults = collect();

            foreach ($searchTypes as $type) {
                $query = $type;
                if ($criteria->specialization) {
                    $query .= ' ' . $criteria->specialization;
                }
                $query .= ' ' . ($criteria->district ?? $criteria->province);

                $response = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
                    'query' => $query,
                    'location' => "{$location['lat']},{$location['lng']}",
                    'radius' => '10000', // 10 km
                    'language' => 'tr',
                    'key' => $this->apiKey
                ]);

                if ($response->successful()) {
                    $results = collect($response->json('results'))->filter(function ($place) {
                        return collect($place['types'])->intersect([
                            'hospital',
                            'doctor',
                            'health',
                            'dentist',
                            'physiotherapist',
                            'medical_office'
                        ])->isNotEmpty();
                    });

                    $allResults = $allResults->concat($results);
                }
            }

            // Tekrarlanan sonuçları kaldır
            $allResults = $allResults->unique('place_id');

            // Her sonuç için detaylı bilgileri al
            return $allResults->map(function ($place) {
                try {
                    $details = $this->getPlaceDetails($place['place_id']);
                    
                    return new PlaceSearchDTO(
                        placeId: $place['place_id'],
                        name: $place['name'],
                        address: $place['formatted_address'],
                        latitude: $place['geometry']['location']['lat'],
                        longitude: $place['geometry']['location']['lng'],
                        rating: $place['rating'] ?? 0,
                        userRatingsTotal: $place['user_ratings_total'] ?? 0,
                        isOpenNow: $details->isOpenNow,
                        photoReferences: $details->photoReferences,
                        facilityType: $this->determineFacilityType($place),
                        description: $details->description,
                        phoneNumber: $details->phoneNumber,
                        website: $details->website,
                        placeUrl: $details->placeUrl,
                        openingHours: $details->openingHours
                    );
                } catch (\Exception $e) {
                    Log::error('Place details error:', [
                        'place_id' => $place['place_id'],
                        'error' => $e->getMessage()
                    ]);
                    return null;
                }
            })->filter()->values(); // null değerleri kaldır
        });
    }

    public function getPlaceDetails(string $placeId): PlaceDetailsDTO
    {
        $cacheKey = "place_details:{$placeId}";
        
        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($placeId) {
            $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', [
                'place_id' => $placeId,
                'fields' => implode(',', [
                    'name',
                    'formatted_address',
                    'geometry/location',
                    'formatted_phone_number',
                    'international_phone_number',
                    'website',
                    'url',
                    'rating',
                    'user_ratings_total',
                    'editorial_summary/overview',
                    'opening_hours',
                    'photos',
                    'types'
                ]),
                'language' => 'tr',
                'key' => $this->apiKey
            ]);

            if (!$response->successful()) {
                throw new \Exception('Yer detayları alınamadı');
            }

            $place = $response->json('result');
            if (empty($place)) {
                throw new \Exception('Yer bulunamadı');
            }

            return new PlaceDetailsDTO(
                placeId: $placeId,
                name: $place['name'],
                address: $place['formatted_address'],
                latitude: $place['geometry']['location']['lat'],
                longitude: $place['geometry']['location']['lng'],
                rating: $place['rating'] ?? 0,
                userRatingsTotal: $place['user_ratings_total'] ?? 0,
                phoneNumber: $place['formatted_phone_number'] ?? $place['international_phone_number'] ?? null,
                website: $place['website'] ?? null,
                placeUrl: $place['url'] ?? null,
                isOpenNow: $place['opening_hours']['open_now'] ?? null,
                openingHours: $place['opening_hours']['weekday_text'] ?? [],
                photoReferences: collect($place['photos'] ?? [])->pluck('photo_reference')->toArray(),
                reviews: [],
                facilityType: $this->determineFacilityType($place),
                description: $place['editorial_summary']['overview'] ?? null
            );
        });
    }

    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string
    {
        return "https://maps.googleapis.com/maps/api/place/photo?" . http_build_query([
            'maxwidth' => $maxWidth,
            'photo_reference' => $photoReference,
            'key' => $this->apiKey
        ]);
    }

    private function determineFacilityType(array $place): string
    {
        $types = collect($place['types']);

        if ($types->contains('hospital')) {
            return 'hospital';
        }

        if ($types->contains('doctor')) {
            return 'doctor';
        }

        if ($types->intersect(['health', 'dentist', 'physiotherapist', 'medical_office'])->isNotEmpty()) {
            return 'clinic';
        }

        return 'health'; // default type
    }
}
