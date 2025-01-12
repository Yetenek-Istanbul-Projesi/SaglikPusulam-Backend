<?php

namespace App\Services\User;

use App\Contracts\Services\ProfileServiceInterface;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileService implements ProfileServiceInterface
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
}
