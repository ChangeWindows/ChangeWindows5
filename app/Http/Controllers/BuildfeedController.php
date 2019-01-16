<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buildfeed;

class BuildfeedController extends Controller
{
    public function index() {
        $builds = Buildfeed::orderBy('major', 'DESC')->orderBy('minor', 'DESC')->orderBy('build', 'DESC')->orderBy('revision', 'DESC')->paginate(52)->onEachSide(1);

        return view('buildfeed.index', compact('builds'));
    }

    public function about() {
        return view('buildfeed.about');
    }
}
