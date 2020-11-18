<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Log;
use App\Milestone;

class ChangelogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $platform = null) {
        $this->authorize('show_logs');

        if ($platform != null) {
            $changelogs = Log::where('platform', $platform)
                ->with('milestone')
                ->paginate(50);
        } else {
            $changelogs = Log::orderBy('updated_at', 'desc')
                ->with('milestone')
                ->paginate(50);
        }

        $milestones = Milestone::orderBy('version', 'desc')->get();

        return view('core.changelogs.index', compact('changelogs', 'platform', 'milestones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_log');

        $log = Log::create([
            'milestone_id' => request()->get('milestone'),
            'platform' => request()->get('platform'),
            'changelog' => request()->get('changelog')
        ]);

        return redirect()->route('admin.changelogs.edit', $log)->with('status', 'The changelog for <b>'.getPlatformById($log->platform).' version '.$log->milestone->version.'</b> has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Log $log) {
        $this->authorize('edit_log');

        $milestones = Milestone::orderBy('version', 'DESC')->get();

        return view('core.changelogs.edit', compact('log', 'milestones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(Log $log) {
        $this->authorize('edit_log');

        $log->update([
            'platform' => request()->get('platform'),
            'milestone_id' => request()->get('milestone'),
            'changelog' => request()->get('changelog')
        ]);

        return redirect()->route('admin.changelogs', $log)->with('status', 'The changelog for <b>'.getPlatformById($log->platform).' version '.$log->milestone->version.'</b> has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log) {
        $this->authorize('delete_log');

        $log->destroy();

        return redirect()->route('admin.changelogs')->with('status', 'The changelog for <b>'.getPlatformById($log->platform).' version '.$log->milestone->version.'</b> has been deleted.');
    }
}
