<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ChannelMilestonePlatform;
use App\MilestonePlatform;
use App\ChannelPlatform;

class ChannelMilestonePlatformController extends Controller {
    public function store(MilestonePlatform $milestonePlatform, ChannelPlatform $channelPlatform) {
        $this->authorize('edit_milestone');

        $channelMilestonePlatform = ChannelMilestonePlatform::create([
            'milestone_platform_id' => $milestonePlatform->id,
            'channel_platform_id' => $channelPlatform->id,
            'active' => 1
        ]);

        return redirect()->back()->with('status', '<b>'.$channelPlatform->name.'</b> has been added to <b>'.$milestonePlatform->platform->name.'</b> for <b>'.$milestonePlatform->milestone->name.'</b>.');
    }

    public function toggle(ChannelMilestonePlatform $channelMilestonePlatform) {
        $this->authorize('edit_milestone');

        $channelMilestonePlatform->update([
            'active' => $channelMilestonePlatform->active === 1 ? 0 : 1
        ]);

        return redirect()->back()->with('status', '<b>'.$channelMilestonePlatform->channelPlatform->name.'</b> has been toggled for <b>'.$channelMilestonePlatform->milestonePlatform->platform->name.'</b> for <b>'.$channelMilestonePlatform->milestonePlatform->milestone->name.'</b>.');
    }

    public function destroy(ChannelMilestonePlatform $channelMilestonePlatform) {
        $this->authorize('edit_milestone');

        $channelMilestonePlatform->delete();

        return redirect()->back()->with('status', '<b>'.$channelMilestonePlatform->channelPlatform->name.'</b> has been removed from <b>'.$channelMilestonePlatform->milestonePlatform->platform->name.'</b> for <b>'.$channelMilestonePlatform->milestonePlatform->milestone->name.'</b>.');
    }
}
