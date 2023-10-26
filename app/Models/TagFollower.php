<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TagFollower extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'tag_followers';
    protected $fillable = [
        "tag_id",
        "user_id",
    ];
}
