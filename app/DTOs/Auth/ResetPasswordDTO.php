<?php

namespace App\DTOs\Auth;

class ResetPasswordDTO
{
    public function __construct(
        public readonly string $token,
        public readonly string $email,
        public readonly string $password,
        public readonly string $password_confirmation
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            token: $data['token'],
            email: $data['email'],
            password: $data['password'],
            password_confirmation: $data['password_confirmation']
        );
    }
}
