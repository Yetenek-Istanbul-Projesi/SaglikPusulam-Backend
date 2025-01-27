<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceReview extends Model
{
    protected $fillable = [
        'user_id',
        'health_place_id',
        'comment',
        'rating',
        'is_anonymous'
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_anonymous' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function healthPlace(): BelongsTo
    {
        return $this->belongsTo(HealthPlace::class);
    }
}
