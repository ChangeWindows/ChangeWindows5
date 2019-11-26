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
        $request->user()->authorizeRoles('Admin');

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
            $changelogs = Changelog::orderBy('updated_at', 'desc')
                                    ->paginate(50);
        }

        return view('changelogs.all', compact('changelogs', 'platform', 'build'));
    }

    public function create(Request $request) {
        $request->user()->authorizeRoles('Admin');

        return view('changelogs.create');
    }

    public function edit(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $changelog = Changelog::find($id);

        $changelogs = Changelog::where('platform', $changelog->platform)
                                ->where('build', $changelog->build)
                                ->orderBy('build', 'desc')
                                ->orderBy('delta', 'desc')
                                ->paginate(50);

        return view('changelogs.edit', compact('changelogs', 'changelog'));
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

    public function update(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $changelog = Changelog::find($id);

        $string = Changelog::splitString(request()->get('build_string'));

        $changelog->build = $string['build'];
        $changelog->delta = $string['delta'];
        $changelog->platform = request()->get('platform');
        $changelog->changelog = request()->get('changelog');

        $changelog->save();

        return redirect('/changelog');
    }
}
