<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\HorizonMilestone;
use App\Model\HorizonPlatform;
use App\Model\HorizonMilestonePlatform;
use App\Model\HorizonMilestonePlatformChannel;
use Twitter;

class MilestoneController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $horizon_milestones = HorizonMilestone::orderBy('canonical_version', 'desc')->paginate(50);

        return view('core.milestones.index', [
            'milestones' => $horizon_milestones
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_milestone');

        $horizon_milestone = HorizonMilestone::create([
            'product_name' => request()->get('product_name'),
            'name' => request()->get('name'),
            'codename' => request()->get('codename'),
            'version' => request()->get('version'),
            'canonical_version' => request()->get('canonical_version'),
            'color' => request()->get('color')
        ]);

        Twitter::postTweet(['status' => 'Follow everything about '.request()->get('codename').' at ChangeWindows! #Windows #WindowsInsiders https://changewindows.org/milestones/'.request()->get('id'), 'format' => 'json']);

        return redirect()->route('admin.milestones.edit', $horizon_milestone)->with('status', 'Milestone <b>'.$horizon_milestone->product_name.' version '.$horizon_milestone->version.'</b> has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HorizonMilestone  $horizon_milestone
     * @return \Illuminate\Http\Response
     */
    public function edit(HorizonMilestone $horizon_milestone) {
        $this->authorize('edit_milestone');

        $platforms = HorizonPlatform::all();
        
        return view('core.milestones.edit', [
            'milestone' => $horizon_milestone,
            'platforms' => $platforms
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HorizonMilestone $horizon_milestone) {
        $this->authorize('edit_milestone');

        $horizon_milestone->update([
            'product_name' => request()->get('product_name'),
            'name' => request()->get('name'),
            'codename' => request()->get('codename'),
            'version' => request()->get('version'),
            'color' => request()->get('color'),
            'canonical_version' => request()->get('canonical_version'),
            'start_build' => request()->get('start_build'),
            'start_preview' => request()->get('start_preview') === null ? '0000-01-01' : request()->get('start_preview'),
            'start_public' => request()->get('start_public') === null ? '0000-01-01' : request()->get('start_public'),
            'start_extended' => request()->get('start_extended') === null ? '0000-01-01' : request()->get('start_extended'),
            'start_lts' => request()->get('start_lts') === null ? '0000-01-01' : request()->get('start_lts'),
            'end_lts' => request()->get('end_lts') === null ? '0000-01-01' : request()->get('end_lts')
        ]);

        return redirect()->route('admin.milestones')->with('status', 'The changes to <b>'.$horizon_milestone->product_name.' version '.$horizon_milestone->version.'</b> have been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HorizonMilestone $horizon_milestone) {
        $this->authorize('delete_milestone');

        $horizon_milestone->delete();

        return redirect()->route('admin.milestones')->with('status', 'Milestone <b>'.$horizon_milestone->product_name.' version '.$horizon_milestone->version.'</b> has been removed.');
    }
}
