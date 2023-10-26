<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Question extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'questions';
    protected $fillable = [
        "user_id",
        "type",
        "title",
        "editor",
        "content",
        "item",
        "status",
        'created_at',
        'updated_at',
    ];
}
