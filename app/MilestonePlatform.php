<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilestonePlatform extends Model {
    use HasFactory;

    protected $table = 'milestone_platforms';
    protected $fillable = ['milestone_id', 'platform_id'];

    public function milestone() {
        return $this->belongsTo(Milestone::class);
    }

    public function platform() {
        return $this->belongsTo(Platform::class);
    }

    public function channelMilestonePlatforms() {
        return $this->hasMany(ChannelMilestonePlatform::class);
    }
}
