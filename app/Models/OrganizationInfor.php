<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrganizationInfor extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'organization_infors';
    protected $fillable = [
    'organization_id',
    'post_count',
    'like_count_all',
    'folower_count',
    'homepage',
    'email',
    'adress',
    ];
}
