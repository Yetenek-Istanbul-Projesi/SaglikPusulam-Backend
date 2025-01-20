<?php

namespace App\Contracts\Services;

interface HealthDetailsServiceInterface
{
    /**
     * Veritabanından sağlık hizmeti detaylarını getirir
     *
     * @param string $placeId Google Place ID
     * @return array Hizmet detayları ve fotoğraf URL'leri
     * @throws \RuntimeException Hizmet bulunamadığında
     */
    public function findPlaceDetails(string $placeId): array;

    /**
     * En çok favoriye alınan ilk 5 sağlık hizmetini getir
     */
    public function getMostFavoritedPlaces(): array;
}
