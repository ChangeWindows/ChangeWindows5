<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;

class TimelineController extends Controller
{
    public function index() {
        $releases = Release::orderBy('date', 'desc')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(50);

        foreach($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
        }

        $flights['pc']['skip'] = Release::where('platform', '1')->where('ring', '1')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['pc']['active'] = Release::where('platform', '1')->where('ring', '2')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['pc']['slow'] = Release::where('platform', '1')->where('ring', '3')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['pc']['release'] = Release::where('platform', '1')->where('ring', '5')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['pc']['target'] = Release::where('platform', '1')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['pc']['broad'] = Release::where('platform', '1')->where('ring', '7')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['pc']['ltsc'] = Release::where('platform', '1')->where('ring', '8')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['xbox']['skip'] = Release::where('platform', '3')->where('ring', '1')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['xbox']['active'] = Release::where('platform', '3')->where('ring', '2')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['xbox']['slow'] = Release::where('platform', '3')->where('ring', '3')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['xbox']['preview'] = Release::where('platform', '3')->where('ring', '4')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['xbox']['release'] = Release::where('platform', '3')->where('ring', '5')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['xbox']['target'] = Release::where('platform', '3')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['server']['slow'] = Release::where('platform', '4')->where('ring', '3')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['server']['target'] = Release::where('platform', '4')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['server']['ltsc'] = Release::where('platform', '4')->where('ring', '8')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['iot']['slow'] = Release::where('platform', '6')->where('ring', '3')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['iot']['target'] = Release::where('platform', '6')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['iot']['broad'] = Release::where('platform', '6')->where('ring', '7')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['holo']['active'] = Release::where('platform', '5')->where('ring', '2')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['holo']['slow'] = Release::where('platform', '5')->where('ring', '3')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['holo']['target'] = Release::where('platform', '5')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['holo']['broad'] = Release::where('platform', '5')->where('ring', '7')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['holo']['ltsc'] = Release::where('platform', '5')->where('ring', '8')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['team']['target'] = Release::where('platform', '7')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['team']['broad'] = Release::where('platform', '7')->where('ring', '7')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['mobile']['target'] = Release::where('platform', '2')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['mobile']['broad'] = Release::where('platform', '2')->where('ring', '7')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['sdk']['target'] = Release::where('platform', '9')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['iso']['target'] = Release::where('platform', '8')->where('ring', '6')->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

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
        if ($platform) {
            $releases = Release::where('build', $build)->where('platform', $platform)->orderBy('date', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(50);
        } else {
            $releases = Release::where('build', $build)->orderBy('date', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(50);
        }

        return view('build', compact('releases'));
    }
}
