<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrganizationRank extends Model
{
    public $timestamps = false;
    use Notifiable;
    protected $table = 'organization_ranks';
    protected $fillable = [
        "organization_id",
        "like_count_month",
        "like_count_all",
    ];
}
