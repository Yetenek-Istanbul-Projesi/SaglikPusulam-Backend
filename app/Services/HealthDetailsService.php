<?php

namespace App\Services;

use App\Contracts\Services\GooglePlacesServiceInterface;
use App\Contracts\Services\HealthDetailsServiceInterface;
use App\Contracts\Repositories\HealthPlaceRepositoryInterface;

class HealthDetailsService implements HealthDetailsServiceInterface
{
    public function __construct(
        private readonly GooglePlacesServiceInterface $googlePlacesService,
        private readonly HealthPlaceRepositoryInterface $healthPlaceRepository
    ) {}

    public function findPlaceDetails(string $placeId): array
    {
        $place = $this->healthPlaceRepository->findByPlaceId($placeId);

        if (!$place) {
            throw new \RuntimeException('Belirtilen hizmet bulunamadı.');
        }

        $placeData = $place->placeData;

        // Tüm fotoğrafları işle
        $photoUrls = [];
        if (isset($placeData['photos']) && is_array($placeData['photos'])) {
            // İlk fotoğraf yerine diğer 4 fotoğrafı al
            $photos = array_slice($placeData['photos'], 1, 4);
            foreach ($photos as $photo) {
                if (isset($photo['name'])) {
                    $photoUrls[] = $this->googlePlacesService->getPhotoUrl($photo['name']);
                }
            }
        }

        // Ana fotoğraf URL'sini ekle
        if (isset($placeData['photos'][0]['name'])) {
            $placeData['main_photo_url'] = $this->googlePlacesService->getPhotoUrl($placeData['photos'][0]['name']);
        }

        // Ana veriyi fotoğraf URL'leri ile birleştir
        return array_merge($placeData, [
            'photo_urls' => $photoUrls
        ]);
    }

    /**
     * En çok favoriye alınan ilk 5 sağlık hizmetini getir
     */
    public function getMostFavoritedPlaces(): array
    {
        $mostFavorited = $this->healthPlaceRepository->getMostFavoritedPlaces(5);
        
        return $mostFavorited->map(function ($place) {
            $placeData = $place->place_data;
            
            // Ana fotoğraf URL'sini ekle
            $mainPhotoUrl = null;
            if (isset($placeData['photos'][0]['name'])) {
                $mainPhotoUrl = $this->googlePlacesService->getPhotoUrl($placeData['photos'][0]['name']);
            }
            
            return [
                'id' => $place->id,
                'place_id' => $place->google_place_id,
                'name' => $placeData['displayName']['text'] ?? 'Bilinmeyen Yer',
                'address' => $placeData['formattedAddress'] ?? '',
                'rating' => $placeData['rating'] ?? 0,
                'favorite_count' => $place->favorite_count,
                'main_photo_url' => $mainPhotoUrl,
                'types' => $placeData['types'] ?? []
            ];
        })->toArray();
    }
}
