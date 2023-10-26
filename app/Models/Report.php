<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Report extends Model
{
    public $timestamps = true;
    use Notifiable;
    protected $table = 'reports';
    protected $fillable = [
        "user_id",
        "reported_id",
        "item_type",
        "item_id",
        "data",
        "status",
        "read_at",
        'created_at',
        'updated_at',
    ];
}
