<?php

namespace App\DTOs\Service;

class ServiceDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly bool $is_active,
        public readonly string $type,
        public readonly ?string $phone,
        public readonly ?string $website,
        public readonly ?array $working_hours,
        public readonly string $address,
        public readonly ?float $latitude,
        public readonly ?float $longitude,
        public readonly ?string $contact_info,
        public readonly ?array $photos
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'],
            is_active: $data['is_active'] ?? true,
            type: $data['type'],
            phone: $data['phone'] ?? null,
            website: $data['website'] ?? null,
            working_hours: $data['working_hours'] ?? null,
            address: $data['address'],
            latitude: $data['latitude'] ?? null,
            longitude: $data['longitude'] ?? null,
            contact_info: $data['contact_info'] ?? null,
            photos: $data['photos'] ?? []
        );
    }
}
