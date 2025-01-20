<?php

namespace App\Contracts\Repositories;

use App\Models\HealthPlace;
use App\DTOs\HealthPlace\HealthPlaceDTO;
use Illuminate\Support\Collection;

interface HealthPlaceRepositoryInterface
{
    /**
     * Find a place by its Google Place ID and return model
     */
    public function findByPlaceId(string $placeId): ?HealthPlace;

    /**
     * Find a place by its Google Place ID and return DTO
     */
    public function findByPlaceIdDTO(string $placeId): ?HealthPlaceDTO;

    /**
     * Create or update a place
     */
    public function updateOrCreate(array $attributes, array $values = []): HealthPlace;

    /**
     * Create or update a place using DTO
     */
    public function upsert(HealthPlaceDTO $dto): void;

    /**
     * Check if place needs update
     */
    public function needsUpdate(?HealthPlaceDTO $dto): bool;

    /**
     * Get multiple places by their IDs
     */
    public function getByPlaceIds(array $placeIds): Collection;

    public function getMostFavoritedPlaces(int $limit = 5): Collection;

    /**
     * Delete place if it's not in favorites or comparisons
     */
    public function deleteIfUnused(string $placeId): void;
}
