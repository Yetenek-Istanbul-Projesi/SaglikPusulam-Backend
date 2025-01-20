<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserComparison extends Model
{
    protected $fillable = [
        'user_id',
        'google_place_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function healthPlace(): BelongsTo
    {
        return $this->belongsTo(HealthPlace::class, 'google_place_id', 'google_place_id');
    }
}
