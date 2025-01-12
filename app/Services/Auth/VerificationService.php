<?php

namespace App\Services\Auth;

use App\Contracts\VerificationServiceInterface;
use App\DTOs\User\VerificationResponseDTO;
use App\Models\PendingUser;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\PhoneVerificationNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
            $key = self::EMAIL_CODE_PREFIX . $email;

            Cache::put($key, $code, now()->addMinutes(self::CODE_EXPIRY_MINUTES));

            $user = User::where('email', $email)->first() ?? 
                   PendingUser::where('email', $email)->first();

            if (!$user) {
                throw new \Exception('E-posta adresi bulunamadı.');
            }

            // Eğer PendingUser ise verification_token'ı al
            $verificationToken = $user instanceof PendingUser ? $user->verification_token : null;

            if (!$verificationToken) {
                throw new \Exception('Geçersiz kullanıcı durumu.');
            }

            Log::info("Email verification code for {$email}: {$code}");
            
            try {
                $notification = new EmailVerificationNotification($code, $verificationToken);
                $user->notify($notification);
                
                return VerificationResponseDTO::success(
                    'Doğrulama kodu e-posta adresinize gönderildi.'
                );
            } catch (\Exception $e) {
                // Gönderim başarısız olursa cache'i temizle
                Cache::forget($key);
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
            $key = self::PHONE_CODE_PREFIX . $phone;

            Cache::put($key, $code, now()->addMinutes(self::CODE_EXPIRY_MINUTES));

            $user = User::where('phone', $phone)->first() ?? 
                   PendingUser::where('phone', $phone)->first();

            if (!$user) {
                throw new \Exception('Telefon numarası bulunamadı.');
            }

            // Eğer PendingUser ise verification_token'ı al
            $verificationToken = $user instanceof PendingUser ? $user->verification_token : null;

            if (!$verificationToken) {
                throw new \Exception('Geçersiz kullanıcı durumu.');
            }

            Log::info("Phone verification code for {$phone}: {$code}");
            
            try {
                $notification = new PhoneVerificationNotification($code, $verificationToken);
                $user->notify($notification);
                
                return VerificationResponseDTO::success(
                    'Doğrulama kodu telefonunuza gönderildi.'
                );
            } catch (\Exception $e) {
                // Gönderim başarısız olursa cache'i temizle
                Cache::forget($key);
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
        $key = self::EMAIL_CODE_PREFIX . $email;
        $storedCode = Cache::get($key);
        
        Log::info("Verifying email code", [
            'email' => $email,
            'provided_code' => $code,
            'stored_code' => $storedCode,
            'stored_code_type' => gettype($storedCode)
        ]);

        if ($storedCode && (string)$storedCode === (string)$code) {
            Cache::forget($key);
            Log::info("Email verified successfully", ['email' => $email]);
            return true;
        }

        Log::warning("Email verification failed", [
            'email' => $email,
            'reason' => !$storedCode ? 'No stored code found' : 'Code mismatch'
        ]);
        return false;
    }

    public function verifyPhone(string $phone, string $code): bool
    {
        $key = self::PHONE_CODE_PREFIX . $phone;
        $storedCode = Cache::get($key);
        
        Log::info("Verifying phone code", [
            'phone' => $phone,
            'provided_code' => $code,
            'stored_code' => $storedCode,
            'stored_code_type' => gettype($storedCode)
        ]);

        if ($storedCode && (string)$storedCode === (string)$code) {
            Cache::forget($key);
            Log::info("Phone verified successfully", ['phone' => $phone]);
            return true;
        }

        Log::warning("Phone verification failed", [
            'phone' => $phone,
            'reason' => !$storedCode ? 'No stored code found' : 'Code mismatch'
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
