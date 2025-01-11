<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class PhoneVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly string $code) {}

    public function via($notifiable): array
    {
        return ['vonage'];
    }

    public function toVonage($notifiable): VonageMessage
    {

        // Telefon doğrulama için gerekli body mesajını belirttim.
        return (new VonageMessage)
            ->content("Sağlık Pusulam doğrulama kodunuz: {$this->code}. Bu kod 60 dakika süreyle geçerlidir.");
    }
}
