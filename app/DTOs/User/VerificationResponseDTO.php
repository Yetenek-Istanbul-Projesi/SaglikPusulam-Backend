<?php

namespace App\DTOs\User;

class VerificationResponseDTO
{
    public function __construct(
        public readonly bool $success,
        public readonly string $message,
        public readonly ?string $error = null
    ) {}

    public static function success(string $message): self
    {
        return new self(
            success: true,
            message: $message
        );
    }

    public static function error(string $message, string $error): self
    {
        return new self(
            success: false,
            message: $message,
            error: $error
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'success' => $this->success,
            'message' => $this->message,
            'error' => $this->error,
        ], fn($value) => !is_null($value));
    }
}
