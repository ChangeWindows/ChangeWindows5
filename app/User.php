<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class User extends Authenticatable implements JWTSubject, Searchable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'theme', 'role_id', 'onboarding', 'avatar_path'];
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

    public function setPasswordAttribute($value) {
        if (Hash::needsRehash($value)) {
            return $this->attributes['password'] = bcrypt($value);
        } else {
            return $this->attributes['password'] = $value;
        }
    }

    public function getAvatarAttribute() {
        if ($this->avatar_path) {
            return asset('storage/'.$this->avatar_path);
        } else {
            return asset('img/models/user.png');
        }
    }

    public function getSearchResult(): SearchResult {
        $url = route('admin.accounts.edit', $this);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
