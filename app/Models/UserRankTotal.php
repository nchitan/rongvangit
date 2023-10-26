<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserRankTotal extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'user_rank_total';
    protected $fillable = [
        "username",
        "profile_photo_path",
        "contribution",
    ];
}
