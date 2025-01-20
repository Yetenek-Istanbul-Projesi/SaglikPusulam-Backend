<?php

namespace App\DTOs\HealthPlace;

use Carbon\Carbon;

class HealthPlaceDTO
{
    public function __construct(
        public readonly string $googlePlaceId,
        public readonly array $placeData,
        public readonly ?Carbon $lastUpdated = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            googlePlaceId: $data['google_place_id'],
            placeData: is_string($data['place_data']) ? json_decode($data['place_data'], true) : $data['place_data'],
            lastUpdated: isset($data['last_updated']) ? Carbon::parse($data['last_updated']) : null
        );
    }
}
