<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Carbon\Carbon;
use App\Milestone;

class Release extends Model implements Feedable
{
    protected $table = 'releases';

    protected $dates = ['created_at', 'updated_at', 'date'];

    protected $fillable = array('major', 'minor', 'build', 'delta', 'milestone', 'platform', 'ring', 'date');

    public function toFeedItem()
    {
        return FeedItem::create([
            'id' => $this->build,
            'title' => $this->build.'.'.$this->delta.' for '.getPlatformById($this->platform).' in '.getRingById($this->ring),
            'summary' => $this->major.'.'.$this->minor.'.'.$this->build.'.'.$this->delta.' for '.getPlatformById($this->platform).' has been released for '.getRingById($this->ring),
            'updated' => $this->date,
            'link' => 'https://changewindows.org/build/'.$this->build.'/'.getPlatformClass($this->platform),
            'author' => 'ChangeWindows'
        ]);
    }

    public static function getFeedItems() {
        return Release::orderBy('date', 'desc')->limit(100)->get();
    }

    public function ms() {
        return $this->belongsTo('App\Milestone', 'milestone');
    }

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
            switch ( $this->platform ) {
                case 3:
                    return 'Production';
                case 8:
                case 9:
                    return 'Public';
                default:
                    return 'Targeted';
            }
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
        $delta = $string['delta'];
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
            else if ( $build < 18363 ) {
                if ( $delta < 7000 )
                    $milestone = '19h1';
                else
                    $milestone = '19h2';
            }
            else if ( $build < 18501 )
                $milestone = '19h2';
            else if ( $build < 19100 )
                $milestone = '20h1';
            else if ( $build < 19800 )
                $milestone = 'manganese';
            else
                $milestone = 'manganese';
        }

        return $milestone;

        // Damn it.
        // In all fairness, this needs a bottom and top range for which build should be in which milestone
        // additionally, the create build form should have an override for the early skip ahead builds
    }

    // Release scopes
    public function scopePc($query) { return $query->where('platform', '1'); }
    public function scopeMobile($query) { return $query->where('platform', '2'); }
    public function scopeXbox($query) { return $query->where('platform', '3'); }
    public function scopeServer($query) { return $query->where('platform', '4'); }
    public function scopeHolographic($query) { return $query->where('platform', '5'); }
    public function scopeIot($query) { return $query->where('platform', '6'); }
    public function scopeTeam($query) { return $query->where('platform', '7'); }
    public function scopeIso($query) { return $query->where('platform', '8'); }
    public function scopeSdk($query) { return $query->where('platform', '9'); }

    public function scopeLeak($query) { return $query->where('ring', '0'); }
    public function scopeSkip($query) { return $query->where('ring', '1'); }
    public function scopeActive($query) { return $query->where('ring', '2'); }
    public function scopeSlow($query) { return $query->where('ring', '3'); }
    public function scopePreview($query) { return $query->where('ring', '4'); }
    public function scopeRelease($query) { return $query->where('ring', '5'); }
    public function scopeTargeted($query) { return $query->where('ring', '6'); }
    public function scopeBroad($query) { return $query->where('ring', '7'); }
    public function scopeLtsc($query) { return $query->where('ring', '8'); }

    public function scopeLatestFlight($query) { return $query->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc'); }
    public function scopeAllRings($query) { return $query->groupBy('ring')->get()->keyBy('ring'); }

    public function scopePlatformRings($query, $platform) {
        switch ($platform) {
            case 1:     $rings = array(1, 2, 3, 5, 6, 7, 8); break;
            case 2:     $rings = array(6, 7); break;
            case 3:     $rings = array(1, 2, 3, 4, 5, 6); break;
            case 4:     $rings = array(3, 6, 8); break;
            case 5:     $rings = array(2, 3, 6, 7, 8); break;
            case 6:     $rings = array(3, 6, 7); break;
            case 7:     $rings = array(6, 7); break;
            case 8:     $rings = array(6); break;
            case 9:     $rings = array(6); break;
            default:    return;
        }

        return $query->where('platform', $platform)->whereIn('ring', $rings);
    }
}
