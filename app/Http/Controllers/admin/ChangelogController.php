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
}
