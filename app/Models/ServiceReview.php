<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceReview extends Model
{
    protected $fillable = [
        'service_id',
        'user_id',
        'comment',
        'rating',
        'photo_path',
        'is_google_review',
        'reviewer_name',
        'google_review_id',
        'review_time'
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'is_google_review' => 'boolean',
        'review_time' => 'datetime'
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
