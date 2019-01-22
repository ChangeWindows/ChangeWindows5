<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;

class RingsController extends Controller
{
    public function index() {
        $flights['pc']['skip'] = Release::where('platform', '1')->where('ring', '1')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['pc']['active'] = Release::where('platform', '1')->where('ring', '2')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['pc']['slow'] = Release::where('platform', '1')->where('ring', '3')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['pc']['release'] = Release::where('platform', '1')->where('ring', '5')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['pc']['target'] = Release::where('platform', '1')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['pc']['broad'] = Release::where('platform', '1')->where('ring', '7')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['pc']['ltsc'] = Release::where('platform', '1')->where('ring', '8')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        $flights['xbox']['skip'] = Release::where('platform', '3')->where('ring', '1')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['xbox']['active'] = Release::where('platform', '3')->where('ring', '2')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['xbox']['slow'] = Release::where('platform', '3')->where('ring', '3')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['xbox']['preview'] = Release::where('platform', '3')->where('ring', '4')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['xbox']['release'] = Release::where('platform', '3')->where('ring', '5')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['xbox']['target'] = Release::where('platform', '3')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        $flights['server']['slow'] = Release::where('platform', '4')->where('ring', '3')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['server']['target'] = Release::where('platform', '4')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['server']['ltsc'] = Release::where('platform', '4')->where('ring', '8')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        $flights['iot']['slow'] = Release::where('platform', '6')->where('ring', '3')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['iot']['target'] = Release::where('platform', '6')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['iot']['broad'] = Release::where('platform', '6')->where('ring', '7')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        $flights['holo']['active'] = Release::where('platform', '5')->where('ring', '2')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['holo']['slow'] = Release::where('platform', '5')->where('ring', '3')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['holo']['target'] = Release::where('platform', '5')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['holo']['broad'] = Release::where('platform', '5')->where('ring', '7')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['holo']['ltsc'] = Release::where('platform', '5')->where('ring', '8')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        $flights['team']['target'] = Release::where('platform', '7')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['team']['broad'] = Release::where('platform', '7')->where('ring', '7')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        $flights['mobile']['target'] = Release::where('platform', '2')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['mobile']['broad'] = Release::where('platform', '2')->where('ring', '7')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        $flights['sdk']['target'] = Release::where('platform', '9')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();
        $flights['iso']['target'] = Release::where('platform', '8')->where('ring', '6')->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->first();

        return view('rings.index', compact('flights'));
    }
}
