<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Changelog;
use Parsedown;

class TimelineController extends Controller
{
    public function index() {
        $releases = Release::orderBy('date', 'desc')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(50)->onEachSide(1);

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
        }
        
        $set['pc'] = Release::platformRings(1)->latestFlight()->allRings();
        $set['xbox'] = Release::platformRings(3)->latestFlight()->allRings();
        $set['server'] = Release::platformRings(4)->latestFlight()->allRings();
        $set['iot'] = Release::platformRings(6)->latestFlight()->allRings();
        $set['holo'] = Release::platformRings(5)->latestFlight()->allRings();
        $set['team'] = Release::platformRings(7)->latestFlight()->allRings();
        $set['mobile'] = Release::platformRings(2)->latestFlight()->allRings();
        $set['sdk'] = Release::platformRings(8)->latestFlight()->allRings();
        $set['iso'] = Release::platformRings(9)->latestFlight()->allRings();

        foreach($set as $platform => $rings) {
            foreach($rings as $ring => $release) {
                $flights[$platform][getRingClassById($ring)] = $release;
            }
        }

        return view('timeline', compact('releases', 'flights', 'timeline'));
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
        }

        return redirect('/');
    }

    public function show($build, $platform = null) {
        $cur_build = $build;
        $cur_platform = $platform === null ? '1' : $platform;

        if ($platform) {
            $releases = Release::where('build', $cur_build)->where('platform', $platform)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->get();
        } else {
            $releases = Release::where('build', $cur_build)->orderBy('date', 'asc')->orderBy('delta', 'asc')->orderBy('ring', 'asc')->paginate(50);
        }

        $platforms = Release::select('platform')->where('build', $cur_build)->orderBy('platform', 'asc')->distinct()->get();

        $changelogs = Changelog::where('build', $cur_build)->where('platform', $cur_platform)->orWhere('build', $cur_build)->where('platform', '0')->orderBy('platform', 'desc')->get();

        $meta = Release::where('build', $cur_build)->where('platform', $platform)->first();

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
            $notes[$release->delta]['rings'][$release->ring] = $release;
        }

        foreach ($changelogs as $changelog) {
            $notes[$changelog->delta]['changelog'] = $changelog->changelog;
        }

        $parsedown = new Parsedown();

        return view('build', compact('timeline', 'platforms', 'notes', 'meta', 'cur_build', 'cur_platform', 'parsedown'));
    }
}
