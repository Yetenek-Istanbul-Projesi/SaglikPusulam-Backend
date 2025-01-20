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
}
