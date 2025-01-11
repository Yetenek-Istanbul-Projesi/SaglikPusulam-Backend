<?php

namespace App\DTOs;

class UserDTO
{
    // Burada kullanıcıdan gelen verileri belirtiyoruz
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $password,
        public readonly bool $terms_accepted,
        public readonly bool $privacy_accepted
    ) {}

    // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
    public static function fromRequest(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            email: $data['email'],
            phone: $data['phone'],
            password: $data['password'],
            terms_accepted: $data['terms_accepted'],
            privacy_accepted: $data['privacy_accepted']
        );
    }
}
