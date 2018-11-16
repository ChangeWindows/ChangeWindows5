<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;

class TimelineController extends Controller
{
    public function index() {
        $releases = Release::orderBy('date', 'DESC')->orderBy('build', 'DESC')->orderBy('delta', 'DESC')->orderBy('ring', 'DESC')->paginate(50);

        return view('timeline', compact('releases'));
    }
}
