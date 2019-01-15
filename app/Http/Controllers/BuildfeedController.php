<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buildfeed;

class BuildfeedController extends Controller
{
    public function index() {
        $builds = Buildfeed::orderBy('major', 'ASC')->orderBy('minor', 'ASC')->orderBy('build', 'ASC')->orderBy('revision', 'ASC')->paginate(10)->onEachSide(1);

        return view('buildfeed.index', compact('builds'));
    }

    public function about() {
        return view('buildfeed.about');
    }
}
