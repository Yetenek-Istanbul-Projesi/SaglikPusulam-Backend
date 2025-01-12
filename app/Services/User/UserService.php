<?php

namespace App\Services\User;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\VerificationServiceInterface;
use App\DTOs\Auth\RegisterDTO;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\UserDTO;
use App\Models\User;
use App\Models\PendingUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly VerificationServiceInterface $verificationService
    ) {}

    public function register(RegisterDTO $registerDTO): array
    {
        $errors = [];
        
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
        $emailResult = $this->verificationService->sendVerification('email', $pendingUser->email);
        $phoneResult = $this->verificationService->sendVerification('phone', $pendingUser->phone);

        if (!$emailResult->success || !$phoneResult->success) {
            // Eğer doğrulama kodları gönderilemezse geçici kaydı sil
            $pendingUser->delete();
            throw new \Exception('Doğrulama kodları gönderilemedi. Lütfen daha sonra tekrar deneyin.');
        }

        return [
            'verification_token' => $pendingUser->verification_token,
            'email_sent' => $emailResult->success,
            'phone_sent' => $phoneResult->success,
            'message' => 'Doğrulama kodları e-posta ve telefon numaranıza gönderildi.'
        ];
    }

    public function verifyRegistration(string $verificationToken, string $emailCode, string $phoneCode): ?User
    {
        $pendingUser = PendingUser::where('verification_token', $verificationToken)
            ->first();

        if (!$pendingUser) {
            throw ValidationException::withMessages([
                'verification' => ['Geçersiz veya süresi dolmuş doğrulama token\'ı.']
            ]);
        }

        // E-posta ve telefon kodlarını doğrula
        $isEmailVerified = $this->verificationService->verify('email', $pendingUser->email, $emailCode);
        $isPhoneVerified = $this->verificationService->verify('phone', $pendingUser->phone, $phoneCode);

        if (!$isEmailVerified || !$isPhoneVerified) {
            throw ValidationException::withMessages([
                'verification' => ['Geçersiz doğrulama kodları.']
            ]);
        }

        // Kullanıcıyı oluştur
        return $this->verificationService->verifyAndCreateUser($verificationToken);
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

        if (!$token = auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'login' => ['Geçersiz giriş bilgileri.']
            ]);
        }

        $user = auth()->user();

        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer'
        ];
    }
}
