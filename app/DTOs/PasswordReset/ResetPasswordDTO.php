<?php

namespace App\DTOs\PasswordReset;

use Spatie\LaravelData\Data;

class ResetPasswordDTO extends Data
{
    public function __construct(
        public string $identifier,
        public string $type,
        public string $token,
        public string $password,
        public string $password_confirmation
    ) {}

    public static function rules(): array
    {
        return [
            'identifier' => ['required', 'string'],
            'type' => ['required', 'in:email,phone'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
        ];
    }
}
