<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Platform;
use Parsedown;

class TimelineController extends Controller
{
    public function index(Request $request) {
        $platform_id = getPlatformIdByClass($request->platform);
        $ring_id = getRingIdByClass($request->ring);
        $timeline = [];

        $releases = Release::select('releases.*', 'milestones.color', 'milestones.version')
                            ->when(request('ring', false), function ($query, $ring_id) {
                                return $query->where('ring', getRingIdByClass($ring_id));
                            })->when(request('platform', false), function ($query, $platform_id) {
                                return $query->where('platform', getPlatformIdByClass($platform_id));
                            })->join('milestones', 'milestones.id', '=', 'releases.milestone')
                            ->orderBy('date', 'desc')
                            ->orderBy('build', 'desc')
                            ->orderBy('platform', 'asc')
                            ->orderBy('delta', 'desc')
                            ->orderBy('ring', 'desc')
                            ->paginate(75)
                            ->onEachSide(1);

        // TODO: This is probably the crappiest piece of code in all of Viv
        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform]['default'] = $release;
        }
        
        // Sidebar
        $platforms = Platform::all();
        $flights = [];

        foreach($platforms as $platform) {
            foreach($platform->channelPlatforms as $channelPlatform) {
                if ($channelPlatform->active === "1") {
                    $flights[$platform->slug][$channelPlatform->channel->slug] = Release::where('platform', '=', $platform->id)
                                            ->where('ring', '=', $channelPlatform->channel->id)
                                            ->orderBy('build', 'desc')
                                            ->orderBy('delta', 'desc')
                                            ->orderBy('date', 'desc')
                                            ->first();
                }
            }
        }

        return view('timeline', compact('releases', 'flights', 'timeline', 'request'));
    }

    public function redirect($build, $platform = null) {
        $release = Release::where('build', '=', $build)->first();
        return redirect()->route('platformMilestone', ['id' => $release->milestone, 'platform' => $platform]);
    }
}
