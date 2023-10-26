<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TagRankMonthly extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'tag_rank_monthly';
    protected $fillable = [
        "tag_name",
        "tag_img",
        "count_post",
    ];
}
