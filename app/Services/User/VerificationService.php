<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\VerificationServiceInterface;
use App\DTOs\VerificationResponseDTO;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\PhoneVerificationNotification;
use Exception;
use Illuminate\Support\Str;

class VerificationService implements VerificationServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    // Onay maili gönderiliyor.

    public function sendEmailVerification(string $email): VerificationResponseDTO
    {
        try {
            // Kullanıcı bulunuyor
            $user = $this->userRepository->findByEmail($email);
            if (!$user) {
                return VerificationResponseDTO::failure(
                    message: 'E-posta doğrulama kodu gönderilemedi',
                    error: 'Kullanıcı bulunamadı'
                );
            }

            // Kod oluşturuluyor
            $code = Str::random(6);
            $this->userRepository->updateVerificationCode($user, 'email', $code);
            
            // Kullanıcıya e-posta gönderiliyor
            $user->notify(new EmailVerificationNotification($code));

            return VerificationResponseDTO::success(
                message: 'E-posta doğrulama kodu gönderildi'
            );
        } catch (Exception $e) {
            return VerificationResponseDTO::failure(
                message: 'E-posta doğrulama kodu gönderilemedi',
                error: $e->getMessage()
            );
        }
    }
    // Onay SMS'i gönderiliyor
    public function sendPhoneVerification(string $phone): VerificationResponseDTO
    {
        // Kullanıcı bulunuyor
        try {
            $user = $this->userRepository->findByPhone($phone);
            if (!$user) {
                return VerificationResponseDTO::failure(
                    message: 'SMS doğrulama kodu gönderilemedi',
                    error: 'Kullanıcı bulunamadı'
                );
            }

            // Kod oluşturuluyor
            $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $this->userRepository->updateVerificationCode($user, 'phone', $code);
            
            // Kullanıcıya SMS gönderiliyor
            $user->notify(new PhoneVerificationNotification($code));

            return VerificationResponseDTO::success(
                message: 'SMS doğrulama kodu gönderildi'
            );
        } catch (Exception $e) {
            return VerificationResponseDTO::failure(
                message: 'SMS doğrulama kodu gönderilemedi',
                error: $e->getMessage()
            );
        }
    }

    // Onay kodu dogrulanıyor
    public function verifyEmail(string $email, string $token): VerificationResponseDTO
    {
        try {
            // Kullanıcı bulunuyor
            $user = $this->userRepository->findByEmail($email);
            if (!$user || $user->email_verification_code !== $token) {
                return VerificationResponseDTO::failure(
                    message: 'E-posta doğrulanamadı',
                    error: 'Geçersiz doğrulama kodu'
                );
            }
            // Kodun suresini kontrol ediyoruz
            if ($user->email_verification_code_expires_at < now()) {
                return VerificationResponseDTO::failure(
                    message: 'E-posta doğrulanamadı',
                    error: 'Doğrulama kodunun süresi dolmuş'
                );
            }
            // Kullanıcıyı onaylıyoruz
            $this->userRepository->markEmailAsVerified($user);
            
            // Kullanıcıya e-posta gönderiliyor
            return VerificationResponseDTO::success(
                message: 'E-posta başarıyla doğrulandı'
            );
        } catch (Exception $e) {
            return VerificationResponseDTO::failure(
                message: 'E-posta doğrulanamadı',
                error: $e->getMessage()
            );
        }
    }

    // Onay kodu dogrulanıyor
    public function verifyPhone(string $phone, string $code): VerificationResponseDTO
    {
        try {
            // Kullanıcı bulunuyor
            $user = $this->userRepository->findByPhone($phone);
            if (!$user || $user->phone_verification_code !== $code) {
                return VerificationResponseDTO::failure(
                    message: 'Telefon numarası doğrulanamadı',
                    error: 'Geçersiz doğrulama kodu'
                );
            }
            // Kodun suresini kontrol ediyoruz
            if ($user->phone_verification_code_expires_at < now()) {
                return VerificationResponseDTO::failure(
                    message: 'Telefon numarası doğrulanamadı',
                    error: 'Doğrulama kodunun süresi dolmuş'
                );
            }
            // Kullanıcıyı onaylıyoruz
            $this->userRepository->markPhoneAsVerified($user);
            
            return VerificationResponseDTO::success(
                message: 'Telefon numarası başarıyla doğrulandı'
            );
        } catch (Exception $e) {
            return VerificationResponseDTO::failure(
                message: 'Telefon numarası doğrulanamadı',
                error: $e->getMessage()
            );
        }
    }
}
