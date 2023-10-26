<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserOrganization extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'user_organizations';
    protected $fillable = [
        "user_id",
        "organization_id",
    ];
}
