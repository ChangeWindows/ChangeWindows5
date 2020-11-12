<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'theme'];
    protected $hidden = ['password', 'remember_token'];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function abilities() {
        return $this->role->abilities->flatten()->pluck('name')->unique();
    }
    
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function setPasswordAttribute($password) {
        if (!empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function getAvatarAttribute() {
        if ($this->media_id) {
            return $this->media->path();
        } else {
            return asset('img/models/user.png');
        }
    }
}
