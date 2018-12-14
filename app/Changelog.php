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

    public function getDeviceAttribute() {
        switch ($this->platform) {
            case 1:     return 'PC';
            case 2:     return 'Mobile';
            case 3:     return 'Xbox';
            case 4:     return 'Server';
            case 5:     return 'Holographic';
            case 6:     return 'IoT';
            case 7:     return 'Team';
            case 8:     return 'ISO';
            case 9:     return 'SDK';
            default:    return;
        }
    }
}
