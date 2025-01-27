<?php

namespace App\Contracts\Repositories;

use App\DTOs\Profile\UserListDTO;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\Models\User;
use Illuminate\Support\Collection;

interface ProfileRepositoryInterface
{
    public function updateProfile(User $user, UpdateProfileDTO $dto): User;
    public function uploadPhoto(User $user, $photo): string;
    public function changePassword(User $user, ChangePasswordDTO $dto): bool;
    public function getFavorites(int $userId): Collection;
    public function getComparisons(int $userId): Collection;
    public function toggleFavorite(UserListDTO $dto): bool;
    public function toggleComparison(UserListDTO $dto): bool;
    public function checkUserLists(UserListDTO $dto): array;
}
