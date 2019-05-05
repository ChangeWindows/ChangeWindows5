<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Milestone;
use App\Release;
use Carbon\Carbon;
use Abraham\TwitterOAuth\TwitterOAuth;

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
        $milestones = Milestone::orderBy('version', 'DESC')->get();

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
        $previous = Milestone::where('version', '<', $milestone->version)->orderBy('version', 'DESC')->first();
        $next = Milestone::where('version', '>', $milestone->version)->orderBy('version', 'ASC')->first();

        $progress = $milestone->getSupport();

        $platforms = Release::select('platform', \DB::raw('count(build) as count'))->where('milestone', $milestone->id)->groupBy('platform')->orderBy('platform')->get();

        foreach ($platforms as $platform) {
            $platform->builds = Release::where('milestone', $milestone->id)->where('platform', $platform->platform)->orderBy('date', 'DESC')->orderBy('delta', 'DESC')->limit(5)->get();
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

        $milestone = Milestone::findOrFail($id);
        $previous = Milestone::where('version', '<', $milestone->version)->orderBy('version', 'DESC')->first();
        $next = Milestone::where('version', '>', $milestone->version)->orderBy('version', 'ASC')->first();

        $platforms = Release::select('platform', \DB::raw('count(build) as count'))->where('milestone', $milestone->id)->groupBy('platform')->orderBy('platform')->get();

        $releases = Release::where('milestone', $id)->where('platform', $platform_id)->orderBy('build', 'DESC')->orderBy('delta', 'DESC')->orderBy('ring', 'ASC')->get();

        foreach ($releases as $release) {
            $timeline[$release->build.'.'.$release->delta][$release->ring] = $release->date->format('j M Y');
        }

        return view('milestones.platform', compact('milestone', 'previous', 'next', 'platforms', 'platform_id', 'timeline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->user()->authorizeRoles('Admin');

        $connection = new TwitterOAuth(env('TWITTER_CONSUMER_KEY'), env('TWITTER_CONSUMER_SECRET'), env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));

        Milestone::create([
            'id' => request()->get('id'),
            'osname' => request()->get('osname'),
            'name' => request()->get('name'),
            'codename' => request()->get('codename'),
            'version' => request()->get('version'),
            'color' => request()->get('color'),
            'description' => request()->get('description'),
            'preview' => request()->get('preview') === null ? '0000-01-01' : request()->get('preview'),
            'public' => request()->get('public') === null ? '0000-01-01' : request()->get('public'),
            'mainEol' => request()->get('mainEol') === null ? '0000-01-01' : request()->get('mainEol'),
            'mainXol' => request()->get('mainXol') === null ? '0000-01-01' : request()->get('mainXol'),
            'ltsEol' => request()->get('ltsEol') === null ? '0000-01-01' : request()->get('ltsEol'),
            'isLts' => false,
            'pcSkip' => request()->get('pcSkip') === null ? 0 : 1,
            'pcFast' => request()->get('pcFast') === null ? 0 : 1,
            'pcSlow' => request()->get('pcSlow') === null ? 0 : 1,
            'pcReleasePreview' => request()->get('pcReleasePreview') === null ? 0 : 1,
            'pcTargeted' => request()->get('pcTargeted') === null ? 0 : 1,
            'pcBroad' => request()->get('pcBroad') === null ? 0 : 1,
            'pcLTS' => request()->get('pcLTS') === null ? 0 : 1,
            'mobileFast' => request()->get('mobileFast') === null ? 0 : 1,
            'mobileSlow' => request()->get('mobileSlow') === null ? 0 : 1,
            'mobileReleasePreview' => request()->get('mobileReleasePreview') === null ? 0 : 1,
            'mobileTargeted' => request()->get('mobileTargeted') === null ? 0 : 1,
            'mobileBroad' => request()->get('mobileBroad') === null ? 0 : 1,
            'xboxSkip' => request()->get('xboxSkip') === null ? 0 : 1,
            'xboxFast' => request()->get('xboxFast') === null ? 0 : 1,
            'xboxSlow' => request()->get('xboxSlow') === null ? 0 : 1,
            'xboxPreview' => request()->get('xboxPreview') === null ? 0 : 1,
            'xboxReleasePreview' => request()->get('xboxReleasePreview') === null ? 0 : 1,
            'xboxTargeted' => request()->get('xboxTargeted') === null ? 0 : 1,
            'serverSlow' => request()->get('serverSlow') === null ? 0 : 1,
            'serverTargeted' => request()->get('serverTargeted') === null ? 0 : 1,
            'serverLTS' => request()->get('serverLTS') === null ? 0 : 1,
            'iotSlow' => request()->get('iotSlow') === null ? 0 : 1,
            'iotTargeted' => request()->get('iotTargeted') === null ? 0 : 1,
            'iotBroad' => request()->get('iotBroad') === null ? 0 : 1,
            'teamTargeted' => request()->get('teamTargeted') === null ? 0 : 1,
            'teamFast' => request()->get('teamFast') === null ? 0 : 1,
            'teamSlow' => request()->get('teamSlow') === null ? 0 : 1,
            'teamBroad' => request()->get('teamBroad') === null ? 0 : 1,
            'holographicFast' => request()->get('holographicFast') === null ? 0 : 1,
            'holographicSlow' => request()->get('holographicSlow') === null ? 0 : 1,
            'holographicTargeted' => request()->get('holographicTargeted') === null ? 0 : 1,
            'holographicBroad' => request()->get('holographicBroad') === null ? 0 : 1,
            'holographicLTS' => request()->get('holographicLTS') === null ? 0 : 1,
            'sdk' => request()->get('sdk') === null ? 0 : 1,
            'iso' => request()->get('iso') === null ? 0 : 1
        ]);

        $connection->post('statuses/update', ['status' => 'Follow everything about '.request()->get('codename').' at ChangeWindows! #Windows #WindowsInsiders https://changewindows.org/milestones/'.request()->get('id'));

        return redirect('/milestones');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $milestone = Milestone::findOrFail($id);

        return view('milestones.edit', compact('milestone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $milestone = Milestone::findOrFail($id);
        
        $milestone->id = request()->get('id');
        $milestone->osname = request()->get('osname');
        $milestone->name = request()->get('name');
        $milestone->codename = request()->get('codename');
        $milestone->version = request()->get('version');
        $milestone->color = request()->get('color');
        $milestone->description = request()->get('description');
        $milestone->preview = request()->get('preview') === null ? '0000-01-01' : request()->get('preview');
        $milestone->public = request()->get('public') === null ? '0000-01-01' : request()->get('public');
        $milestone->mainEol = request()->get('mainEol') === null ? '0000-01-01' : request()->get('mainEol');
        $milestone->mainXol = request()->get('mainXol') === null ? '0000-01-01' : request()->get('mainXol');
        $milestone->ltsEol = request()->get('ltsEol') === null ? '0000-01-01' : request()->get('ltsEol');
        $milestone->isLts = false;
        $milestone->pcSkip = request()->get('pcSkip') === null ? 0 : 1;
        $milestone->pcFast = request()->get('pcFast') === null ? 0 : 1;
        $milestone->pcSlow = request()->get('pcSlow') === null ? 0 : 1;
        $milestone->pcReleasePreview = request()->get('pcReleasePreview') === null ? 0 : 1;
        $milestone->pcTargeted = request()->get('pcTargeted') === null ? 0 : 1;
        $milestone->pcBroad = request()->get('pcBroad') === null ? 0 : 1;
        $milestone->pcLTS = request()->get('pcLTS') === null ? 0 : 1;
        $milestone->mobileFast = request()->get('mobileFast') === null ? 0 : 1;
        $milestone->mobileSlow = request()->get('mobileSlow') === null ? 0 : 1;
        $milestone->mobileReleasePreview = request()->get('mobileReleasePreview') === null ? 0 : 1;
        $milestone->mobileTargeted = request()->get('mobileTargeted') === null ? 0 : 1;
        $milestone->mobileBroad = request()->get('mobileBroad') === null ? 0 : 1;
        $milestone->xboxSkip = request()->get('xboxSkip') === null ? 0 : 1;
        $milestone->xboxFast = request()->get('xboxFast') === null ? 0 : 1;
        $milestone->xboxSlow = request()->get('xboxSlow') === null ? 0 : 1;
        $milestone->xboxPreview = request()->get('xboxPreview') === null ? 0 : 1;
        $milestone->xboxReleasePreview = request()->get('xboxReleasePreview') === null ? 0 : 1;
        $milestone->xboxTargeted = request()->get('xboxTargeted') === null ? 0 : 1;
        $milestone->serverSlow = request()->get('serverSlow') === null ? 0 : 1;
        $milestone->serverTargeted = request()->get('serverTargeted') === null ? 0 : 1;
        $milestone->serverLTS = request()->get('serverLTS') === null ? 0 : 1;
        $milestone->iotSlow = request()->get('iotSlow') === null ? 0 : 1;
        $milestone->iotTargeted = request()->get('iotTargeted') === null ? 0 : 1;
        $milestone->iotBroad = request()->get('iotBroad') === null ? 0 : 1;
        $milestone->teamFast = request()->get('teamFast') === null ? 0 : 1;
        $milestone->teamSlow = request()->get('teamSlow') === null ? 0 : 1;
        $milestone->teamTargeted = request()->get('teamTargeted') === null ? 0 : 1;
        $milestone->teamBroad = request()->get('teamBroad') === null ? 0 : 1;
        $milestone->holographicFast = request()->get('holographicFast') === null ? 0 : 1;
        $milestone->holographicSlow = request()->get('holographicSlow') === null ? 0 : 1;
        $milestone->holographicTargeted = request()->get('holographicTargeted') === null ? 0 : 1;
        $milestone->holographicBroad = request()->get('holographicBroad') === null ? 0 : 1;
        $milestone->holographicLTS = request()->get('holographicLTS') === null ? 0 : 1;
        $milestone->sdk = request()->get('sdk') === null ? 0 : 1;
        $milestone->iso = request()->get('iso') === null ? 0 : 1;

        $milestone->save();

        return redirect('/milestones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');
        
        Milestone::destroy($id);

        return redirect('/milestones');
    }
}
