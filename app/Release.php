<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $table = 'releases';

    protected $dates = ['created_at', 'updated_at', 'date'];

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

    public function getPlatformImgAttribute() {
        switch ($this->platform) {
            case 1:     return 'pc.png';
            case 2:     return 'mobile.png';
            case 3:     return 'xbox.png';
            case 4:     return 'server.png';
            case 5:     return 'holographic.png';
            case 6:     return 'iot.png';
            case 7:     return 'team.png';
            case 8:     return 'iso.png';
            case 9:     return 'sdk.png';
            default:    return;
        }
    }

    public function getFlightAttribute() {
        if ( $this->ring == 0 )
            return 'Leak';
        if ( $this->ring == 1 )
            return 'Skip';
        if ( $this->ring == 2 )
            switch ( $this->platform ) {
                case 3:
                    return 'Alpha';
                default:
                    return 'Fast';
            }
        if ( $this->ring == 3 )
            switch ( $this->platform ) {
                case 1:
                case 2:
                case 5:
                    return 'Slow';
                case 3:
                    return 'Beta';
                default:
                    return 'Preview';
            }
        if ( $this->ring == 4 )
            switch ( $this->platform ) {
                case 3:
                    return 'Delta';
                default:
                    return 'Preview';
            }
        if ( $this->ring == 5 )
            switch ( $this->platform ) {
                case 3:
                    return 'Omega';
                default:
                    return 'Preview';
            }
        if ( $this->ring == 6 )
            return 'Targeted';
        if ( $this->ring == 7 )
            return 'Broad';
        if ( $this->ring == 8 )
            return 'LTS';
    }
}
