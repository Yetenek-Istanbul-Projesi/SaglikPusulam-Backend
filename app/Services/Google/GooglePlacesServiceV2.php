<?php

namespace App\Services\Google;

use App\DTOs\Google\HealthSearchCriteriaDTO;
use App\Contracts\Repositories\GooglePlacesRepositoryInterface;
use App\Contracts\Services\GooglePlacesServiceInterface;
use Illuminate\Support\Collection;

class GooglePlacesServiceV2 implements GooglePlacesServiceInterface
{
    private GooglePlacesRepositoryInterface $repository;

    public function __construct(GooglePlacesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function searchHealthFacilities(HealthSearchCriteriaDTO $criteria, ?string $pageToken = null): array
    {
        $searchQuery = $criteria->toSearchQuery();
        $response = $this->repository->searchPlaces($searchQuery, $pageToken);

        return [
            'places' => $response['places'] ?? [],
            'nextPageToken' => $response['nextPageToken'] ?? null
        ];
    }

    public function getPlaceDetails(string $placeId): array
    {
        return $this->repository->getPlaceDetails($placeId);
    }

    public function getPhotoUrl(string $photoReference, int $maxWidth = 400): string
    {
        return $this->repository->getPhotoUrl($photoReference, $maxWidth);
    }
}