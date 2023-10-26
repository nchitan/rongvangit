<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrganizationFollower extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'organization_followers';
    protected $fillable = [
        "organization_id",
        "follower_user_id",
    ];
}
