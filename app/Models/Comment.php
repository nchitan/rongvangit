<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'comments';
    protected $fillable = [
        "user_id",
        "post_id",
        "content",
        "editor",
        "created_at",
        "updated_at",
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }    
}
