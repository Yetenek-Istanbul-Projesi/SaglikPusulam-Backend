<?php

namespace App\DTOs\Google;

use App\Enums\HealthFacilityType;

class PlaceSearchDTO
{
    public function __construct(
        public string $placeId,
        public string $name,
        public string $address,
        public float $latitude,
        public float $longitude,
        public float $rating,
        public int $userRatingsTotal,
        public ?bool $isOpenNow,
        public array $photoReferences,
        public string $facilityType,
        public ?string $description,
        public ?string $phoneNumber,
        public ?string $website,
        public ?string $placeUrl,
        public array $openingHours = []
    ) {}
}
