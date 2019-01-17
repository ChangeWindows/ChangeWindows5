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

        $platforms = Release::select('platform', \DB::raw('count(build) as count'))->where('milestone', $milestone->id)->where('delta', '<>', '99999')->groupBy('platform')->orderBy('platform')->get();

        return view('milestones.show', compact('milestone', 'previous', 'next', 'platforms'));
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
