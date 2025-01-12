<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\VerificationServiceInterface;
use App\DTOs\UserDTO;
use App\DTOs\Auth\LoginDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly VerificationServiceInterface $verificationService
    ) {}

    // Burada kullanıcıyı kayıt ediyoruz
    public function register(UserDTO $userDTO): User
    {
        
        $errors = [];
        
        // Burada kullanıcının mail adresinin veritabanında olup olmadığını kontrol ediyoruz
        if ($this->userRepository->findByEmail($userDTO->email)) {
            $errors['email'] = ['Bu e-posta adresi zaten kullanılıyor.'];
        }
        
        // Check if phone exists
        if ($this->userRepository->findByPhone($userDTO->phone)) {
            $errors['phone'] = ['Bu telefon numarası zaten kullanılıyor.'];
        }
        
        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }
        
        // Burada kullanıcıyı veritabanına kaydediyoruz
        $user = $this->userRepository->create($userDTO);

        // Send verification codes
        $this->verificationService->sendEmailVerification($user->email);
        $this->verificationService->sendPhoneVerification($user->phone);

        return $user;
    }

    public function login(LoginDTO $loginDTO): array
    {
        if (!$loginDTO->email && !$loginDTO->phone) {
            throw ValidationException::withMessages([
                'login' => ['E-posta veya telefon numarası gereklidir.']
            ]);
        }

        $credentials = ['password' => $loginDTO->password];
        
        if ($loginDTO->email) {
            $credentials['email'] = $loginDTO->email;
        } else {
            $credentials['phone'] = $loginDTO->phone;
        }

        if (!$token = auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'login' => ['Geçersiz giriş bilgileri.']
            ]);
        }

        $user = auth()->user();

        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer'
        ];
    }
}
