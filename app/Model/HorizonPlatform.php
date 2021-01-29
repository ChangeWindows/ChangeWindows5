<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class HorizonPlatform extends Model {
    use Sluggable;
    use HasFactory;

    // Meta data
    public $searchableType = 'Platforms';

    protected $table = 'h_platforms';
    protected $fillable = ['name', 'color', 'icon', 'position', 'active', 'slug'];
    protected $appends = ['plain_icon', 'colored_icon'];

    // Relations
    public function channels() {
        return $this->belongsToMany(HorizonChannel::class, 'h_platform_channels', 'platform_id', 'channel_id')
            ->using(HorizonPlatformChannel::class)
            ->withPivot('name', 'short_name', 'active')
            ->withTimestamps();
    }

    public function milestones() {
        return $this->belongsToMany(HorizonChannel::class, 'h_milestone_platforms', 'platform_id', 'platform_id')
            ->using(HorizonPlatformChannel::class)
            ->withTimestamps();
    }

    public function flights() {
        return $this->hasMany(HorizonFlights::class);
    }

    // Additional attributes
    public function getPlainIconAttribute() {
        return '<i class="far fa-fw fa-'.$this->icon.' '.$this->icon_modifiers.'"></i>';
    }

    public function getColoredIconAttribute() {
        return '<i style="color: '.$this->color.'" class="far fa-fw fa-'.$this->icon.' '.$this->icon_modifiers.'"></i>';
    }

    public function getBgColorAttribute() {
        return 'background-color: '.$this->color;
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
        $url = route('admin.platforms.edit', $this);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
