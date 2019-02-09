<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Changelog;
use Parsedown;
use Twitter;

class TimelineController extends Controller
{
    public function index(Request $request) {
        $platform_id = getPlatformIdByClass($request->platform);
        $ring_id = getRingIdByClass($request->ring);

        $releases = Release::when(request('ring', false), function ($query, $ring_id) {
                                return $query->where('ring', getRingIdByClass($ring_id));
                            })->when(request('platform', false), function ($query, $platform_id) {
                                return $query->where('platform', getPlatformIdByClass($platform_id));
                            })->orderBy('date', 'desc')
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

        $flights['iot']['slow'] = Release::iot()->slow()->latestFlight()->first();
        $flights['iot']['targeted'] = Release::iot()->targeted()->latestFlight()->first();
        $flights['iot']['broad'] = Release::iot()->broad()->latestFlight()->first();

        $flights['holo']['fast'] = Release::holographic()->active()->latestFlight()->first();
        $flights['holo']['slow'] = Release::holographic()->slow()->latestFlight()->first();
        $flights['holo']['targeted'] = Release::holographic()->targeted()->latestFlight()->first();
        $flights['holo']['broad'] = Release::holographic()->broad()->latestFlight()->first();
        $flights['holo']['ltsc'] = Release::holographic()->ltsc()->latestFlight()->first();

        $flights['team']['targeted'] = Release::team()->targeted()->latestFlight()->first();
        $flights['team']['broad'] = Release::team()->broad()->latestFlight()->first();

        $flights['mobile']['targeted'] = Release::mobile()->targeted()->latestFlight()->first();
        $flights['mobile']['broad'] = Release::mobile()->broad()->latestFlight()->first();

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
        } else {
            $ua = false;
        }

        return view('timeline', compact('releases', 'flights', 'timeline', 'ua', 'platform_id', 'ring_id'));
    }

    public function store(Request $request) {
        $request->user()->authorizeRoles('Admin');
        
        $string = Release::splitString(request()->get('build_string'));
        $milestone = Release::getMilestoneByString($string);

        foreach(request()->get('flight') as $platform => $ring) {
            foreach($ring as $key => $value) {
                Release::create([
                    'major' => $string['major'],
                    'minor' => $string['minor'],
                    'build' => $string['build'],
                    'delta' => $string['delta'],
                    'milestone' => $milestone,
                    'platform' => $platform,
                    'ring' => $value,
                    'date' => request()->get('release')
                ]);
            }

            Twitter::postTweet(['status' => 'Build '.$string['build'].'.'.$string['delta'].' for '.getPlatformById($platform).' has been released! #Windows #WindowsInsiders https://changewindows.org/build/'.$string['build'].'/'.$platform, 'format' => 'json']);
        }

        return redirect('/');
    }

    public function show($build, $platform = null) {
        $cur_build = $build;
        $platform_id = $platform === null ? 1 : getPlatformIdByClass($platform);

        if ($platform) {
            $releases = Release::where('build', $cur_build)->where('platform', $platform_id)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->get();
        } else {
            $releases = Release::where('build', $cur_build)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->paginate(50);
        }

        $milestone = $releases[0]->ms;

        $platforms = Release::select('platform')->where('build', $cur_build)->orderBy('platform', 'asc')->distinct()->get();

        $changelogs = Changelog::where('build', $cur_build)->where('platform', $platform_id)->orWhere('build', $cur_build)->where('platform', '0')->orderBy('platform', 'desc')->get()->keyBy('delta');

        $meta = Release::where('build', $cur_build)->where('platform', $platform_id)->first();

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
            $notes[$release->delta]['rings'][$release->ring] = $release;
        }

        foreach ($changelogs as $changelog) {
            if (array_key_exists($changelog->delta, $notes)) {
                $notes[$changelog->delta]['changelog'] = $changelog->changelog;
            }
        }

        $parsedown = new Parsedown();

        return view('build', compact('timeline', 'platforms', 'notes', 'meta', 'cur_build', 'parsedown', 'milestone'));
    }
}
