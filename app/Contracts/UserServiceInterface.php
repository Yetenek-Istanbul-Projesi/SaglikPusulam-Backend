<?php

namespace App\Contracts;

use App\DTOs\UserDTO;
use App\Models\User;

interface UserServiceInterface
{
    public function register(UserDTO $userDTO): User;
}
