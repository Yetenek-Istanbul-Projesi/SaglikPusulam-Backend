<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly string $code,
        private readonly string $verificationToken
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = config('app.frontend_url') . '/verify-registration?token=' . $this->verificationToken;

        return (new MailMessage)
            ->subject('E-posta Adresinizi Doğrulayın')
            ->line('Hoş geldiniz! E-posta adresinizi doğrulamak için aşağıdaki kodu kullanın.')
            ->line('Doğrulama Kodunuz: ' . $this->code)
            ->action('Hesabımı Doğrula', $verificationUrl)
            ->line('Ya da aşağıdaki linke tıklayarak doğrulama sayfasına gidebilirsiniz:')
            ->line($verificationUrl)
            ->line('Bu kod ve link 60 dakika süreyle geçerlidir.')
            ->line('Eğer bu işlemi siz yapmadıysanız, bu e-postayı görmezden gelebilirsiniz.');
    }
}
