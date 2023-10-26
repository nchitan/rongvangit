<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $timestamps = true;

    protected $table = 'photos';
    protected $fillable = [
        "name",
        "path",
        'created_at',
        'updated_at',
    ];
}
