<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patreon extends Model
{
    protected $table = 'patreon';

    protected $fillable = array('name', 'amount', 'email');
}
