<?php

namespace App\Contracts;

use App\DTOs\Auth\RegisterDTO;
use App\DTOs\Auth\LoginDTO;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * Registers a new user
     * @return array Array containing verification token and status messages
     */
    public function register(RegisterDTO $registerDTO): array;

    /**
     * Logs in a user
     * @return array Array containing user data and JWT token
     */
    public function login(LoginDTO $loginDTO): array;

    /**
     * Verifies user registration
     * @return User|null The created user or null if verification fails
     */
    public function verifyRegistration(string $verificationToken, string $emailCode, string $phoneCode): ?User;
}
