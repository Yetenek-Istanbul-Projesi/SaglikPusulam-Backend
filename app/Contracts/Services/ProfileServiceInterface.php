<?php

namespace App\Contracts\Services;

use App\DTOs\Profile\UpdateProfileDTO;
use App\Models\User;

interface ProfileServiceInterface
{
    public function updateProfile(User $user, UpdateProfileDTO $dto): User;
    public function uploadPhoto(User $user, $photo): string;
}
