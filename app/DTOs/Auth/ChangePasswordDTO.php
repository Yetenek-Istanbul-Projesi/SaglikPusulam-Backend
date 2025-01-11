<?php

namespace App\DTOs\Auth;

class ChangePasswordDTO
{
    public function __construct(
        public readonly string $current_password,
        public readonly string $new_password,
        public readonly string $new_password_confirmation
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            current_password: $data['current_password'],
            new_password: $data['new_password'],
            new_password_confirmation: $data['new_password_confirmation']
        );
    }
}
