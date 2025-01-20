<?php

namespace App\Repositories;

use App\Models\HealthPlace;
use App\DTOs\HealthPlace\HealthPlaceDTO;
use App\Contracts\Repositories\HealthPlaceRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class HealthPlaceRepository implements HealthPlaceRepositoryInterface
{
    private const CACHE_TTL = 43200; // 12 saat

    public function findByPlaceId(string $placeId): ?HealthPlace
    {
        return Cache::remember(
            "place_{$placeId}", 
            self::CACHE_TTL, 
            fn () => HealthPlace::where('google_place_id', $placeId)->first()
        );
    }

    public function findByPlaceIdDTO(string $placeId): ?HealthPlaceDTO
    {
        $place = $this->findByPlaceId($placeId);
        
        if (!$place) {
            return null;
        }

        return HealthPlaceDTO::fromArray([
            'google_place_id' => $place->google_place_id,
            'place_data' => $place->place_data,
            'last_updated' => $place->last_updated
        ]);
    }

    public function updateOrCreate(array $attributes, array $values = []): HealthPlace
    {
        $place = HealthPlace::updateOrCreate(
            ['google_place_id' => $attributes['google_place_id']],
            [
                'place_data' => $values['place_data'],
                'last_updated' => now()
            ]
        );

        // Cache'i temizle
        Cache::forget("place_{$attributes['google_place_id']}");
        
        return $place;
    }

    public function upsert(HealthPlaceDTO $dto): void
    {
        HealthPlace::updateOrCreate(
            ['google_place_id' => $dto->googlePlaceId],
            [
                'place_data' => $dto->placeData,
                'last_updated' => $dto->lastUpdated ?? now()
            ]
        );

        // Cache'i temizle
        Cache::forget("place_{$dto->googlePlaceId}");
    }

    public function needsUpdate(?HealthPlaceDTO $dto): bool
    {
        if (!$dto || !$dto->lastUpdated) {
            return true;
        }

        return $dto->lastUpdated->addSeconds(self::CACHE_TTL)->isPast();
    }

    public function getByPlaceIds(array $placeIds): Collection
    {
        return collect($placeIds)->map(function ($placeId) {
            return Cache::remember(
                "place_{$placeId}", 
                self::CACHE_TTL,
                function () use ($placeId) {
                    $place = HealthPlace::where('google_place_id', $placeId)->first();
                    if (!$place) return null;
                    
                    return HealthPlaceDTO::fromArray([
                        'google_place_id' => $place->google_place_id,
                        'place_data' => $place->place_data,
                        'last_updated' => $place->last_updated
                    ]);
                }
            );
        })->filter();
    }
}
