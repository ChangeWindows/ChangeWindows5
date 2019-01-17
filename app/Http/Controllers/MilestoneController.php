<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Milestone;
use App\Release;
use Carbon\Carbon;

class MilestoneController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $request->user()->authorizeRoles(['Admin', 'Insider']);

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
        $request->user()->authorizeRoles(['Admin', 'Insider']);

        $milestone = Milestone::findOrFail($id);
        $previous = Milestone::where('version', '<', $milestone->version)->orderBy('version', 'DESC')->first();
        $next = Milestone::where('version', '>', $milestone->version)->orderBy('version', 'ASC')->first();

        $pc_count = Release::where('milestone', $milestone->id)->where('platform', '1')->count();
        $mobile_count = Release::where('milestone', $milestone->id)->where('platform', '2')->count();
        $xbox_count = Release::where('milestone', $milestone->id)->where('platform', '3')->count();
        $server_count = Release::where('milestone', $milestone->id)->where('platform', '4')->count();
        $holographic_count = Release::where('milestone', $milestone->id)->where('platform', '5')->count();
        $iot_count = Release::where('milestone', $milestone->id)->where('platform', '6')->count();
        $team_count = Release::where('milestone', $milestone->id)->where('platform', '7')->count();
        $iso_count = Release::where('milestone', $milestone->id)->where('platform', '8')->count();
        $sdk_count = Release::where('milestone', $milestone->id)->where('platform', '9')->count();

        return view('milestones.show', compact('milestone', 'previous', 'next', 'pc_count', 'mobile_count', 'xbox_count', 'server_count', 'holographic_count', 'iot_count', 'team_count', 'iso_count', 'sdk_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $request->user()->authorizeRoles('Admin');
        //
    }
}
