<?php

namespace App\Repositories;

use App\Contracts\Repositories\HealthPlaceRepositoryInterface;
use App\DTOs\HealthPlace\HealthPlaceDTO;
use App\Models\HealthPlace;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HealthPlaceRepository implements HealthPlaceRepositoryInterface
{
    private const CACHE_TTL = 43200; // 12 saat

    public function findByPlaceId(string $placeId): ?HealthPlaceDTO
    {
        $place = HealthPlace::where('google_place_id', $placeId)->first();
        
        return $place ? HealthPlaceDTO::fromArray($place->toArray()) : null;
    }

    public function upsert(HealthPlaceDTO $dto): void
    {
        HealthPlace::updateOrCreate(
            ['google_place_id' => $dto->googlePlaceId],
            [
                'place_data' => $dto->placeData,
                'last_updated' => now()
            ]
        );
    }

    public function needsUpdate(?HealthPlaceDTO $dto): bool
    {
        if (!$dto) return true;
        return $dto->lastUpdated->diffInSeconds(now()) > self::CACHE_TTL;
    }

    public function getByPlaceIds(array $placeIds): Collection
    {
        return HealthPlace::whereIn('google_place_id', $placeIds)
            ->get()
            ->map(fn($place) => HealthPlaceDTO::fromArray($place->toArray()));
    }
}
