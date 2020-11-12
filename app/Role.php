<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $table = 'roles';
    protected $fillable = ['name', 'description', 'is_default'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class);
    }

    public function allowTo(Ability $ability) {
        $this->abilities()->sync($ability, false);
    }
}
