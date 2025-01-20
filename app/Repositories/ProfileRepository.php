<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProfileRepositoryInterface;
use App\DTOs\Profile\UserListDTO;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\Models\User;
use App\Models\UserFavorite;
use App\Models\UserComparison;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileRepository implements ProfileRepositoryInterface
{
    public function updateProfile(User $user, UpdateProfileDTO $dto): User
    {
        $userData = array_filter([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'address' => $dto->address,
        ], fn($value) => !is_null($value));

        if ($dto->photo) {
            $userData['photo'] = $this->uploadPhoto($user, $dto->photo);
        }

        $user->update($userData);
        return $user->fresh();
    }

    public function uploadPhoto(User $user, $photo): string
    {
        try {
            if (is_string($photo)) {
                return $photo;
            }

            $path = $photo->store('avatars', 'public');
            
            if ($user->photo && $user->photo !== 'avatars/default.png') {
                Storage::disk('public')->delete($user->photo);
            }

            return $path;
        } catch (\Exception $e) {
            throw new \RuntimeException('Fotoğraf yüklenirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function changePassword(User $user, ChangePasswordDTO $dto): bool
    {
        $user->update([
            'password' => Hash::make($dto->new_password)
        ]);

        return true;
    }

    public function getFavorites(int $userId): Collection
    {
        return UserFavorite::where('user_id', $userId)
            ->with('healthPlace')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getComparisons(int $userId): Collection
    {
        return UserComparison::where('user_id', $userId)
            ->with('healthPlace')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function toggleFavorite(UserListDTO $dto): bool
    {
        $favorite = UserFavorite::where([
            'user_id' => $dto->userId,
            'google_place_id' => $dto->googlePlaceId
        ])->first();

        if ($favorite) {
            $favorite->delete();
            return false;
        }

        UserFavorite::create([
            'user_id' => $dto->userId,
            'google_place_id' => $dto->googlePlaceId
        ]);

        return true;
    }

    public function toggleComparison(UserListDTO $dto): bool
    {
        $comparison = UserComparison::where([
            'user_id' => $dto->userId,
            'google_place_id' => $dto->googlePlaceId
        ])->first();

        if ($comparison) {
            $comparison->delete();
            return false;
        }

        UserComparison::create([
            'user_id' => $dto->userId,
            'google_place_id' => $dto->googlePlaceId
        ]);

        return true;
    }

    public function checkUserLists(UserListDTO $dto): array
    {
        return [
            'is_favorite' => UserFavorite::where([
                'user_id' => $dto->userId,
                'google_place_id' => $dto->googlePlaceId
            ])->exists(),
            'is_in_comparison' => UserComparison::where([
                'user_id' => $dto->userId,
                'google_place_id' => $dto->googlePlaceId
            ])->exists()
        ];
    }
}
