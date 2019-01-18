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

        $now = Carbon::now();

        $preview_period = $milestone->preview->diffInDays($milestone->public);
        $public_period = $milestone->public->diffInDays($milestone->mainEol);
        $extended_period = $milestone->mainEol->diffInDays($milestone->mainXol);
        $lts_period = $milestone->mainXol->diffInDays($milestone->ltsEol);

        $total = ($preview_period + $public_period + $extended_period + $lts_period) * 100;

        if ($milestone->preview->lessThanOrEqualTo($now) && $milestone->public->greaterThan($now)) {
            $preview_done = $milestone->preview->diffInDays($milestone->now);
            $preview_go = $preview_period - $preview_done;

            $public_done = $extended_done = $lts_done = 0;
            $public_go = $public_period;
            $extended_go = $extended_period;
            $lts_go = $lts_period;
        } else if ($milestone->public->lessThanOrEqualTo($now) && $milestone->mainEol->greaterThanOrEqualTo($now)) {
            // We flip this to "greaterThanOrEqualTo" instead of "greaterThan" because these dates indicate the last day of support
            $public_done = $milestone->public->diffInDays($milestone->now);
            $public_go = $public_period - $public_done;
            
            $preview_go = $extended_done = $lts_done = 0;
            $preview_done = $preview_period;
            $extended_go = $extended_period;
            $lts_go = $lts_period;
        } else if ($milestone->mainEol->lessThan($now) && $milestone->mainXol->greaterThanOrEqualTo($now)) {
            $extended_done = $milestone->public->diffInDays($milestone->now);
            $extended_go = $extended_period - $extended_done;
            
            $preview_go = $public_go = $lts_done = 0;
            $preview_done = $preview_period;
            $public_done = $public_period;
            $lts_go = $lts_period;
        } else if ($milestone->mainXol->lessThan($now) && $milestone->ltsEol->greaterThanOrEqualTo($now)) {
            $lts_done = $milestone->public->diffInDays($milestone->now);
            $lts_go = $lts_period - $lts_done;
            
            $preview_go = $public_go = $extended_go = 0;
            $preview_done = $preview_period;
            $public_done = $public_period;
            $extended_done = $extended_period;
        } else {
            $preview_go = $public_go = $extended_go = $lts_go = 0;
            $preview_done = $preview_period;
            $public_done = $public_period;
            $extended_done = $extended_period;
            $lts_done = $lts_period;
        }

        $progress = array(
            'preview_done' => $preview_done / $total * 10000,
            'preview_go' => $preview_go / $total * 10000,
            'public_done' => $public_done / $total * 10000,
            'public_go' => $public_go / $total * 10000,
            'extended_done' => $extended_done / $total * 10000,
            'extended_go' => $extended_go / $total * 10000,
            'lts_done' => $lts_done / $total * 10000,
            'lts_go' => $lts_go / $total * 10000
        );

        $platforms = Release::select('platform', \DB::raw('count(build) as count'))->where('milestone', $milestone->id)->where('delta', '<>', '99999')->groupBy('platform')->orderBy('platform')->get();

        return view('milestones.show', compact('milestone', 'previous', 'next', 'platforms', 'progress'));
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
