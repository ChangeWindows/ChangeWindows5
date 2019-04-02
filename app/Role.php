<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $incrementing = false;
    
    public function users() {
        return $this->hasMany('App\User');
    }
}
