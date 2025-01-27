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
    public function searchHealthFacilities(HealthSearchCriteriaDTO $criteria, ?string $pageToken = null): array;

    /**
     * Place detaylarını getirir
     */
    public function getPlaceDetails(string $placeId): array;

    /**
     * Fotoğraf URL'ini getirir
     */
    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string;

    /**
     * İl ve ilçe bilgisine göre koordinatları getirir
     */
    public function getCoordinates(string $province, ?string $district = null): array;

    public function fetchPhoto(string $photoReference, int $maxWidth = 400): string;

}
