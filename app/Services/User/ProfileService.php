<?php

namespace App\Services\User;

use App\Contracts\Services\ProfileServiceInterface;
use App\DTOs\Auth\ChangePasswordDTO;
use App\DTOs\User\Profile\UpdateProfileDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileService implements ProfileServiceInterface
{
    public function updateProfile(User $user, UpdateProfileDTO $dto): User
    {
        Log::info('Profile update started', [
            'user_id' => $user->id,
            'data' => [
                'first_name' => $dto->first_name,
                'last_name' => $dto->last_name,
                'email' => $dto->email,
                'phone' => $dto->phone,
                'address' => $dto->address,
                'has_photo' => !is_null($dto->photo)
            ]
        ]);

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

        $success = $user->update($userData);
        Log::info('Profile update completed', [
            'user_id' => $user->id,
            'success' => $success,
            'updated_data' => $userData
        ]);

        return $user->fresh();
    }

    public function uploadPhoto(User $user, $photo): string
    {
        try {
            // Eğer photo zaten bir string ise (yani dosya yolu), direkt döndür
            if (is_string($photo)) {
                return $photo;
            }

            // Dosya yükleme işlemi
            $path = $photo->store('avatars', 'public');
            
            // Eski fotoğrafı sil
            if ($user->photo && $user->photo !== 'avatars/default.png') {
                Storage::disk('public')->delete($user->photo);
            }

            return $path;
        } catch (\Exception $e) {
            Log::error('Photo upload failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function changePassword(User $user, ChangePasswordDTO $dto): bool
    {
        if (!Hash::check($dto->current_password, $user->password)) {
            throw new \InvalidArgumentException('Mevcut şifreniz yanlış.');
        }

        $user->update([
            'password' => Hash::make($dto->new_password)
        ]);

        return true;
    }
}
