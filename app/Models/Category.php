<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'categories';
    protected $fillable = [
        "user_id",
        "category_name",
    ];
}
