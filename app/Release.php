<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Release extends Model
{
    protected $table = 'releases';

    protected $dates = ['created_at', 'updated_at', 'date'];

    protected $fillable = array('major', 'minor', 'build', 'delta', 'milestone', 'platform', 'ring', 'date');

    public function getFormatAttribute() {
        return $this->date->format('d M Y');
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
            return 'LTSC';
    }

    public function getClassAttribute() {
        if ( $this->ring == 0 )
            return 'leak';
        if ( $this->ring == 1 )
            return 'skip';
        if ( $this->ring == 2 )
            return 'fast';
        if ( $this->ring == 3 )
            return 'slow';
        if ( $this->ring == 4 )
            return 'preview';
        if ( $this->ring == 5 )
            return 'release';
        if ( $this->ring == 6 )
            return 'targeted';
        if ( $this->ring == 7 )
            return 'broad';
        if ( $this->ring == 8 )
            return 'ltsc';
    }

    static function splitString( $build_string ) {
        // Figure out the location of dots
        $first_dot = strpos( $build_string, '.', 0 ) + 1; // Major kernel - minor kernel
        $second_dot = strpos( $build_string, '.', $first_dot ) + 1; // Minor kernel - build
        $third_dot = strpos( $build_string, '.', $second_dot ) + 1; // Build - delta

        // Get the major kernel number
        $major = substr( $build_string, 0, $first_dot - 1 );

        // Get the minor kernel number
        $minor_length = $second_dot - $first_dot - 1;
        $minor = substr( $build_string, $first_dot, $minor_length );

        // Get the build number
        $build_length = $third_dot - $second_dot - 1;
        $build = substr( $build_string, $second_dot, $build_length );

        // Get the delta number
        $delta = substr( $build_string, $third_dot );

        $string['major'] = $major;
        $string['minor'] = $minor;
        $string['build'] = $build;
        $string['delta'] = $delta;

        return $string;
    }

    static function getMilestoneByString($string) {
        $build = $string['build'];
        $major = $string['major'];

        // DO NOT HARDCODE DO NOT HARDCODE DO NOT HARDCODE
        if ( $major == 7 ) {
            if ( $build < 7500 )
                $milestone = 'photon';
            else
                $milestone = 'mango';
        } else {
            if ( $build < 9250 )
                $milestone = 'eight';
            else if ( $build < 9700 )
                $milestone = 'blue';
            else if ( $build < 10250 )
                $milestone = 'threshold1';
            else if ( $build < 10600 )
                $milestone = 'threshold2';
            else if ( $build < 14400 )
                $milestone = 'redstone1';
            else if ( $build < 16000 )
                $milestone = 'redstone2';
            else if ( $build < 16300 )
                $milestone = 'redstone3';
            else if ( $build < 17200 )
                $milestone = 'redstone4';
            else if ( $build < 17900 )
                $milestone = 'redstone5';
            else if ( $build < 18500 )
                $milestone = '19h1';
            else
                $milestone = 'vanadium';
        }
        
        return $milestone;

        // Damn it.
        // In all fairness, this needs a bottom and top range for which build should be in which milestone
        // additionally, the create build form should have an override for the early skip ahead builds
    }
}
