<?php

namespace App\Contracts;

use App\DTOs\VerificationResponseDTO;

interface VerificationServiceInterface
{
    // Burada yeni bir repo arayüzü oluşturup mail - telefon onayı için gerekli metodları ekliyoruz
    public function sendEmailVerification(string $email): VerificationResponseDTO;
    public function sendPhoneVerification(string $phone): VerificationResponseDTO;
    public function verifyEmail(string $email, string $token): VerificationResponseDTO;
    public function verifyPhone(string $phone, string $code): VerificationResponseDTO;
}
