<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;

class TimelineController extends Controller
{
    public function index() {
        $releases = Release::orderBy('date', 'desc')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(50);

        $flights['PC']['skip'] = Release::where([['platform', '=', '1'], ['ring', '=', '1']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['PC']['active'] = Release::where([['platform', '=', '1'], ['ring', '=', '2']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['PC']['slow'] = Release::where([['platform', '=', '1'], ['ring', '=', '3']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['PC']['release'] = Release::where([['platform', '=', '1'], ['ring', '=', '5']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['PC']['target'] = Release::where([['platform', '=', '1'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['PC']['broad'] = Release::where([['platform', '=', '1'], ['ring', '=', '7']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['PC']['ltsc'] = Release::where([['platform', '=', '1'], ['ring', '=', '8']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['Xbox']['skip'] = Release::where([['platform', '=', '3'], ['ring', '=', '1']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Xbox']['active'] = Release::where([['platform', '=', '3'], ['ring', '=', '2']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Xbox']['slow'] = Release::where([['platform', '=', '3'], ['ring', '=', '3']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Xbox']['preview'] = Release::where([['platform', '=', '3'], ['ring', '=', '4']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Xbox']['release'] = Release::where([['platform', '=', '3'], ['ring', '=', '5']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Xbox']['target'] = Release::where([['platform', '=', '3'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['Server']['slow'] = Release::where([['platform', '=', '4'], ['ring', '=', '3']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Server']['target'] = Release::where([['platform', '=', '4'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Server']['ltsc'] = Release::where([['platform', '=', '4'], ['ring', '=', '8']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['IoT']['slow'] = Release::where([['platform', '=', '6'], ['ring', '=', '3']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['IoT']['target'] = Release::where([['platform', '=', '6'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['IoT']['broad'] = Release::where([['platform', '=', '6'], ['ring', '=', '7']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['Holographic']['active'] = Release::where([['platform', '=', '5'], ['ring', '=', '2']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Holographic']['slow'] = Release::where([['platform', '=', '5'], ['ring', '=', '3']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Holographic']['target'] = Release::where([['platform', '=', '5'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Holographic']['broad'] = Release::where([['platform', '=', '5'], ['ring', '=', '7']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Holographic']['ltsc'] = Release::where([['platform', '=', '5'], ['ring', '=', '8']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['Team']['target'] = Release::where([['platform', '=', '7'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Team']['broad'] = Release::where([['platform', '=', '7'], ['ring', '=', '7']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['Mobile']['target'] = Release::where([['platform', '=', '2'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['Mobile']['broad'] = Release::where([['platform', '=', '2'], ['ring', '=', '7']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        $flights['SDK']['target'] = Release::where([['platform', '=', '9'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();
        $flights['ISO']['target'] = Release::where([['platform', '=', '8'], ['ring', '=', '6']])->orderBy('date', 'desc')->orderBy('build', 'desc')->first();

        return view('timeline', compact('releases', 'flights'));
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
