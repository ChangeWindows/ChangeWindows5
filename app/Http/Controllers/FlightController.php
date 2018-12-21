<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;

class FlightController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index(Request $request) {
        $releases = Release::orderBy('date', 'desc')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('ring', 'desc')->paginate(100);

        foreach ($releases as $release) {
            $timeline[$release->date->format('j F Y')][$release->build][$release->delta][$release->platform][$release->ring] = $release;
        }

        return view('flights', compact('releases', 'timeline'));
    }
}
