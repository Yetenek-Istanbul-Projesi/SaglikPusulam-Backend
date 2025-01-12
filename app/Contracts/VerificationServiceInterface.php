<?php

namespace App\Contracts;

use App\DTOs\User\VerificationResponseDTO;
use App\Models\PendingUser;
use App\Models\User;

interface VerificationServiceInterface
{
    /**
     * Generates a verification code
     */
    public function generateVerificationCode(): string;

    /**
     * Sends verification code via email
     */
    public function sendEmailVerification(string $email): VerificationResponseDTO;

    /**
     * Sends verification code via SMS
     */
    public function sendPhoneVerification(string $phone): VerificationResponseDTO;

    /**
     * Verifies email with given code
     */
    public function verifyEmail(string $email, string $code): bool;

    /**
     * Verifies phone with given code
     */
    public function verifyPhone(string $phone, string $code): bool;

    /**
     * Creates a pending user record
     */
    public function storePendingUser(array $userData): PendingUser;

    /**
     * Creates verified user from pending user
     */
    public function verifyAndCreateUser(string $verificationToken): ?User;
}
