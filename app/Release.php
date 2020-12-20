<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Carbon\Carbon;
use App\Milestone;

class Release extends Model implements Feedable, Searchable
{
    protected $table = 'releases';

    protected $dates = ['created_at', 'updated_at', 'date'];

    protected $fillable = array('major', 'minor', 'build', 'delta', 'milestone', 'platform', 'ring', 'date');

    public function toFeedItem(): FeedItem
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

    public function getSearchResult(): SearchResult {
        $url = route('admin.flights.edit', $this);

        return new SearchResult(
            $this,
            $this->build.'.'.$this->delta,
            $url
        );
    }

    public function getFlightAttribute() {
        if ( $this->ring == 0 )
            return 'Leak';
        if ( $this->ring == 1 )
            return 'Skip';
        if ( $this->ring == 2 )
            switch ( $this->platform ) {
                case 1:
                    return 'Dev';
                case 3:
                    return 'Alpha';
                default:
                    return 'Fast';
            }
        if ( $this->ring == 3 )
            switch ( $this->platform ) {
                case 1:
                    case 3:
                    return 'Beta';
                case 2:
                case 5:
                    return 'Slow';
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
                case 1:
                    return 'Release Preview';
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

        $milestone = Milestone::where('start_build', '<=', $build)->orderBy('start_build', 'desc')->first();

        return $milestone->id;
    }
}
