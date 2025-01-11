<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{
private UserRepositoryInterface $userRepository;
    // Burada kullanıcı servisini kullanıyoruz
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    // Burada kullanıcıyı kayıt ediyoruz
    public function register(UserDTO $userDTO): User
    {
        // Burada kullanıcının mail adresinin veritabanında olup olmadığını kontrol ediyoruz
        if ($this->userRepository->findByEmail($userDTO->email)) {
            throw ValidationException::withMessages([
                'email' => ['Bu e-posta adresi zaten kayıtlı.'],
            ]);
        }
        // Burada kullanıcıyı veritabanına kaydediyoruz
        return $this->userRepository->create($userDTO);
    }
}
