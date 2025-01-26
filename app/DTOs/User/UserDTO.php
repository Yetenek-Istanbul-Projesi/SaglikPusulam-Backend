<?php

namespace App\DTOs\User;


class UserDTO
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $phone,
        public readonly ?string $password = null,
        public readonly ?bool $terms_accepted = null,
        public readonly ?bool $privacy_accepted = null,
        public readonly ?string $email_verified_at = null,
        public readonly ?string $phone_verified_at = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            email: $data['email'],
            phone: $data['phone'],
            password: $data['password'] ?? null,
            terms_accepted: $data['terms_accepted'] ?? null,
            privacy_accepted: $data['privacy_accepted'] ?? null,
            email_verified_at: $data['email_verified_at'] ?? null,
            phone_verified_at: $data['phone_verified_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'terms_accepted' => $this->terms_accepted,
            'privacy_accepted' => $this->privacy_accepted,
            'email_verified_at' => $this->email_verified_at,
            'phone_verified_at' => $this->phone_verified_at,
        ], fn($value) => !is_null($value));
    }
}
