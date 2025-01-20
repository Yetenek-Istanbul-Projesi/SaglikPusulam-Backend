<?php

namespace App\Contracts\Services;

use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\Models\User;

interface ProfileServiceInterface
{
    public function updateProfile(User $user, UpdateProfileDTO $dto): User;
    public function uploadPhoto(User $user, $photo): string;
    public function changePassword(User $user, ChangePasswordDTO $dto): bool;

    // Health Profile methods
    public function getFavorites(int $userId): array;
    public function getComparisons(int $userId): array;
    public function toggleFavorite(int $userId, string $placeId): array;
    public function toggleComparison(int $userId, string $placeId): array;
    public function checkLists(int $userId, string $placeId): array;
}
