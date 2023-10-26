<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TagInfor extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'tags';
    protected $fillable = [
        "tag_id",
        "tag_about",
        "tag_img",
        "post_count_all",
        "folower_count",
    ];
}
