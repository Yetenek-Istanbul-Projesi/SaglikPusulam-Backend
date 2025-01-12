<?php

namespace App\Services\Auth;

use App\DTOs\Auth\ForgotPasswordDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetService
{
    public function sendResetLink(ForgotPasswordDTO $dto): void
    {
        $status = Password::sendResetLink(
            ['email' => $dto->identifier]
        );

        if ($status !== Password::RESET_LINK_SENT) {
            throw new \Exception(__($status));
        }
    }

    public function reset(ResetPasswordDTO $dto): void
    {
        $status = Password::reset(
            [
                'email' => $dto->email,
                'password' => $dto->password,
                'password_confirmation' => $dto->password_confirmation,
                'token' => $dto->token,
            ],
            function (User $user, string $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw new \Exception(__($status));
        }
    }
}
