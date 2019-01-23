<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Milestone;

class RingsController extends Controller
{
    public function index() {

        $set['pc'] = Release::where('platform', '1')->whereIn('ring', array(1, 2, 3, 5, 6, 7, 8))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['xbox'] = Release::where('platform', '3')->whereIn('ring', array(1, 2, 3, 4, 5, 6))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['server'] = Release::where('platform', '4')->whereIn('ring', array(3, 6, 8))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['iot'] = Release::where('platform', '6')->whereIn('ring', array(3, 6, 7))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['holo'] = Release::where('platform', '5')->whereIn('ring', array(2, 3, 6, 7, 8))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['team'] = Release::where('platform', '7')->whereIn('ring', array(6, 7))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['mobile'] = Release::where('platform', '2')->whereIn('ring', array(6, 7))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['sdk'] = Release::where('platform', '9')->whereIn('ring', array(6))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');
        $set['iso'] = Release::where('platform', '8')->whereIn('ring', array(6))->orderBy('build', 'desc')->orderBy('delta', 'desc')->orderBy('date', 'desc')->groupBy('ring')->get()->keyBy('ring');

        foreach($set as $platform => $rings) {
            foreach($rings as $ring => $release) {
                $flights[$platform][getRingClassById($ring)] = $release;
            }
        }

        return view('rings.index', compact('flights'));
    }

    public function platform(Request $request, $platform_id) {
        $request->user()->authorizeRoles(['Admin', 'Insider']);

        $milestones = Milestone::orderBy('version', 'DESC')->get();

        return view('rings.platform', compact('milestones'));
    }
}
