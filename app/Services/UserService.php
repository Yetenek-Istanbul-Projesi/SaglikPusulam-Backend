<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\VerificationServiceInterface;
use App\DTOs\Auth\RegisterDTO;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly VerificationServiceInterface $verificationService
    ) {}

    public function register(RegisterDTO $registerDTO): User
    {
        $errors = [];
        
        if ($this->userRepository->findByEmail($registerDTO->email)) {
            $errors['email'] = ['Bu e-posta adresi zaten kullanılıyor.'];
        }
        
        if ($this->userRepository->findByPhone($registerDTO->phone)) {
            $errors['phone'] = ['Bu telefon numarası zaten kullanılıyor.'];
        }
        
        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }

        // RegisterDTO'yu UserDTO'ya dönüştürüyoruz
        $userDTO = new UserDTO(
            first_name: $registerDTO->first_name,
            last_name: $registerDTO->last_name,
            email: $registerDTO->email,
            phone: $registerDTO->phone,
            password: $registerDTO->password,
            terms_accepted: $registerDTO->terms_accepted,
            privacy_accepted: $registerDTO->privacy_accepted
        );
        
        $user = $this->userRepository->create($userDTO);

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
