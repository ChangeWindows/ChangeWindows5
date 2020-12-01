<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Channel extends Model implements Searchable {
    use Sluggable;
    use HasFactory;

    public $searchableType = 'Channels';

    protected $table = 'channels';
    protected $fillable = ['name', 'color', 'position', 'slug'];

    public function getBgColorAttribute() {
        return 'background-color: '.$this->color;
    }

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