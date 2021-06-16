<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
        'name',
        'role',
        'image',
        'faves',
        'subs',
        'rating',
        'email'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'username' => 'string',
        'password' => 'string',
        'name' => 'string',
        'role' => 'string',
        'image' => 'string',
        'faves' => 'array',
        'subs' => 'array',
        'rating' => 'integer',
        'email' => 'string'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role)
                if ($this->hasRole($role))
                    return true;
        } else {
            if ($this->hasRole($roles))
                return true;
        }

        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first())
            return true;
        return false;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
