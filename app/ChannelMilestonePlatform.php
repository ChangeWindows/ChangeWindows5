<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelMilestonePlatform extends Model {
    use HasFactory;

    protected $table = 'channel_milestone_platforms';
    protected $fillable = ['channel_platform_id', 'milestone_platform_id', 'active'];

    public function channelPlatform() {
        return $this->belongsTo(ChannelPlatform::class);
    }

    public function milestonePlatform() {
        return $this->belongsTo(MilestonePlatform::class);
    }
}
