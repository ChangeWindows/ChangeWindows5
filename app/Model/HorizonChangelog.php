<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class HorizonChangelog extends Model implements Searchable {
    use HasFactory;

    // Meta data
    public $searchableType = 'Changelogs';

    protected $table = 'h_changelogs';
    protected $fillable = ['milestone_platform_id', 'changelog'];
    protected $dates = ['created_at', 'updated_at'];

    // Relations
    public function milestone_platform() {
        return $this->belongsTo(MilestonePlatform::class, 'milestone_platform_id');
    }

    // System
    public function getSearchResult(): SearchResult {
        $url = route('admin.changelogs.edit', $this);

        return new SearchResult(
            $this,
            $this->changelog,
            $url
        );
    }
}
