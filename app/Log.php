<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = array('milestone_id', 'platform', 'changelog');

    public function milestone() {
        return $this->hasOne('App\Milestone', 'id', 'milestone_id');
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
