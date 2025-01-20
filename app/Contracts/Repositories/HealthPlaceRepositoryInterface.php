<?php

namespace App\Contracts\Repositories;

use App\DTOs\HealthPlace\HealthPlaceDTO;
use Illuminate\Support\Collection;

interface HealthPlaceRepositoryInterface
{
    public function findByPlaceId(string $placeId): ?HealthPlaceDTO;
    public function upsert(HealthPlaceDTO $dto): void;
    public function needsUpdate(?HealthPlaceDTO $dto): bool;
    public function getByPlaceIds(array $placeIds): Collection;
}
