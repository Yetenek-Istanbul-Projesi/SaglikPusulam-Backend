<?php

namespace App\Contracts\Repositories;

interface GooglePlacesRepositoryInterface
{
    public function searchPlaces(string $query, ?string $pageToken = null): array;
    public function getPlaceDetails(string $placeId): array;
    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string;
    public function getCoordinates(string $province, ?string $district = null): array;
    public function fetchPhoto(string $photoReference, int $maxWidth = 400): string;
}
