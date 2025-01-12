<?php

namespace App\Contracts;

use App\DTOs\UserDTO;
use App\DTOs\Auth\LoginDTO;
use App\Models\User;

interface UserServiceInterface
{
    // Burada UserService Arayüzünü Belirliyoruz
    public function register(UserDTO $userDTO): User;
    public function login(LoginDTO $loginDTO): array;
}
