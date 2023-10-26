<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    public $timestamps = fale;
    use Notifiable;
    protected $table = 'roles';
    protected $fillable = [
        "user_id",
        "role_name",
    ];
}
