<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Tymon\JWTAuth\Contracts\JWTSubject;

class HorizonUser extends Authenticatable implements JWTSubject, Searchable {
    use HasFactory;
    use Notifiable;
    use Sluggable;

    // Meta data
    protected $table = 'h_users';

    protected $fillable = ['name', 'email', 'password', 'theme', 'role_id', 'onboarding', 'avatar_path'];
    protected $hidden = ['password', 'remember_token'];

    // Relations
    public function role() {
        return $this->belongsTo(HorizonRole::class, 'role_id');
    }

    public function flights() {
        return $this->hasMany(HorizonFlights::class);
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

    // Additional attributes
    public function setPasswordAttribute($value) {
        if (Hash::needsRehash($value)) {
            return $this->attributes['password'] = bcrypt($value);
        } else {
            return $this->attributes['password'] = $value;
        }
    }

    public function getAvatarAttribute() {
        if ($this->avatar_path) {
            return asset($this->avatar_path);
        } else {
            return asset('img/models/user.png');
        }
    }

    // System
    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
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
