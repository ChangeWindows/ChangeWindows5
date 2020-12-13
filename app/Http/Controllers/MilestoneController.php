<?php

namespace App\Http\Controllers;

use App\Log;
use App\Milestone;
use App\Release;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Parsedown;

class MilestoneController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $milestones = Milestone::orderBy('version', 'desc')->get();

        return view('milestones.index', compact('milestones'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $milestone = Milestone::findOrFail($id);
        $previous = Milestone::where('version', '<', $milestone->version)->orderBy('version', 'desc')->first();
        $next = Milestone::where('version', '>', $milestone->version)->orderBy('version', 'asc')->first();

        $progress = $milestone->getSupport();

        $platforms = Release::select('platform', \DB::raw('count(build) as count'))->where('milestone', $milestone->id)->groupBy('platform')->orderBy('platform')->get();

        foreach ($platforms as $platform) {
            $platform->builds = Release::where('milestone', $milestone->id)->where('platform', $platform->platform)->orderBy('date', 'desc')->orderBy('delta', 'desc')->limit(7)->get();
        }

        return view('milestones.show', compact('milestone', 'previous', 'next', 'platforms', 'progress'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function platform(Request $request, $id, $platform) {
        $timeline = [];
        $platform_id = getPlatformIdByClass($platform);
        $parsedown = new Parsedown();

        $milestone = Milestone::findOrFail($id);

        $changelog = Log::where('milestone_id', $id)->where('platform', $platform_id)->first();

        $platforms = Release::select('platform', \DB::raw('count(build) as count'))->where('milestone', $milestone->id)->groupBy('platform')->orderBy('platform')->get();

        $releases = Release::where('milestone', $id)->where('platform', $platform_id)->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'asc')->get();

        foreach ($releases as $release) {
            $timeline[$release->build.'.'.$release->delta][$release->ring] = $release->date->format('j M \'y');
        }

        return view('milestones.platform', compact('milestone', 'platforms', 'platform_id', 'timeline', 'changelog', 'parsedown'));
    }
}
