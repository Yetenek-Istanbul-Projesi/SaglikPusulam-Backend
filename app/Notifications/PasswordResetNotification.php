<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly string $token)
    {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = config('auth.password_reset_url') . '?token=' . $this->token . '&email=' . urlencode($notifiable->email);

        return (new MailMessage)
            ->subject('Şifre Sıfırlama İsteği')
            ->line('Bu e-postayı şifre sıfırlama isteğinde bulunduğunuz için alıyorsunuz.')
            ->action('Şifreyi Sıfırla', $url)
            ->line('Bu link 60 dakika süreyle geçerlidir.')
            ->line('Eğer şifre sıfırlama isteğinde bulunmadıysanız, bu e-postayı görmezden gelebilirsiniz.');
    }
}
