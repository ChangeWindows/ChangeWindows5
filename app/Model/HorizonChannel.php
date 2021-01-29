<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class HorizonChannel extends Model implements Searchable {
    use Sluggable;
    use HasFactory;

    // Meta data
    public $searchableType = 'Channels';

    protected $table = 'h_channels';
    protected $fillable = ['name', 'color', 'position', 'slug'];

    // Relations
    public function platforms() {
        return $this->belongsToMany(HorizonChannel::class, 'h_platform_channels', 'channel_id', 'platform_id')
            ->using(HorizonPlatformChannel::class)
            ->as('platforms')
            ->withPivot('name', 'short_name', 'active')
            ->withTimestamps();
    }

    public function flights() {
        return $this->hasMany(HorizonFlights::class);
    }

    // Additional attributes
    public function getBgColorAttribute() {
        return 'background-color: '.$this->color;
    }

    public function getTextColorAttribute() {
        return 'color: '.$this->color;
    }

    // System
    public function getRouteKeyName() {
        return 'slug';
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getSearchResult(): SearchResult {
        $url = route('admin.channels.edit', $this);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}