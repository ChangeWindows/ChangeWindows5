<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class HorizonMilestone extends Model implements Searchable {
    use Sluggable;
    use HasFactory;

    // Meta data
    public $searchableType = 'Milestones';

    protected $table = 'h_milestones';
    protected $fillable = ['product_name', 'name', 'codename', 'version', 'canonical_version', 'color', 'start_build', 'start_preview', 'start_public', 'start_extended', 'start_lts', 'end_lts'];
    protected $dates = ['created_at', 'updated_at', 'start_preview', 'start_public', 'start_extended', 'start_lts', 'end_lts'];

    // Relations
    public function platforms() {
        return $this->belongsToMany(HorizonPlatform::class, 'h_milestone_platforms', 'platform_id', 'milestone_id')
            ->using(HorizonPlatformChannel::class)
            ->as('platforms')
            ->withTimestamps();
    }

    public function milestonePlatforms() {
        return $this->hasMany(HorizonMilestonePlatform::class, 'milestone_id');
    }

    public function flights() {
        return $this->hasMany(HorizonFlights::class);
    }

    // Additional attributes
    public function getBgColorAttribute() {
        return 'background-color: #'.$this->color;
    }

    public function getTextColorAttribute() {
        return 'color: #'.$this->color;
    }

    public function getSupportAttribute() {
        $now = Carbon::now();

        $preview_period = $this->start_public->timestamp > 0 ? $this->preview->diffInDays($this->start_public) : 0;
        $public_period = $this->start_extended->timestamp > 0 ? $this->start_public->diffInDays($this->start_extended) : 0;
        $extended_period = $this->start_lts->timestamp > 0 ? $this->start_extended->diffInDays($this->start_lts) : 0;
        $lts_period = $this->end_lts->timestamp > 0 ? $this->start_lts->diffInDays($this->end_lts) : 0;

        $total = ($preview_period + $public_period + $extended_period + $lts_period) / 100;

        if ($total !== 0) {
            if ($this->preview->lessThanOrEqualTo($now) && $this->start_public->greaterThan($now)) {
                $preview_done = $this->preview->diffInDays($this->now);
                $preview_go = $preview_period - $preview_done;

                $public_done = $extended_done = $lts_done = 0;
                $public_go = $public_period;
                $extended_go = $extended_period;
                $lts_go = $lts_period;
            } else if ($this->start_public->lessThanOrEqualTo($now) && $this->start_extended->greaterThanOrEqualTo($now)) {
                // We flip this to "greaterThanOrEqualTo" instead of "greaterThan" because these dates indicate the last day of support
                $public_done = $this->start_public->diffInDays($this->now);
                $public_go = $public_period - $public_done;

                $preview_go = $extended_done = $lts_done = 0;
                $preview_done = $preview_period;
                $extended_go = $extended_period;
                $lts_go = $lts_period;
            } else if ($this->start_extended->lessThan($now) && $this->start_lts->greaterThanOrEqualTo($now)) {
                $extended_done = $this->start_extended->diffInDays($this->now);
                $extended_go = $extended_period - $extended_done;

                $preview_go = $public_go = $lts_done = 0;
                $preview_done = $preview_period;
                $public_done = $public_period;
                $lts_go = $lts_period;
            } else if ($this->start_lts->lessThan($now) && $this->end_lts->greaterThanOrEqualTo($now)) {
                $lts_done = $this->start_lts->diffInDays($this->now);
                $lts_go = $lts_period - $lts_done;

                $preview_go = $public_go = $extended_go = 0;
                $preview_done = $preview_period;
                $public_done = $public_period;
                $extended_done = $extended_period;
            } else {
                $preview_go = $public_go = $extended_go = $lts_go = 0;
                $preview_done = $preview_period;
                $public_done = $public_period;
                $extended_done = $extended_period;
                $lts_done = $lts_period;
            }

            return array(
                'preview_done' => $preview_done / $total,
                'preview_go' => $preview_go / $total,
                'public_done' => $public_done / $total,
                'public_go' => $public_go / $total,
                'extended_done' => $extended_done / $total,
                'extended_go' => $extended_go / $total,
                'lts_done' => $lts_done / $total,
                'lts_go' => $lts_go / $total
            );
        } else {
            return false;
        }
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
        $url = route('admin.milestones.edit', $this);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
