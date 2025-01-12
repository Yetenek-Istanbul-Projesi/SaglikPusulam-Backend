<?php

namespace App\Services\Auth;

use App\DTOs\Auth\ForgotPasswordDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetService
{
    public function sendResetLink(ForgotPasswordDTO $dto): void
    {
        $user = User::where('email', $dto->email)->first();
        if (!$user) {
            throw new \Exception('Bu e-posta adresi ile kayıtlı bir kullanıcı bulunamadı.');
        }

        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => now()
            ]
        );

        try {
            $user->notify(new PasswordResetNotification($token));
        } catch (\Exception $e) {
            throw new \Exception('Şifre sıfırlama e-postası gönderilemedi: ' . $e->getMessage());
        }
    }

    public function reset(ResetPasswordDTO $dto): void
    {
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $dto->email)
            ->where('token', $dto->token)
            ->first();

        if (!$tokenData) {
            throw new \Exception('Geçersiz veya süresi dolmuş token.');
        }

        if (now()->diffInMinutes($tokenData->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $dto->email)->delete();
            throw new \Exception('Şifre sıfırlama linkinin süresi dolmuş.');
        }

        $user = User::where('email', $dto->email)->first();
        if (!$user) {
            throw new \Exception('Kullanıcı bulunamadı.');
        }

        $user->password = Hash::make($dto->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $dto->email)->delete();
    }
}
