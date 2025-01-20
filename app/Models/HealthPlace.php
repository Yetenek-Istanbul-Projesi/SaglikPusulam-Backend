<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HealthPlace extends Model
{
    protected $fillable = [
        'google_place_id',
        'place_data',
        'last_updated'
    ];

    protected $casts = [
        'place_data' => 'array',
        'last_updated' => 'datetime'
    ];

    public function userComparisons(): HasMany
    {
        return $this->hasMany(UserComparison::class, 'google_place_id', 'google_place_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(PlaceReview::class);
    }
}
