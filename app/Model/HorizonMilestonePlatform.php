<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorizonMilestonePlatform extends Model {
    use HasFactory;

    // Meta data
    protected $table = 'h_milestone_platforms';
    protected $fillable = ['milestone_id', 'platform_id'];

    // Relations
    public function changelog() {
        return $this->hasOne(HorizonChangelog::class, 'milestone_platform_id');
    }

    public function milestone() {
        return $this->belongsTo(HorizonMilestone::class);
    }

    public function platform() {
        return $this->belongsTo(HorizonPlatform::class);
    }

    public function mpcs() {
        return $this->hasMany(HorizonMilestonePlatformChannel::class, 'milestone_platform_id');
    }
}
