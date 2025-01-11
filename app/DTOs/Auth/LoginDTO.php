<?php

namespace App\DTOs\Auth;

class LoginDTO
{
    // Burada kullanıcıdan gelen verileri belirtiyoruz
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {
    }
    // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
    public static function fromRequest(array $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password']
        );
    }
}
