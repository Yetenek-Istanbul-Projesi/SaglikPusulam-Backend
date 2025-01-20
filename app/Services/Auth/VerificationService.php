<?php

namespace App\Services\Auth;

use App\Contracts\VerificationServiceInterface;
use App\DTOs\User\VerificationResponseDTO;
use App\Models\PendingUser;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\PhoneVerificationNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class VerificationService implements VerificationServiceInterface
{
    private const EMAIL_CODE_PREFIX = 'email_verification_';
    private const PHONE_CODE_PREFIX = 'phone_verification_';
    private const CODE_EXPIRY_MINUTES = 60;

    public function generateVerificationCode(): string
    {
        return (string) random_int(100000, 999999);
    }

    public function sendEmailVerification(string $email): VerificationResponseDTO
    {
        try {
            $code = $this->generateVerificationCode();
            $user = PendingUser::where('email', $email)->first();

            if (!$user) {
                throw new \Exception('E-posta adresi bulunamadı.');
            }

            // Kodları güncelle
            $user->update([
                'email_verification_code' => $code,
                'codes_expire_at' => now()->addMinutes(self::CODE_EXPIRY_MINUTES)
            ]);

            Log::info("Email verification code for {$email}: {$code}");
            
            try {
                $notification = new EmailVerificationNotification($code, $user->verification_token);
                $user->notify($notification);
                
                return VerificationResponseDTO::success(
                    'Doğrulama kodu e-posta adresinize gönderildi.'
                );
            } catch (\Exception $e) {
                Log::error("Email verification error: " . $e->getMessage());
                throw new \Exception('E-posta doğrulama kodu gönderilemedi: ' . $e->getMessage());
            }

        } catch (\Exception $e) {
            Log::error("Email verification error: " . $e->getMessage());
            return VerificationResponseDTO::error(
                'Doğrulama kodu gönderilemedi.',
                $e->getMessage()
            );
        }
    }

    public function sendPhoneVerification(string $phone): VerificationResponseDTO
    {
        try {
            $code = $this->generateVerificationCode();
            $user = PendingUser::where('phone', $phone)->first();

            if (!$user) {
                throw new \Exception('Telefon numarası bulunamadı.');
            }

            // Kodları güncelle
            $user->update([
                'phone_verification_code' => $code,
                'codes_expire_at' => now()->addMinutes(self::CODE_EXPIRY_MINUTES)
            ]);

            Log::info("Phone verification code for {$phone}: {$code}");
            
            try {
                $notification = new PhoneVerificationNotification($code, $user->verification_token);
                $user->notify($notification);
                
                return VerificationResponseDTO::success(
                    'Doğrulama kodu telefonunuza gönderildi.'
                );
            } catch (\Exception $e) {
                Log::error("Phone verification error: " . $e->getMessage());
                throw new \Exception('SMS doğrulama kodu gönderilemedi: ' . $e->getMessage());
            }

        } catch (\Exception $e) {
            Log::error("Phone verification error: " . $e->getMessage());
            return VerificationResponseDTO::error(
                'Doğrulama kodu gönderilemedi.',
                $e->getMessage()
            );
        }
    }

    public function verifyEmail(string $email, string $code): bool
    {
        $user = PendingUser::where('email', $email)
            ->where('codes_expire_at', '>', now())
            ->first();
        
        Log::info("Verifying email code", [
            'email' => $email,
            'provided_code' => $code,
            'stored_code' => $user?->email_verification_code,
            'expired' => $user?->codes_expire_at < now()
        ]);

        if ($user && $user->email_verification_code === $code) {
            Log::info("Email verified successfully", ['email' => $email]);
            return true;
        }

        Log::warning("Email verification failed", [
            'email' => $email,
            'reason' => !$user ? 'No user found or code expired' : 'Code mismatch'
        ]);
        return false;
    }

    public function verifyPhone(string $phone, string $code): bool
    {
        $user = PendingUser::where('phone', $phone)
            ->where('codes_expire_at', '>', now())
            ->first();
        
        Log::info("Verifying phone code", [
            'phone' => $phone,
            'provided_code' => $code,
            'stored_code' => $user?->phone_verification_code,
            'expired' => $user?->codes_expire_at < now()
        ]);

        if ($user && $user->phone_verification_code === $code) {
            Log::info("Phone verified successfully", ['phone' => $phone]);
            return true;
        }

        Log::warning("Phone verification failed", [
            'phone' => $phone,
            'reason' => !$user ? 'No user found or code expired' : 'Code mismatch'
        ]);
        return false;
    }

    public function storePendingUser(array $userData): PendingUser
    {
        $userData['verification_token'] = Str::random(60);
        return PendingUser::create($userData);
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
