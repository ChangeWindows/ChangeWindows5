<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Changelog;

class ChangelogController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index(Request $request, $platform = null, $build = null) {
        if ($platform != null && $build == null) {
            $changelogs = Changelog::where('platform', $platform)
                                    ->orderBy('build', 'desc')
                                    ->orderBy('delta', 'desc')
                                    ->paginate(50);
        } elseif ($platform != null && $build != null) {
            $changelogs = Changelog::where('platform', $platform)
                                    ->where('build', $build)
                                    ->orderBy('build', 'desc')
                                    ->orderBy('delta', 'desc')
                                    ->paginate(50);
        } else {
            $changelogs = Changelog::orderBy('build', 'desc')
                                    ->orderBy('delta', 'desc')
                                    ->paginate(50);
        }

        return view('changelogs', compact('changelogs', 'platform', 'build'));
    }

    public function create(Request $request) {
        $request->user()->authorizeRoles('Admin');

        return view('changelogsMake');
    }

    public function store(Request $request) {
        $request->user()->authorizeRoles('Admin');
        
        $string = Changelog::splitString(request()->get('build_string'));

        Changelog::create([
            'build' => $string['build'],
            'delta' => $string['delta'],
            'platform' => request()->get('platform'),
            'changelog' => request()->get('changelog')
        ]);

        return redirect('/changelog');
    }
}
