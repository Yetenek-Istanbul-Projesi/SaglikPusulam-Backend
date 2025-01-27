<?php

namespace App\DTOs\Profile;

class UserListDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly string $googlePlaceId
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            userId: $data['user_id'],
            googlePlaceId: $data['google_place_id']
        );
    }
}
