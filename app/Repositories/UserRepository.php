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
        //Burada kullanıcıdan gelen verileri veritabanına kaydediyoruz
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

    // Burada kullanıcının e-posta adresinin veritabanında olup olmadığını buluyoruz
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
