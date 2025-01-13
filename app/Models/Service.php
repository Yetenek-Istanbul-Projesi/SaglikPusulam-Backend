<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'website',
        'place_url',
        'latitude',
        'longitude',
        'rating',
        'review_count',
        'is_open_now',
        'opening_hours',
        'photo_references',
        'google_place_id',
        'facility_type'
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'rating' => 'float',
        'review_count' => 'integer',
        'is_open_now' => 'boolean',
        'opening_hours' => 'array',
        'photo_references' => 'array'
    ];

    /**
     * Hizmet fotoğrafları
     */
    public function photos(): HasMany
    {
        return $this->hasMany(ServicePhoto::class);
    }

    /**
     * Hizmet değerlendirmeleri
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
