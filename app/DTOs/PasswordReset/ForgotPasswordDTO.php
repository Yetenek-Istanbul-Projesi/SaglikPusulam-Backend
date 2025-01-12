<?php

namespace App\DTOs\PasswordReset;

use Spatie\LaravelData\Data;

class ForgotPasswordDTO extends Data
{
    public function __construct(
        public string $identifier, // email or phone
        public string $type // 'email' or 'phone'
    ) {}

    public static function rules(): array
    {
        return [
            'identifier' => ['required', 'string'],
            'type' => ['required', 'in:email,phone'],
        ];
    }
}
