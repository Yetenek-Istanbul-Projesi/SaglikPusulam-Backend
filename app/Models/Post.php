<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content',
        'card_title',
        'card_image',
        'card_summary',
    ];
}
