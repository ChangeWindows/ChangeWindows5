<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ChannelPlatform;

class ChannelPlatformController extends Controller {
    public function store() {
        $this->authorize('edit_platform');

        $this->validate(request(), [
            'channel' => ['required'],
            'platform' => ['required'],
            'name' => ['required'],
            'short_name' => ['required']
        ], [
            'channel.required' => 'A channel is required.',
            'platform.required' => 'A platform is required.',
            'name.required' => 'A platform is required.',
            'short_name.required' => 'A platform is required.'
        ]);

        $channelPlatform = ChannelPlatform::create([
            'channel_id' => request('channel'),
            'platform_id' => request('platform'),
            'name' => request('name'),
            'short_name' => request('short_name')
        ]);

        return redirect()->back()->with('status', '<b>'.$channelPlatform->channel->name.'</b> has been added to <b>'.$channelPlatform->platform->name.'</b>.');
    }

    public function destroy(ChannelPlatform $channelPlatform) {
        $this->authorize('edit_platform');

        $channelPlatform->delete();

        return redirect()->back()->with('status', '<b>'.$channelPlatform->channel->name.'</b> has been removed from <b>'.$channelPlatform->platform->name.'</b>.');
    }
}
