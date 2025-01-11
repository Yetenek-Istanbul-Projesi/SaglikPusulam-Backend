<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{   // Yorumlar tablosu
    protected $fillable = [
        'service_id',
        'user_id',
        'content',
        'is_anonymous',
        'anonymous_name',
        'status' // pending, approved, rejected
    ];

    protected $casts = [
        'is_anonymous' => 'boolean'
    ];

    // Yorumun ait olduğu hizmet
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Yorumu yapan kullanıcı (anonim değilse)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Yorum sahibinin adını döndüren method
    public function getCommenterName(): string
    {
        if ($this->is_anonymous) {
            return $this->anonymous_name ?? 'Anonim Kullanıcı';
        }

        return $this->user?->first_name . ' ' . $this->user?->last_name ?? 'Silinmiş Kullanıcı';
    }
}
