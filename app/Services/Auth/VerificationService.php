<?php

namespace App\Services\Auth;

use App\Contracts\VerificationServiceInterface;
use App\DTOs\VerificationResponseDTO;
use App\Models\PendingUser;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\PhoneVerificationNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class VerificationService implements VerificationServiceInterface
{
    private const VERIFICATION_CODE_LENGTH = 6;
    private const VERIFICATION_CODE_TTL = 300; // 5 dakika

    public function generateVerificationCode(): string
    {
        return str_pad((string)random_int(0, 999999), self::VERIFICATION_CODE_LENGTH, '0', STR_PAD_LEFT);
    }

    public function sendVerification(string $verificationType, string $verificationValue): VerificationResponseDTO
    {
        try {
            $code = $this->generateVerificationCode();
            $key = "{$verificationType}_verification:{$verificationValue}";
            
            Cache::put($key, $code, self::VERIFICATION_CODE_TTL);
            
            if ($verificationType === 'email') {
                // E-posta gönderme işlemi
                if ($user = User::where('email', $verificationValue)->first()) {
                    $user->notify(new EmailVerificationNotification($code));
                } else {
                    // TODO: PendingUser için e-posta gönderimi
                    // Mail::to($verificationValue)->send(new VerificationCodeMail($code));
                }
                
                return VerificationResponseDTO::success(
                    message: 'E-posta doğrulama kodu gönderildi'
                );
            } elseif ($verificationType === 'phone') {
                // SMS gönderme işlemi
                if ($user = User::where('phone', $verificationValue)->first()) {
                    $user->notify(new PhoneVerificationNotification($code));
                } else {
                    // TODO: PendingUser için SMS gönderimi
                    // SMSService::send($verificationValue, "Doğrulama kodunuz: {$code}");
                }
                
                return VerificationResponseDTO::success(
                    message: 'SMS doğrulama kodu gönderildi'
                );
            } else {
                return VerificationResponseDTO::failure(
                    message: 'Geçersiz doğrulama türü'
                );
            }
        } catch (\Exception $e) {
            return VerificationResponseDTO::failure(
                message: 'Doğrulama kodu gönderilemedi',
                error: $e->getMessage()
            );
        }
    }

    public function verify(string $verificationType, string $verificationValue, string $code): bool
    {
        $key = "{$verificationType}_verification:{$verificationValue}";
        $storedCode = Cache::get($key);
        
        if ($storedCode && $storedCode === $code) {
            Cache::forget($key);
            return true;
        }
        
        return false;
    }

    public function storePendingUser(array $userData): PendingUser
    {
        return PendingUser::create([
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'phone' => $userData['phone'],
            'password' => $userData['password'],
            'terms_accepted' => $userData['terms_accepted'],
            'privacy_accepted' => $userData['privacy_accepted'],
            'verification_token' => Str::random(64)
        ]);
    }

    public function verifyAndCreateUser(string $verificationToken): ?User
    {
        $pendingUser = PendingUser::where('verification_token', $verificationToken)
            ->where('created_at', '>=', now()->subDay())
            ->first();

        if (!$pendingUser) {
            return null;
        }

        $user = User::create([
            'first_name' => $pendingUser->first_name,
            'last_name' => $pendingUser->last_name,
            'email' => $pendingUser->email,
            'phone' => $pendingUser->phone,
            'password' => $pendingUser->password,
            'terms_accepted' => $pendingUser->terms_accepted,
            'privacy_accepted' => $pendingUser->privacy_accepted,
            'email_verified_at' => now(),
            'phone_verified_at' => now()
        ]);

        $pendingUser->delete();

        return $user;
    }
}
