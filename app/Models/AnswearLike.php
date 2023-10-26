<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AnswearLike extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'answear_likes';
    protected $fillable = [
        "user_id",
        "author_id",
        "question_id",
        "answear_id",
        'created_at',
        'updated_at',
    ];
}
