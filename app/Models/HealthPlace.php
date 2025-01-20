<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function userFavorites(): HasMany
    {
        return $this->hasMany(UserFavorite::class, 'google_place_id', 'google_place_id');
    }

    public function userComparisons(): HasMany
    {
        return $this->hasMany(UserComparison::class, 'google_place_id', 'google_place_id');
    }
}
