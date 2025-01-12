<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PendingUser extends Model
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'verification_token',
        'terms_accepted',
        'privacy_accepted'
    ];

    /**
     * Route notifications for the mail channel.
     */
    public function routeNotificationForMail(): string
    {
        return $this->email;
    }

    /**
     * Route notifications for the SMS channel.
     */
    public function routeNotificationForSms()
    {
        $phone = $this->phone;
        
        // Telefon numarasını uluslararası formata çevir
        if (!str_starts_with($phone, '+')) {
            // Başında 0 varsa kaldır
            if (str_starts_with($phone, '0')) {
                $phone = substr($phone, 1);
            }
            // +90 ekle
            $phone = '+90' . $phone;
        }
        
        return $phone;
    }

    protected $casts = [
        'terms_accepted' => 'boolean',
        'privacy_accepted' => 'boolean',
    ];
}
