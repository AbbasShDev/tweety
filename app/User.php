<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable {

    use Notifiable, followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'description', 'email', 'password', 'avatar', 'header'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function avatarUrl()
    {
        if ($this->avatar){
            return Storage::disk('s3')->url($this->avatar);
        }

        return asset('/images/default-avatar.png');
    }


    public function headerUrl()
    {
        if ($this->header){
            return Storage::disk('s3')->url($this->header);
        }

        return asset('/images/default-header.png');
    }


    public function timeline()
    {

        $friends = $this->follows()->pluck('id');

        return
            Tweet::whereIn('user_id', $friends)
                ->orWhere('user_id', $this->id)
                ->withLikes()
                ->latest()
                ->paginate(50);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function path($append = '')
    {

        $path = route('profile', $this->username);

        return $append ? "$path/$append" : $path;

    }

    public function plainUsername()
    {

        $username = explode('@', $this->username);

        return $username[1];
    }
}
