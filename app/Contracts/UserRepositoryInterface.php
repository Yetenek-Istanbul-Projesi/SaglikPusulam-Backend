<?php

namespace App\Contracts;

use App\DTOs\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function create(UserDTO $userDTO): User;
    public function findByEmail(string $email): ?User;
}
