<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getAvatar()
    {
        if (!$this->avatar) {
            return 'https://gravatar.com/avatar/'.md5($this->email).'?d=retro';
        }
        
        return $this->avatar;
    }

    public function getNameAttribute()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        } elseif ($this->first_name) {
            return $this->first_name;
        } else {
            return $this->username;
        }
    }
}
