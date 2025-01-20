<?php

namespace App\Services\Google;

use App\DTOs\Google\HealthSearchCriteriaDTO;
use App\Contracts\Repositories\GooglePlacesRepositoryInterface;
use App\Contracts\Services\GooglePlacesServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GooglePlacesServiceV2 implements GooglePlacesServiceInterface
{
    private const PHOTO_CACHE_TTL = 3600; // 1 saat

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
        $cacheKey = sprintf('photo_url:%s:%d', $photoReference, $maxWidth);
        
        return Cache::remember(
            $cacheKey,
            self::PHOTO_CACHE_TTL,
            fn() => $this->repository->getPhotoUrl($photoReference, $maxWidth)
        );
    }

    public function fetchPhoto(string $photoReference, int $maxWidth = 400): string
    {
        return $this->repository->fetchPhoto($photoReference, $maxWidth);
    }

    public function getCoordinates(string $province, ?string $district = null): array
    {
        return $this->repository->getCoordinates($province, $district);
    }
}
