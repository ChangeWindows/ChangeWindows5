<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Milestone;
use App\Platform;
use App\MilestonePlatform;
use App\ChannelPlatform;

class RingsController extends Controller
{
    public function index() {
        $platforms = Platform::all();
        $flights = [];

        foreach($platforms as $platform) {
            foreach($platform->channelPlatforms as $channelPlatform) {
                if ($channelPlatform->active === 1) {
                    $flights[$platform->slug][$channelPlatform->channel->slug] = Release::where('platform', '=', $platform->id)
                                            ->where('ring', '=', $channelPlatform->channel->id)
                                            ->orderBy('build', 'desc')
                                            ->orderBy('delta', 'desc')
                                            ->orderBy('date', 'desc')
                                            ->first();
                }
            }
        }

        return view('rings.index', compact('flights'));
    }

    public function platform(Request $request, $platform) {
        $set = [];
        $platform_id = getPlatformIdByClass($platform);

        $mps = MilestonePlatform::where('platform_id', '=', $platform_id)
                            ->orderBy('milestone_id')
                            ->get();

        $cps = ChannelPlatform::where('platform_id', '=', $platform_id)
                            ->orderBy('channel_id')
                            ->get();

        foreach($mps as $mp) {
            $set[$mp->milestone->start_build]['milestone'] = $mp->milestone;
            
            foreach($cps as $cp) {
                $set[$mp->milestone->start_build]['flights'][$cp->channel_id] = null;
            }

            foreach($mp->channelMilestonePlatforms as $cmp) {
                $release = Release::where('milestone', $cmp->milestonePlatform->milestone_id)
                                ->where('ring', $cmp->channelPlatform->channel_id)
                                ->where('platform', $cmp->channelPlatform->platform_id)
                                ->orderBy('date', 'desc')
                                ->first();

                $set[$mp->milestone->start_build]['flights'][$cmp->channelPlatform->channel_id]['flight'] = $release;
                $set[$mp->milestone->start_build]['flights'][$cmp->channelPlatform->channel_id]['channel'] = $cmp;
            }
        }

        $set = collect($set)->sortKeysDesc();

        return view('rings.platform', compact('set'));
    }
}
