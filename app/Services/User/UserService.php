<?php

namespace App\Services\User;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\VerificationServiceInterface;
use App\DTOs\Auth\RegisterDTO;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\UserDTO;
use App\DTOs\User\VerificationResponseDTO;
use App\Models\User;
use App\Models\PendingUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly VerificationServiceInterface $verificationService
    ) {}

    public function register(RegisterDTO $registerDTO): array
    {
        $errors = [];
        $pendingUser = null;
        
        // E-posta ve telefon numarası hem User hem de PendingUser tablolarında kontrol edilmeli
        if ($this->userRepository->findByEmail($registerDTO->email) || 
            PendingUser::where('email', $registerDTO->email)->exists()) {
            $errors['email'] = ['Bu e-posta adresi zaten kullanılıyor.'];
        }
        
        if ($this->userRepository->findByPhone($registerDTO->phone) ||
            PendingUser::where('phone', $registerDTO->phone)->exists()) {
            $errors['phone'] = ['Bu telefon numarası zaten kullanılıyor.'];
        }
        
        if (!empty($errors)) {
            throw ValidationException::withMessages($errors);
        }

        try {
            // Geçici kullanıcı kaydını oluştur
            $pendingUser = $this->verificationService->storePendingUser([
                'first_name' => $registerDTO->first_name,
                'last_name' => $registerDTO->last_name,
                'email' => $registerDTO->email,
                'phone' => $registerDTO->phone,
                'password' => bcrypt($registerDTO->password),
                'terms_accepted' => $registerDTO->terms_accepted,
                'privacy_accepted' => $registerDTO->privacy_accepted
            ]);

            // Doğrulama kodlarını gönder
            $emailResult = $this->verificationService->sendEmailVerification($pendingUser->email);
            $phoneResult = $this->verificationService->sendPhoneVerification($pendingUser->phone);

            if (!$emailResult->success || !$phoneResult->success) {
                throw new \Exception('Doğrulama kodları gönderilemedi: ' . 
                    (!$emailResult->success ? 'Email: ' . $emailResult->error : '') . 
                    (!$phoneResult->success ? 'SMS: ' . $phoneResult->error : ''));
            }

            return [
                'verification_token' => $pendingUser->verification_token,
                'email_sent' => $emailResult->success,
                'phone_sent' => $phoneResult->success,
                'message' => 'Doğrulama kodları e-posta ve telefon numaranıza gönderildi.'
            ];

        } catch (\Exception $e) {
            // Hata durumunda geçici kaydı sil
            if ($pendingUser) {
                $pendingUser->delete();
            }
            throw new \Exception('Kayıt işlemi başarısız: ' . $e->getMessage());
        }
    }

    public function verifyRegistration(string $verificationToken, string $emailCode, string $phoneCode): ?User
    {
        Log::info('Starting registration verification', [
            'verification_token' => $verificationToken,
            'email_code' => $emailCode,
            'phone_code' => $phoneCode
        ]);

        $pendingUser = PendingUser::where('verification_token', $verificationToken)
            ->first();

        if (!$pendingUser) {
            Log::warning('Invalid verification token or pending user not found');
            throw ValidationException::withMessages([
                'verification' => ['Geçersiz veya süresi dolmuş doğrulama token\'ı.']
            ]);
        }

        Log::info('Found pending user', [
            'email' => $pendingUser->email,
            'phone' => $pendingUser->phone
        ]);

        // E-posta ve telefon kodlarını doğrula
        $isEmailVerified = $this->verificationService->verifyEmail($pendingUser->email, $emailCode);
        $isPhoneVerified = $this->verificationService->verifyPhone($pendingUser->phone, $phoneCode);

        Log::info('Verification results', [
            'email_verified' => $isEmailVerified,
            'phone_verified' => $isPhoneVerified
        ]);

        if (!$isEmailVerified || !$isPhoneVerified) {
            Log::warning('Invalid verification codes');
            throw ValidationException::withMessages([
                'verification' => ['Geçersiz doğrulama kodları.']
            ]);
        }

        // Kullanıcıyı oluştur
        $user = $this->verificationService->verifyAndCreateUser($verificationToken);

        Log::info('User created after verification', [
            'user_id' => $user?->id,
            'email_verified_at' => $user?->email_verified_at,
            'phone_verified_at' => $user?->phone_verified_at
        ]);

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

        if (!$token = JWTAuth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'login' => ['Geçersiz giriş bilgileri.']
            ]);
        }

        $user = JWTAuth::user();

        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer'
        ];
    }
}
