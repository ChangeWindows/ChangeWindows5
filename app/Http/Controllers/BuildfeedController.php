<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buildfeed;

class BuildfeedController extends Controller
{
    public function index(Request $request) {
        $builds = Buildfeed::when(request('lab', false), function ($query, $lab) {
                                return $query->where('lab', $lab);
                            })->when(request('family', false), function ($query, $family) {
                                return $query->where('family', $family);
                            })->when(request('build', false), function ($query, $build) {
                                return $query->where('build', $build);
                            })->when(request('sourcetype', false), function ($query, $sourcetype) {
                                return $query->where('sourcetype', $sourcetype);
                            })->orderBy('major', 'DESC')
                            ->orderBy('minor', 'DESC')
                            ->orderBy('build', 'DESC')
                            ->orderBy('revision', 'DESC')
                            ->paginate(52)
                            ->onEachSide(1);

        return view('buildfeed.index', compact('builds'));
    }

    public function show($id) {
        $build = Buildfeed::findOrFail($id);

        return view('buildfeed.show', compact('build'));
    }

    public function about() {
        return view('buildfeed.about');
    }
}
