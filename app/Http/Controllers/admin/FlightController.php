<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Release;
use App\Milestone;
use Twitter;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $releases = Release::orderBy('date', 'desc')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(100);

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
        }

        return view('core.flights.index', compact('releases', 'timeline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_flight');

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
                    'date' => request()->get('date')
                ]);

                array_push($rings, getTweetRingById($value, $platform));
            }

            $hashtags = $platform === 3 ? '#Xbox #XboxInsider' : '#Windows #WindowsInsiders';

            if (request()->get('tweet')) {
                Twitter::postTweet(['status' => 'Build '.$string['build'].'.'.$string['delta'].' for '.getPlatformById($platform).' has been released to '.collect($rings)->join(', ', ' and ').'. '.$hashtags.' https://changewindows.org/milestones/'.$milestone.'/'.getPlatformClass($platform), 'format' => 'json']);
            }
        }

        return redirect()->route('admin.flights')->with('status', 'Flight <b>'.$string['build'].'.'.$string['delta'].' for '.getPlatformById($platform).'</b> has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Release  $release
     * @return \Illuminate\Http\Response
     */
    public function edit(Release $release) {
        $this->authorize('edit_flight');
        $milestones = Milestone::orderBy('version', 'desc')->get();

        return view('core.flights.edit', compact('release', 'milestones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Release $release) {
        $this->authorize('edit_flight');

        $string = Release::splitString(request()->get('build_string'));

        $release->update([
            'major' => $string['major'],
            'minor' => $string['minor'],
            'build' => $string['build'],
            'delta' => $string['delta'],
            'milestone' => request()->get('milestone'),
            'platform' => request()->get('platform'),
            'ring' => request()->get('ring'),
            'date' => request()->get('date')
        ]);

        return redirect()->route('admin.flights')->with('status', 'The changes to <b>'.$release->build.'.'.$release->delta.' for '.getPlatformById($release->platform).'</b> have been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Release $release) {
        $this->authorize('delete_flight');

        $release->destroy($id);

        return redirect()->route('admin.flights')->with('status', 'Flight <b>'.$release->build.'.'.$release->delta.' for '.getPlatformById($platform).'</b> has been removed.');
    }
}
