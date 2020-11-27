<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Milestone;
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
        return view('core.milestones.edit', compact('milestone'));
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

        $start = Milestone::splitMetaBuild(request()->get('start_string'));
        $end = Milestone::splitMetaBuild(request()->get('end_string'));

        $milestone->update([
            'id' => request()->get('id'),
            'osname' => request()->get('osname'),
            'name' => request()->get('name'),
            'codename' => request()->get('codename'),
            'version' => request()->get('version'),
            'color' => request()->get('color'),
            'start_build' => $start['build'],
            'start_delta' => $start['delta'],
            'end_build' => $end['build'],
            'end_delta' => $end['delta'],
            'preview' => request()->get('preview') === null ? '0000-01-01' : request()->get('preview'),
            'public' => request()->get('public') === null ? '0000-01-01' : request()->get('public'),
            'mainEol' => request()->get('mainEol') === null ? '0000-01-01' : request()->get('mainEol'),
            'mainXol' => request()->get('mainXol') === null ? '0000-01-01' : request()->get('mainXol'),
            'ltsEol' => request()->get('ltsEol') === null ? '0000-01-01' : request()->get('ltsEol'),
            'pcFast' => request()->get('pcFast') === null ? 0 : 1,
            'pcSlow' => request()->get('pcSlow') === null ? 0 : 1,
            'pcReleasePreview' => request()->get('pcReleasePreview') === null ? 0 : 1,
            'pcTargeted' => request()->get('pcTargeted') === null ? 0 : 1,
            'pcBroad' => request()->get('pcBroad') === null ? 0 : 1,
            'pcLTS' => request()->get('pcLTS') === null ? 0 : 1,
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
            'teamFast' => request()->get('teamFast') === null ? 0 : 1,
            'teamSlow' => request()->get('teamSlow') === null ? 0 : 1,
            'teamTargeted' => request()->get('teamTargeted') === null ? 0 : 1,
            'teamBroad' => request()->get('teamBroad') === null ? 0 : 1,
            'holographicFast' => request()->get('holographicFast') === null ? 0 : 1,
            'holographicSlow' => request()->get('holographicSlow') === null ? 0 : 1,
            'holographicTargeted' => request()->get('holographicTargeted') === null ? 0 : 1,
            'holographicBroad' => request()->get('holographicBroad') === null ? 0 : 1,
            'holographicLTS' => request()->get('holographicLTS') === null ? 0 : 1,
            'tenXSlow' => request()->get('tenXSlow') === null ? 0 : 1,
            'sdk' => request()->get('sdk') === null ? 0 : 1,
            'iso' => request()->get('iso') === null ? 0 : 1
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

        $milestone->destroy($id);

        return redirect()->route('admin.milestones')->with('status', 'Milestone <b>'.$milestone->osname.' version '.$milestone->version.'</b> has been removed.');
    }
}
