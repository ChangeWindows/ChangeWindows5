<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
    protected $table = 'changelogs';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = array('build', 'delta', 'platform', 'changelog');

    static function splitString( $build_string ) {
        $temp = explode('.', $build_string);

        $string['build'] = $temp[0];
        $string['delta'] = $temp[1];

        return $string;
    }
}
