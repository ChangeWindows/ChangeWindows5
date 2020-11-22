<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Milestone extends Model implements Searchable
{
    protected $table = 'milestones';
    public $incrementing = false;

    protected $dates = ['created_at', 'updated_at', 'preview', 'public', 'mainEol', 'mainXol', 'ltsEol'];

    protected $fillable = ['id', 'osname', 'name', 'codename', 'version', 'color', 'preview', 'public', 'mainEol', 'mainXol', 'ltsEol', 'isLts', 'pcFast', 'pcSlow', 'pcReleasePreview', 'pcTargeted', 'pcBroad', 'pcLTS', 'xboxSkip', 'xboxFast', 'xboxSlow', 'xboxPreview', 'xboxReleasePreview', 'xboxTargeted', 'serverSlow', 'serverTargeted', 'serverLTS', 'iotSlow', 'iotTargeted', 'iotBroad', 'teamTargeted', 'teamBroad', 'holographicFast', 'holographicSlow', 'holographicTargeted', 'holographicBroad', 'holographicLTS', 'tenXSlow', 'sdk', 'iso'];

    public function releases() {
        return $this->hasMany(Release::class, 'milestone');
    }

    public function getBgColorAttribute() {
        return 'background-color: #'.$this->color;
    }

    public function getSearchResult(): SearchResult {
        $url = route('admin.milestones.edit', $this);

        return new SearchResult(
            $this,
            $this->version,
            $url
        );
    }

    public function getSupport() {
        $now = Carbon::now();

        $preview_period = $this->public->timestamp > 0 ? $this->preview->diffInDays($this->public) : 0;
        $public_period = $this->mainEol->timestamp > 0 ? $this->public->diffInDays($this->mainEol) : 0;
        $extended_period = $this->mainXol->timestamp > 0 ? $this->mainEol->diffInDays($this->mainXol) : 0;
        $lts_period = $this->ltsEol->timestamp > 0 ? $this->mainXol->diffInDays($this->ltsEol) : 0;

        $total = ($preview_period + $public_period + $extended_period + $lts_period) / 100;

        if ($total !== 0) {
            if ($this->preview->lessThanOrEqualTo($now) && $this->public->greaterThan($now)) {
                $preview_done = $this->preview->diffInDays($this->now);
                $preview_go = $preview_period - $preview_done;

                $public_done = $extended_done = $lts_done = 0;
                $public_go = $public_period;
                $extended_go = $extended_period;
                $lts_go = $lts_period;
            } else if ($this->public->lessThanOrEqualTo($now) && $this->mainEol->greaterThanOrEqualTo($now)) {
                // We flip this to "greaterThanOrEqualTo" instead of "greaterThan" because these dates indicate the last day of support
                $public_done = $this->public->diffInDays($this->now);
                $public_go = $public_period - $public_done;

                $preview_go = $extended_done = $lts_done = 0;
                $preview_done = $preview_period;
                $extended_go = $extended_period;
                $lts_go = $lts_period;
            } else if ($this->mainEol->lessThan($now) && $this->mainXol->greaterThanOrEqualTo($now)) {
                $extended_done = $this->mainEol->diffInDays($this->now);
                $extended_go = $extended_period - $extended_done;

                $preview_go = $public_go = $lts_done = 0;
                $preview_done = $preview_period;
                $public_done = $public_period;
                $lts_go = $lts_period;
            } else if ($this->mainXol->lessThan($now) && $this->ltsEol->greaterThanOrEqualTo($now)) {
                $lts_done = $this->mainXol->diffInDays($this->now);
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

    public function getFlights() {
        return array(
            'pc' => array(
                'skip' => -1,
                'fast' => $this->pcFast,
                'slow' => $this->pcSlow,
                'preview' => -1,
                'release' => $this->pcReleasePreview,
                'targeted' => $this->pcTargeted,
                'broad' => $this->pcBroad,
                'ltsc' => $this->pcLTS
            ),
            'xbox' => array(
                'skip' => $this->xboxSkip,
                'fast' => $this->xboxFast,
                'slow' => $this->xboxSlow,
                'preview' => $this->xboxPreview,
                'release' => $this->xboxReleasePreview,
                'targeted' => $this->xboxTargeted,
                'broad' => -1,
                'ltsc' => -1
            ),
            'server' => array(
                'skip' => -1,
                'fast' => -1,
                'slow' => $this->serverSlow,
                'preview' => -1,
                'release' => -1,
                'targeted' => $this->serverTargeted,
                'broad' => -1,
                'ltsc' => $this->serverLTS
            ),
            'tenx' => array(
                'skip' => -1,
                'fast' => -1,
                'slow' => $this->tenXSlow,
                'preview' => -1,
                'release' => -1,
                'targeted' => -1,
                'broad' => -1,
                'ltsc' => -1
            ),
            'holographic' => array(
                'skip' => -1,
                'fast' => $this->holographicFast,
                'slow' => $this->holographicSlow,
                'preview' => -1,
                'release' => -1,
                'targeted' => $this->holographicTargeted,
                'broad' => $this->holographicBroad,
                'ltsc' => $this->holographicLTS
            ),
            'iot' => array(
                'skip' => -1,
                'fast' => -1,
                'slow' => $this->iotSlow,
                'preview' => -1,
                'release' => -1,
                'targeted' => $this->iotTargeted,
                'broad' => $this->iotBroad,
                'ltsc' => -1
            ),
            'team' => array(
                'skip' => -1,
                'fast' => $this->teamFast,
                'slow' => $this->teamSlow,
                'preview' => -1,
                'release' => -1,
                'targeted' => $this->teamTargeted,
                'broad' => $this->teamBroad,
                'ltsc' => -1
            ),
            'sdk' => array(
                'skip' => -1,
                'fast' => -1,
                'slow' => -1,
                'preview' => -1,
                'release' => -1,
                'targeted' => $this->sdk,
                'broad' => -1,
                'ltsc' => -1
            ),
            'iso' => array(
                'skip' => -1,
                'fast' => -1,
                'slow' => -1,
                'preview' => -1,
                'release' => -1,
                'targeted' => $this->iso,
                'broad' => -1,
                'ltsc' => -1
            )
        );
    }
}
