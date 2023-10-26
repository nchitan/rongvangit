<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tag extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'tags';
    protected $fillable = [
        "slug",
        "tag_name",
        "tag_img",
        "status",
        'created_user',
        'created_at',
        'updated_at',
    ];
}
