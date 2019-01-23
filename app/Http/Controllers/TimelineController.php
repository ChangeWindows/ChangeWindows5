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

        $set['pc'] = Release::where('platform', '1')->whereIn('ring', array(1, 2, 3, 5, 6, 7, 8))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['xbox'] = Release::where('platform', '3')->whereIn('ring', array(1, 2, 3, 4, 5, 6))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['server'] = Release::where('platform', '4')->whereIn('ring', array(3, 6, 8))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['iot'] = Release::where('platform', '6')->whereIn('ring', array(3, 6, 7))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['holo'] = Release::where('platform', '5')->whereIn('ring', array(2, 3, 6, 7, 8))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['team'] = Release::where('platform', '7')->whereIn('ring', array(6, 7))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['mobile'] = Release::where('platform', '2')->whereIn('ring', array(6, 7))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['sdk'] = Release::where('platform', '9')->whereIn('ring', array(6))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['iso'] = Release::where('platform', '8')->whereIn('ring', array(6))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');

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
