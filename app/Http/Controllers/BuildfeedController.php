<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buildfeed;

class BuildfeedController extends Controller
{
    public function index() {
        $builds = Buildfeed::paginate(50)->onEachSide(1);

        return view('buildfeed.index', compact('builds'));
    }

    public function about() {
        return view('buildfeed.about');
    }
}
