<?php

namespace App\DTOs;

/** Bu DTO ile onay sırasında başarılı / başarısız olma durumu belirtiliyor */
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

    public static function failure(string $message, string $error): self
    {
        return new self(
            success: false,
            message: $message,
            error: $error
        );
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
            'error' => $this->error,
        ];
    }
}
