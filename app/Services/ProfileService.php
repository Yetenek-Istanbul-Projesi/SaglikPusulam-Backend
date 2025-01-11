<?php

namespace App\Services;

use App\Contracts\Services\ProfileServiceInterface;
use App\DTOs\Profile\UpdateProfileDTO;
use App\Models\User;
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
        ]);

        if ($dto->photo) {
            $userData['photo'] = $this->uploadPhoto($user, $dto->photo);
        }

        $user->update($userData);
        return $user->fresh();
    }

    public function uploadPhoto(User $user, $photo): string
    {
        $path = $photo->store('avatars', 'public');
        
        // Delete old photo if it exists and is not the default
        if ($user->photo && $user->photo !== 'avatars/default.png') {
            Storage::disk('public')->delete($user->photo);
        }

        return $path;
    }
}
