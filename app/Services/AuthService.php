<?php

namespace App\Services;

use App\DTOs\Auth\LoginDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    
    public function login(LoginDTO $dto): array
    {   // Burada kullanıcıdan gelen verileri mevcut verilere aktarıyoruz.
        $credentials = [
            'email' => $dto->email,
            'password' => $dto->password
        ];
        //Burada kullanıcının veritabanında olup olmadığını kontrol ediyoruz
        if (!Auth::attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }
        //Burada kullanıcının oturum açma bilgilerini mevcut verilere aktarıyoruz.
        $user = User::where('email', $dto->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        //Daha sonra token bilgilerini döndürüyoruz.
        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ];
    }
}
