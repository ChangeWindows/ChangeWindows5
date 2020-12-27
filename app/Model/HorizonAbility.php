<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorizonAbility extends Model {
    use HasFactory;

    // Meta data
    protected $table = 'h_abilities';
    protected $fillable = ['name', 'description'];


    // Relations
    public function roles() {
        return $this->belongsToMany(HorizonRole::class, 'h_role_abilities', 'ability_id', 'role_id');
    }
}
