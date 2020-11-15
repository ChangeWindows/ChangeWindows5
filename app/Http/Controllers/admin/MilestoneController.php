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

        return redirect()->route('admin.milestones.edit', $milestone)->with('status', 'Milestone <b>'.$milestone->name.'</b> has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Milestone  $milesotne
     * @return \Illuminate\Http\Response
     */
    public function edit(Milestone $milesotne) {
        $this->authorize('edit_milestone');
        return view('core.milestones.edit', compact('milesotne'));
    }
}
