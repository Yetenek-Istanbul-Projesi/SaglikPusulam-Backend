<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'service_id',
        'user_id',
        'comment',
        'rating',
        'source',
        'source_review_id',
        'source_review_time'
    ];

    protected $casts = [
        'rating' => 'float',
        'source_review_time' => 'datetime',
    ];

    /**
     * İlişkili hizmet
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * İlişkili kullanıcı
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
