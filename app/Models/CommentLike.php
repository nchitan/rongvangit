<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommentLike extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'comment_likes';
    protected $fillable = [
        "user_id",
        "author_id",
        "post_id",
        "comment_id",
        'created_at',
        'updated_at',
    ];
}
