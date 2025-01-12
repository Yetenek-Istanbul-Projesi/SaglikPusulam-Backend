<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Notifications\Channels\TwilioChannel;

class PhoneVerificationNotification extends Notification
{
    use Queueable;

    private string $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function via($notifiable): array
    {
        return [TwilioChannel::class];
    }

    public function toTwilio($notifiable): array
    {
        return [
            'content' => "Sağlık Pusulam doğrulama kodunuz: {$this->code}"
        ];
    }
}
