<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserFollowingTag extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'user_following_tags';
    protected $fillable = [
        "user_id",
        "tag_id",
    ];
}
