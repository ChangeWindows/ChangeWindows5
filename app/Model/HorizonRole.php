<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorizonRole extends Model {
    use HasFactory;

    // Meta data
    protected $table = 'h_roles';
    protected $fillable = ['name', 'description', 'is_default'];

    // Relations
    public function users() {
        return $this->hasMany(HorizonUser::class);
    }

    public function abilities() {
        return $this->belongsToMany(HorizonAbility::class, 'h_role_abilities', 'role_id', 'ability_id');
    }

    // Functions
    public function allowTo(Ability $ability) {
        $this->abilities()->sync($ability, false);
    }
}
