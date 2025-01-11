<?php

namespace App\Contracts;

use App\DTOs\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    // Burada Reponun arayüzünü belirtiyoruz
    public function create(UserDTO $userDTO): User;
    public function findByEmail(string $email): ?User;

    // Reponun arayüzüne mail-telefon onayı için gerekli metodları ekliyoruz
    public function findByPhone(string $phone): ?User;
    public function markEmailAsVerified(User $user): void;
    public function markPhoneAsVerified(User $user): void;
    public function updateVerificationCode(User $user, string $type, string $code): void;
}
