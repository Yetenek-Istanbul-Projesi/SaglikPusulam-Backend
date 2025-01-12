<?php

namespace App\Services;

use App\Contracts\Repositories\IPasswordResetRepository;
use App\DTOs\PasswordReset\ForgotPasswordDTO;
use App\DTOs\PasswordReset\ResetPasswordDTO;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class PasswordResetService
{
    public function __construct(
        private readonly IPasswordResetRepository $passwordResetRepository
    ) {}

    public function sendResetLink(ForgotPasswordDTO $dto): void
    {
        $user = User::where($dto->type, $dto->identifier)->firstOrFail();
        $token = $this->passwordResetRepository->createToken($dto->identifier);

        if ($dto->type === 'email') {
            Notification::send($user, new PasswordResetNotification($token));
        } else {
            // SMS gönderimi için gerekli kod buraya eklenecek
        }
    }

    public function reset(ResetPasswordDTO $dto): void
    {
        $token = $this->passwordResetRepository->findValidToken($dto->identifier, $dto->token);
        
        if (!$token) {
            throw new \Exception('Invalid or expired token');
        }

        $user = User::where($dto->type, $dto->identifier)->firstOrFail();
        $user->password = Hash::make($dto->password);
        $user->save();

        $this->passwordResetRepository->deleteToken($dto->identifier);
    }
}
