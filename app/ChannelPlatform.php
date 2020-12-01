<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelPlatform extends Model {
    use HasFactory;

    protected $table = 'channel_platforms';
    protected $fillable = ['channel_id', 'platform_id', 'name', 'short_name'];

    public function channel() {
        return $this->belongsTo(Channel::class);
    }

    public function platform() {
        return $this->belongsTo(Platform::class);
    }
}
