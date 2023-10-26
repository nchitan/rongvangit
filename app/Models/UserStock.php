<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserStock extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'user_stocks';
    protected $fillable = [
        "user_id",
        "post_id",
        "author_id",
        "category_id",
        "sub_category_id",
        'created_at',
        'updated_at',
    ];
}
