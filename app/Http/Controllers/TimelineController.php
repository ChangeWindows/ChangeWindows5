<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Changelog;
use App\Milestone;
use Parsedown;

class TimelineController extends Controller
{
    public function index(Request $request) {
        $platform_id = getPlatformIdByClass($request->platform);
        $ring_id = getRingIdByClass($request->ring);
        $timeline = [];

        $releases = Release::when(request('ring', false), function ($query, $ring_id) {
                                return $query->where('ring', getRingIdByClass($ring_id));
                            })->when(request('platform', false), function ($query, $platform_id) {
                                return $query->where('platform', getPlatformIdByClass($platform_id));
                            })->orderBy('date', 'desc')
                            ->orderBy('platform', 'asc')
                            ->orderBy('build', 'desc')
                            ->orderBy('delta', 'desc')
                            ->orderBy('ring', 'desc')
                            ->paginate(50)
                            ->onEachSide(1);

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
        }

        $flights['pc']['skip'] = Release::pc()->skip()->latestFlight()->first();
        $flights['pc']['fast'] = Release::pc()->active()->latestFlight()->first();
        $flights['pc']['slow'] = Release::pc()->slow()->latestFlight()->first();
        $flights['pc']['release'] = Release::pc()->release()->latestFlight()->first();
        $flights['pc']['targeted'] = Release::pc()->targeted()->latestFlight()->first();
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

        $flights['iot']['slow'] = Release::iot()->slow()->latestFlight()->first();
        $flights['iot']['targeted'] = Release::iot()->targeted()->latestFlight()->first();

        $flights['holo']['fast'] = Release::holographic()->active()->latestFlight()->first();
        $flights['holo']['slow'] = Release::holographic()->slow()->latestFlight()->first();
        $flights['holo']['targeted'] = Release::holographic()->targeted()->latestFlight()->first();
        $flights['holo']['ltsc'] = Release::holographic()->ltsc()->latestFlight()->first();

        $flights['team']['fast'] = Release::team()->active()->latestFlight()->first();
        $flights['team']['slow'] = Release::team()->slow()->latestFlight()->first();
        $flights['team']['targeted'] = Release::team()->targeted()->latestFlight()->first();

        $flights['mobile']['targeted'] = Release::mobile()->targeted()->latestFlight()->first();

        $flights['sdk']['targeted'] = Release::sdk()->targeted()->latestFlight()->first();
        $flights['iso']['targeted'] = Release::iso()->targeted()->latestFlight()->first();

        $user_agent = $request->server('HTTP_USER_AGENT');

        if ( strpos( $user_agent, 'Edge/' ) ) {
            $edge_agent = substr($user_agent, strrpos($user_agent, 'Edge/'));
            $ua['build'] = substr($edge_agent, strrpos($edge_agent, '.') + 1);

            if ( strpos( $user_agent, 'Xbox' ) ) {
                $ua['platform'] = 'xbox';
            } else if ( strpos( $user_agent, 'Windows Phone' ) ) {
                $ua['platform'] = 'mobile';
            } else if ( strpos( $user_agent, 'Windows IoT' ) ) {
                $ua['platform'] = 'iot';
            } else {
                $ua['platform'] = 'pc';
            }

            $ua_release = Release::where('build', $ua['build'])->where('platform', getPlatformIdByClass($ua['platform']))->first();

            $ua['milestone'] = $ua_release ? $ua_release->milestone : 'tba';
        } else {
            $ua = false;
        }

