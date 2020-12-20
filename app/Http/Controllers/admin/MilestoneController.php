<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Milestone;
use App\Platform;
use App\MilestonePlatform;
use App\ChannelMilestonePlatform;
use Twitter;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $milestones = Milestone::orderBy('version', 'desc')->paginate(50);

        return view('core.milestones.index', compact('milestones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_milestone');

        $milestone = Milestone::create([
            'id' => request()->get('id'),
            'osname' => request()->get('osname'),
            'name' => request()->get('name'),
            'codename' => request()->get('codename'),
            'version' => request()->get('version'),
            'color' => request()->get('color')
        ]);

        Twitter::postTweet(['status' => 'Follow everything about '.request()->get('codename').' at ChangeWindows! #Windows #WindowsInsiders https://changewindows.org/milestones/'.request()->get('id'), 'format' => 'json']);

        return redirect()->route('admin.milestones.edit', $milestone)->with('status', 'Milestone <b>'.$milestone->osname.' version '.$milestone->version.'</b> has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function edit(Milestone $milestone) {
        $this->authorize('edit_milestone');

        $platforms = Platform::all();
        
        return view('core.milestones.edit', compact('milestone', 'platforms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Milestone $milestone) {
        $this->authorize('edit_milestone');

        $milestone->update([
            'id' => request()->get('id'),
            'osname' => request()->get('osname'),
            'name' => request()->get('name'),
            'codename' => request()->get('codename'),
            'version' => request()->get('version'),
            'color' => request()->get('color'),
            'start_build' => request()->get('start_build'),
            'preview' => request()->get('preview') === null ? '0000-01-01' : request()->get('preview'),
            'public' => request()->get('public') === null ? '0000-01-01' : request()->get('public'),
            'mainEol' => request()->get('mainEol') === null ? '0000-01-01' : request()->get('mainEol'),
            'mainXol' => request()->get('mainXol') === null ? '0000-01-01' : request()->get('mainXol'),
            'ltsEol' => request()->get('ltsEol') === null ? '0000-01-01' : request()->get('ltsEol')
        ]);

        return redirect()->route('admin.milestones')->with('status', 'The changes to <b>'.$milestone->osname.' version '.$milestone->version.'</b> have been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Milestone $milestone) {
        $this->authorize('delete_milestone');

        $milestone->delete();

        return redirect()->route('admin.milestones')->with('status', 'Milestone <b>'.$milestone->osname.' version '.$milestone->version.'</b> has been removed.');
    }
}
