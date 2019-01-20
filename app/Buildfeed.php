<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Buildfeed extends Model
{
    protected $table = 'buildfeed';

    protected $dates = ['buildtime', 'leakdate'];
}
