<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'terms_accepted',
        'privacy_accepted',
        'verification_token'
    ];

    protected $casts = [
        'terms_accepted' => 'boolean',
        'privacy_accepted' => 'boolean',
    ];
}
