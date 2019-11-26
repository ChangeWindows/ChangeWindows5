<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Milestone;
use Twitter;

class FlightController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index(Request $request) {
        $request->user()->authorizeRoles('Admin');

        $releases = Release::orderBy('date', 'desc')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(100)->onEachSide(1);

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
        }

        return view('flights.index', compact('releases', 'timeline'));
    }

    public function edit(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $flight = Release::find($id);
        $milestones = Milestone::orderBy('version', 'DESC')->get();

        return view('flights.edit', compact('flight', 'milestones'));
    }

    public function store(Request $request) {
        $request->user()->authorizeRoles('Admin');

        $string = Release::splitString(request()->get('build_string'));
        $milestone = Release::getMilestoneByString($string);

        foreach(request()->get('flight') as $platform => $ring) {
            $rings = array();

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

                array_push($rings, getTweetRingById($value, $platform));
            }

            $hashtags = $platform === 3 ? '#Xbox #XboxInsider' : '#Windows #WindowsInsiders';

            if (request()->get('tweet')) {
                Twitter::postTweet(['status' => 'Build '.$string['build'].'.'.$string['delta'].' for '.getPlatformById($platform).' has been released to '.collect($rings)->join(', ', ' and ').'. '.$hashtags.' https://changewindows.org/build/'.$string['build'].'/'.getPlatformClass($platform).'#'.$string['delta'], 'format' => 'json']);
            }
        }

        return redirect('/');
    }

    public function update(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $string = Release::splitString(request()->get('build_string'));

        $flight = Release::find($id);

        $flight->major = $string['major'];
        $flight->minor = $string['minor'];
        $flight->build = $string['build'];
        $flight->delta = $string['delta'];
        $flight->milestone = request()->get('milestone');
        $flight->platform = request()->get('platform');
        $flight->ring = request()->get('ring');
        $flight->date = request()->get('release');

        $flight->save();

        return redirect('flight');
    }

    public function destroy(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        Release::destroy($id);

        return redirect('flight');
    }
}