        return view('timeline', compact('releases', 'flights', 'timeline', 'ua', 'request'));
    }

    public function show($build, $platform = null) {
        $cur_build = $build;
        $platform_id = $platform === null ? 1 : getPlatformIdByClass($platform);

        $platforms = Release::select('platform')->where('build', $cur_build)->orderBy('platform', 'asc')->distinct()->get();

        if ($platforms->count() < 1) {
            abort(404);
        }

        if ($platform) {
            $releases = Release::where('build', $cur_build)->where('platform', $platform_id)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->get();

            if ($releases->count() < 1) {
                $platform_id = $platforms[0]->platform;
                $releases = Release::where('build', $cur_build)->where('platform', $platforms[0]->platform)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->paginate(50);
            }
        } else {
            $platform_id = $platforms[0]->platform;
            $releases = Release::where('build', $cur_build)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->paginate(50);
        }


        $milestone = $releases[0]->ms;

        $changelogs = Changelog::where('build', $cur_build)->where('platform', $platform_id)->orWhere('build', $cur_build)->where('platform', '0')->orderBy('platform', 'desc')->get()->keyBy('delta');

        $meta = Release::where('build', $cur_build)->where('platform', $platform_id)->first();

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
            $notes[$release->delta]['rings'][$release->ring] = $release;
        }

        foreach ($changelogs as $changelog) {
            if (array_key_exists($changelog->delta, $notes)) {
                $notes[$changelog->delta]['changelog'] = $changelog->changelog;
                $notes[$changelog->delta]['created'] = $changelog->created_at;
                $notes[$changelog->delta]['new'] = $changelog->created_at->addDay();
            }
        }

        $previous = Release::where('build', '<', $cur_build)->orderBy('build', 'desc')->first();
        $next = Release::where('build', '>', $cur_build)->orderBy('build', 'asc')->first();

        $parsedown = new Parsedown();

        return view('build', compact('timeline', 'platforms', 'notes', 'meta', 'cur_build', 'parsedown', 'milestone', 'next', 'previous'));
    }

    public function build($milestone, $build = null, $platform = null) {
        $cur_build = $build;
        $cur_milestone = $milestone;
        $platform_id = $platform === null ? 1 : getPlatformIdByClass($platform);

        // Get current build and milestone information
        $meta = Release::where('build', $cur_build)->where('platform', $platform_id)->first();
        $milestone = Milestone::find($milestone);

        // Get the available platforms from a build and check if move to the first platform that is available
        $platforms = Release::select('platform')->where('milestone', $cur_milestone)->where('build', $cur_build)->orderBy('platform', 'asc')->distinct()->get();

        if ($platforms->count() < 1) {
            abort(404);
        }

        if ($platform) {
            $releases = Release::where('milestone', $cur_milestone)->where('build', $cur_build)->where('platform', $platform_id)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->get();

            if ($releases->count() < 1) {
                $platform_id = $platforms[0]->platform;
                $releases = Release::where('milestone', $cur_milestone)->where('build', $cur_build)->where('platform', $platforms[0]->platform)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->paginate(50);
            }
        } else {
            $platform_id = $platforms[0]->platform;
            $releases = Release::where('milestone', $cur_milestone)->where('build', $cur_build)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->paginate(50);
        }

        // Get all changelogs for the current platform
        $changelogs = Changelog::where('build', $cur_build)->where('platform', $platform_id)->orWhere('build', $cur_build)->where('platform', '0')->orderBy('platform', 'desc')->get()->keyBy('delta');

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
            $notes[$release->delta]['rings'][$release->ring] = $release;
        }

        foreach ($changelogs as $changelog) {
            if (array_key_exists($changelog->delta, $notes)) {
                $notes[$changelog->delta]['changelog'] = $changelog->changelog;
                $notes[$changelog->delta]['created'] = $changelog->created_at;
                $notes[$changelog->delta]['new'] = $changelog->created_at->addDay();
            }
        }

        // Get the previous and next navigation
        $previous = Release::where('build', '<', $cur_build)->orderBy('build', 'desc')->first();
        $next = Release::where('build', '>', $cur_build)->orderBy('build', 'asc')->first();

        $parsedown = new Parsedown();

        return view('build', compact('timeline', 'platforms', 'notes', 'meta', 'parsedown', 'milestone', 'next', 'previous'));
    }
}
