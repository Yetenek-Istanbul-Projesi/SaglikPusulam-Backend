<?php

namespace App\DTOs\Health;

class HealthFilterDTO
{
    public function __construct(
        public readonly ?float $rating = null,
        public readonly ?int $distance = null,
        public readonly ?bool $isOpen = null,
        public readonly ?array $services = null
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            rating: $request->rating,
            distance: $request->distance,
            isOpen: $request->is_open,
            services: $request->services
        );
    }
}
