<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class HorizonPlatformChannel extends Pivot {
    use HasFactory;

    // Meta data
    protected $table = 'h_platform_channels';
    protected $fillable = ['channel_id', 'platform_id', 'name', 'short_name', 'active'];

    public function channel() {
        return $this->belongsTo(HorizonChannel::class);
    }

    public function platform() {
        return $this->belongsTo(HorizonPlatform::class);
    }
}
