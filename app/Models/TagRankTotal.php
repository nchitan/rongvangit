<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TagRankTotal extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'tag_rank_total';
    protected $fillable = [
        "tag_name",
        "tag_img",
        "count_post",
    ];
}
