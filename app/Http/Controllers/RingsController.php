<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Milestone;
use App\MilestonePlatform;
use App\ChannelPlatform;

class RingsController extends Controller
{
    public function index() {
        $flights['pc']['fast'] = Release::pc()->active()->latestFlight()->first();
        $flights['pc']['slow'] = Release::pc()->slow()->latestFlight()->first();
        $flights['pc']['release'] = Release::pc()->release()->latestFlight()->first();
        $flights['pc']['targeted'] = Release::pc()->targeted()->latestFlight()->first();
        $flights['pc']['broad'] = Release::pc()->broad()->latestFlight()->first();
        $flights['pc']['ltsc'] = Release::pc()->ltsc()->latestFlight()->first();

        $flights['xbox']['skip'] = Release::xbox()->skip()->latestFlight()->first();
        $flights['xbox']['fast'] = Release::xbox()->active()->latestFlight()->first();
        $flights['xbox']['slow'] = Release::xbox()->slow()->latestFlight()->first();
        $flights['xbox']['preview'] = Release::xbox()->preview()->latestFlight()->first();
        $flights['xbox']['release'] = Release::xbox()->release()->latestFlight()->first();
        $flights['xbox']['targeted'] = Release::xbox()->targeted()->latestFlight()->first();

        $flights['server']['slow'] = Release::server()->slow()->latestFlight()->first();
        $flights['server']['targeted'] = Release::server()->targeted()->latestFlight()->first();
        $flights['server']['ltsc'] = Release::server()->ltsc()->latestFlight()->first();

        $flights['iot']['targeted'] = Release::iot()->targeted()->latestFlight()->first();
        $flights['iot']['broad'] = Release::iot()->broad()->latestFlight()->first();

        $flights['holo']['fast'] = Release::holographic()->active()->latestFlight()->first();
        $flights['holo']['slow'] = Release::holographic()->slow()->latestFlight()->first();
        $flights['holo']['targeted'] = Release::holographic()->targeted()->latestFlight()->first();
        $flights['holo']['broad'] = Release::holographic()->broad()->latestFlight()->first();
        $flights['holo']['ltsc'] = Release::holographic()->ltsc()->latestFlight()->first();

        $flights['team']['fast'] = Release::team()->active()->latestFlight()->first();
        $flights['team']['slow'] = Release::team()->slow()->latestFlight()->first();
        $flights['team']['targeted'] = Release::team()->targeted()->latestFlight()->first();
        $flights['team']['broad'] = Release::team()->broad()->latestFlight()->first();

        $flights['tenx']['slow'] = Release::tenX()->slow()->latestFlight()->first();

        $flights['sdk']['targeted'] = Release::sdk()->targeted()->latestFlight()->first();
        $flights['iso']['targeted'] = Release::iso()->targeted()->latestFlight()->first();

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
