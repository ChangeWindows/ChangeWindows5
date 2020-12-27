<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class HorizonFlight extends Model implements Feedable, Searchable {
    use HasFactory;

    // Meta data
    public $searchableType = 'Flights';

    protected $table = 'h_flights';
    protected $fillable = ['major', 'minor', 'build', 'delta', 'date', 'milestone_id', 'platform_id', 'channel_id', 'user_id'];
    protected $dates = ['created_at', 'updated_at', 'date'];

    // Relations
    public function channel() {
        return $this->belongsTo(HorizonChannel::class, 'h_channels', 'channel_id');
    }
    
    public function milestone() {
        return $this->belongsTo(HorizonMilestone::class, 'h_milestones', 'milestone_id');
    }
    
    public function platform() {
        return $this->belongsTo(HorizonPlatform::class, 'h_platforms', 'platform_id');
    }
    
    public function user() {
        return $this->belongsTo(HorizonUser::class, 'h_users', 'user_id');
    }

    // Additional attributes
    public function getFormatAttribute() {
        return $this->date->format('d M Y');
    }

    // System
    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'codename'
            ]
        ];
    }

    public function getSearchResult(): SearchResult {
        $url = route('admin.flights.edit', $this);

        return new SearchResult(
            $this,
            $this->build.'.'.$this->delta,
            $url
        );
    }

    public function toFeedItem(): FeedItem {
        return FeedItem::create([
            'id' => $this->build,
            'title' => $this->build.'.'.$this->delta.' for '.$this->platform->name.' in '.$this->channel->name,
            'summary' => $this->major.'.'.$this->minor.'.'.$this->build.'.'.$this->delta.' for '.$this->platform->name.' has been released for '.$this->ring->channel,
            'updated' => $this->date,
            'link' => 'https://changewindows.org/build/'.$this->build.'/'.$this->platform->slug,
            'author' => 'ChangeWindows'
        ]);
    }

    public static function getFeedItems() {
        return Flight::orderBy('date', 'desc')->limit(100)->get();
    }
}
