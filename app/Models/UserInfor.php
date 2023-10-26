<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserInfor extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'user_infors';
    protected $fillable = [
    "user_id",
    'folow_count',
    'folower_count',
    'contribution',
    'gihub',
    'twitter',
    'facebook',
    'linked',
    'youtube',
    'zalo',
    'user_organization_id',
    'user_about',
    'homepage',
    'adress',
    'university',
    ];
}
