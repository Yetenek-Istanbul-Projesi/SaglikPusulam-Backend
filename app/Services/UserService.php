<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\VerificationServiceInterface;
use App\DTOs\UserDTO;
use App\Models\User;
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
}
