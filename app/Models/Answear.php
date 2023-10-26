<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Answear extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'answears';
    protected $fillable = [
        "user_id",
        "question_id",
        "content",
        "editor",
        "created_at",
        "updated_at",
    ];
}
