<?php

namespace App\DTOs\User\Profile;

use Illuminate\Support\Facades\Log;

class UpdateProfileDTO
{
    public function __construct(
        public readonly ?string $first_name,
        public readonly ?string $last_name,
        public readonly ?string $email,
        public readonly ?string $phone,
        public readonly ?string $address,
        public readonly mixed $photo
    ) {}

    public static function fromRequest(array $data): self
    {
        Log::info('Creating DTO from data:', $data);
        
        return new self(
            first_name: $data['first_name'] ?? null,
            last_name: $data['last_name'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null,
            address: $data['address'] ?? null,
            photo: $data['profile_photo'] ?? null
        );
    }
}
