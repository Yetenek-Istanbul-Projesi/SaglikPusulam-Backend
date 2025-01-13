<?php

namespace App\DTOs\Google;

class PlaceDetailsDTO
{
    public function __construct(
        public string $placeId,
        public string $name,
        public string $address,
        public float $latitude,
        public float $longitude,
        public float $rating,
        public int $userRatingsTotal,
        public ?string $phoneNumber,
        public ?string $website,
        public ?string $placeUrl,
        public ?bool $isOpenNow,
        public array $openingHours,
        public array $photoReferences,
        public array $reviews,
        public string $facilityType,
        public ?string $description
    ) {}
}
