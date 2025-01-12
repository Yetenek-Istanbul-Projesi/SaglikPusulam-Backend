<?php

namespace App\Contracts;

use App\DTOs\Auth\RegisterDTO;
use App\DTOs\Auth\LoginDTO;
use App\Models\User;

interface UserServiceInterface
{
    // Burada UserService Arayüzünü Belirliyoruz
    public function register(RegisterDTO $registerDTO): User;
    public function login(LoginDTO $loginDTO): array;
}
