<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 
        'fullname',
        'about',
        'facebook',
        'zalo',
        'youtube',
        'github',
        'website',
        'adress',
        'university',
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function followers() 
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
                    ->withTimestamps();
    }

    public function follows() 
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
                    ->withTimestamps();
    }
    public function follow($userId) 
    {
        $this->follows()->attach($userId);
        return $this;
    }

    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }

    public function isFollowing($userId) 
    {


    $users = DB::table('users')
            ->select('followers.id', 'followers.user_id as pivot_user_id', 'followers.follows_id as pivot_follows_id', 'followers.created_at as pivot_created_at', 'followers.updated_at as pivot_updated_at')
            ->join('followers', 'users.id', '=', 'followers.follows_id')
            ->where('followers.user_id', '=',Auth::id())
            ->where('follows_id', '=',$userId)
            ->first();





        return (boolean) $users;
    }
    public function posts()
    {
      return $this->hasMany('App\Models\Post','username');
    }
            
}