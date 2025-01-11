<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'type',
        'phone',
        'website',
        'working_hours',
        'address',
        'latitude',
        'longitude',
        'contact_info',
        'rating',
        'review_count',
        'google_place_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'working_hours' => 'array'
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(ServicePhoto::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ServiceReview::class);
    }

    public function userReviews(): HasMany
    {
        return $this->hasMany(ServiceReview::class)->where('is_google_review', false);
    }

    public function googleReviews(): HasMany
    {
        return $this->hasMany(ServiceReview::class)->where('is_google_review', true);
    }
}
