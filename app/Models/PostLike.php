<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PostLike extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'post_likes';
    protected $fillable = [
        "user_id",
        "author_id",
        "post_id",
        'created_at',
        'updated_at',
    ];
}
