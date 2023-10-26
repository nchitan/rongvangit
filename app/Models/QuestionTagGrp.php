<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class QuestionTagGrp extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'question_tag_grps';
    protected $fillable = [
        "question_id",
        "tag_id",
        "user_id",
        'created_at',
        'updated_at',
    ];
}
