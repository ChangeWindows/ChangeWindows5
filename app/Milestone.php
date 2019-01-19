<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Milestone extends Model
{
    protected $table = 'milestones';
    public $incrementing = false;

    protected $dates = ['created_at', 'updated_at', 'preview', 'public', 'mainEol', 'mainXol', 'ltsEol'];

    protected $fillable = ['id', 'osname', 'name', 'codename', 'version', 'color', 'description', 'preview', 'public', 'mainEol', 'mainXol', 'ltsEol', 'isLts', 'pcSkip', 'pcFast', 'pcSlow', 'pcReleasePreview', 'pcTargeted', 'pcBroad', 'pcLTS', 'mobileFast', 'mobileSlow', 'mobileReleasePreview', 'mobileTargeted', 'mobileBroad', 'xboxSkip', 'xboxFast', 'xboxSlow', 'xboxPreview', 'xboxReleasePreview', 'xboxTargeted', 'serverSlow', 'serverTargeted', 'serverLTS', 'iotSlow', 'iotTargeted', 'iotBroad', 'teamTargeted', 'teamBroad', 'holographicFast', 'holographicSlow', 'holographicTargeted', 'holographicBroad', 'holographicLTS', 'sdk', 'iso'];

    public function getSupport() {
        $now = Carbon::now();

        $preview_period = $this->public->timestamp > 0 ? $this->preview->diffInDays($this->public) : 0;
        $public_period = $this->mainEol->timestamp > 0 ? $this->public->diffInDays($this->mainEol) : 0;
        $extended_period = $this->mainXol->timestamp > 0 ? $this->mainEol->diffInDays($this->mainXol) : 0;
        $lts_period = $this->ltsEol->timestamp > 0 ? $this->mainXol->diffInDays($this->ltsEol) : 0;

        $total = ($preview_period + $public_period + $extended_period + $lts_period) / 100;

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
    }
}
