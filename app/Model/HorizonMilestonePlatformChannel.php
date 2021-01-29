<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorizonMilestonePlatformChannel extends Model {
    use HasFactory;

    // Meta data
    protected $table = 'h_milestone_platform_channels';
    protected $fillable = ['milestone_platform_id', 'platform_channel_id', 'active'];

    public function milestonePlatform() {
        return $this->belongsTo(HorizonMilestonePlatform::class, 'id', 'milestone_platform_id');
    }

    public function platformChannel() {
        return $this->belongsTo(HorizonPlatformChannel::class, 'platform_channel_id', 'id');
    }
}
