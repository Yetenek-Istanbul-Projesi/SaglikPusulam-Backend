<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Notifications\Channels\TwilioChannel;

class PhoneVerificationNotification extends Notification
{
    use Queueable;

    private readonly string $code;
    private readonly string $verificationToken;

    public function __construct(
        private readonly string $code,
        private readonly string $verificationToken
    ) {}

    public function via($notifiable): array
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable): array
    {
        $verificationUrl = config('app.frontend_url') . '/verify-registration?token=' . $this->verificationToken;
        
        return [
            'content' => "Sağlık Pusulam doğrulama kodunuz: {$this->code}\n\n".
                        "Doğrulama sayfası: {$verificationUrl}"
        ];
    }
}
