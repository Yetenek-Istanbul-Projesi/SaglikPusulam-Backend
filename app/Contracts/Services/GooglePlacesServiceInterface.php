<?php

namespace App\Contracts\Services;

use App\DTOs\Google\PlaceSearchDTO;
use App\DTOs\Google\PlaceDetailsDTO;
use App\DTOs\Google\HealthSearchCriteriaDTO;
use Illuminate\Support\Collection;

interface GooglePlacesServiceInterface
{
    /**
     * Sağlık tesislerini arar
     */
    public function searchHealthFacilities(HealthSearchCriteriaDTO $criteria): Collection;

    /**
     * Place detaylarını getirir
     */
    public function getPlaceDetails(string $placeId): PlaceDetailsDTO;

    /**
     * Fotoğraf URL'ini getirir
     */
    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string;
}
