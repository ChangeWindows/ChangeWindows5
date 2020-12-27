<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorizonMilestonePlatformChannel extends Model {
    use HasFactory;

    // Meta data
    protected $table = 'h_milestone_platform_channels';
    protected $fillable = ['milestone_platform_id', 'platform_channel_id', 'active'];
}
