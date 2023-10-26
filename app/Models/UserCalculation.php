<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserCalculation extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'user_calculations';
    protected $fillable = [
        'user_id',
        'post_count',
        'answear_count',
        'comment_count',
        'question_count',
        'liked_post_count',
        'liked_comment_count',
        'liked_question_count',
        'liked_answear_count',
        'stocked_post_count',
        'request_aproval_count',
        'request_send_count',
        'folower_count_count',
        'folowing_count',
    ];
}
