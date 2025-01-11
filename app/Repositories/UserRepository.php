<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(UserDTO $userDTO): User
    {
        return User::create([
            'first_name' => $userDTO->first_name,
            'last_name' => $userDTO->last_name,
            'email' => $userDTO->email,
            'phone' => $userDTO->phone,
            'password' => Hash::make($userDTO->password),
            'terms_accepted' => $userDTO->terms_accepted,
            'privacy_accepted' => $userDTO->privacy_accepted,
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findByPhone(string $phone): ?User
    {
        return User::where('phone', $phone)->first();
    }

    public function markEmailAsVerified(User $user): void
    {
        $user->email_verified_at = now();
        $user->email_verification_code = null;
        $user->email_verification_code_expires_at = null;
        $user->save();
    }

    public function markPhoneAsVerified(User $user): void
    {
        $user->phone_verified_at = now();
        $user->phone_verification_code = null;
        $user->phone_verification_code_expires_at = null;
        $user->save();
    }

    public function updateVerificationCode(User $user, string $type, string $code): void
    {
        $expiresAt = now()->addHours(1);
        
        if ($type === 'email') {
            $user->email_verification_code = $code;
            $user->email_verification_code_expires_at = $expiresAt;
        } else {
            $user->phone_verification_code = $code;
            $user->phone_verification_code_expires_at = $expiresAt;
        }
        
        $user->save();
    }
}
