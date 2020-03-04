<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
use App\Milestone;

class LogController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $platform = null) {
        $request->user()->authorizeRoles('Admin');

        if ($platform != null) {
            $changelogs = Log::where('platform', $platform)
                                ->with('milestone')
                                ->paginate(50);
        } else {
            $changelogs = Log::orderBy('updated_at', 'desc')
                                ->with('milestone')
                                ->paginate(50);
        }

        return view('logs.all', compact('changelogs', 'platform'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $request->user()->authorizeRoles('Admin');

        $milestones = Milestone::orderBy('version', 'DESC')->get();

        return view('logs.create', compact('milestones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->user()->authorizeRoles('Admin');

        Log::create([
            'milestone_id' => request()->get('milestone'),
            'platform' => request()->get('platform'),
            'changelog' => request()->get('changelog')
        ]);

        return redirect('/log');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $changelog = Log::find($id);

        $milestones = Milestone::orderBy('version', 'DESC')->get();

        return view('logs.edit', compact('changelog', 'milestones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function update(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $changelog = Log::find($id);

        $changelog->platform = request()->get('platform');
        $changelog->milestone_id = request()->get('milestone');
        $changelog->changelog = request()->get('changelog');

        $changelog->save();

        return redirect('/log');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
