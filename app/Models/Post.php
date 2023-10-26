<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Post extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'posts';
    protected $fillable = [
        "user_id",
        "title",
        "editor",
        "content",
        "item",
        "status",
        "serie_id",
        'created_at',
        'updated_at',
        'published_at',
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User','user_id');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}