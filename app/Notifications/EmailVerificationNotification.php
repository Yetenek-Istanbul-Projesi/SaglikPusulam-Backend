<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly string $code) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('E-posta Adresinizi Doğrulayın')
            ->line('Hoş geldiniz! E-posta adresinizi doğrulamak için aşağıdaki kodu kullanın.')
            ->line('Doğrulama Kodunuz: ' . $this->code)
            ->line('Bu kod 60 dakika süreyle geçerlidir.')
            ->line('Eğer bu işlemi siz yapmadıysanız, bu e-postayı görmezden gelebilirsiniz.');
    }
}
