<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'terms_accepted',
        'privacy_accepted',
        'address',
        'photo',
        'email_verified_at',
        'phone_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $attributes = [
        'photo' => '/images/default-profile.png'
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(PlaceReview::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

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
}
