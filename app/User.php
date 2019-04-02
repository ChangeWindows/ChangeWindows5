<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [ 'name', 'email', 'password', 'theme' ];
    protected $hidden = [ 'password', 'remember_token', ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles($roles) {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized.');
        }

        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles) {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role) {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function getRoles() {
        return $this->roles()->firstOrFail();
    }

    public function getBadge() {
        switch ($this->getRoles()['name']) {
            case 'Admin':               return ['fa-user-crown', 'admin']; break;
            case 'Editor':              return ['fa-user-edit', 'editor']; break;
            case 'Platinum Insider':    return ['fa-crown', 'platinum']; break;
            case 'Gold Insider':        return ['fa-crown', 'gold']; break;
            case 'Silver Insider':      return ['fa-crown', 'silver']; break;
            case 'Bronze Insider':      return ['fa-crown', 'bronze']; break;
            default:                    return null; break;
        }
    }
}
