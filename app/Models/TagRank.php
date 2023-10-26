<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TagRank extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'tag_ranks';
    protected $fillable = [
        "tag_id",
        "post_count_week",
        "post_count_month",
        "post_count_all",
    ];
}
