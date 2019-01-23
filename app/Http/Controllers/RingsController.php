<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Milestone;

class RingsController extends Controller
{
    public function index() {
        $set['pc'] = Release::platformRings(1)->latestFlight()->allRings();
        $set['xbox'] = Release::platformRings(3)->latestFlight()->allRings();
        $set['server'] = Release::platformRings(4)->latestFlight()->allRings();
        $set['iot'] = Release::platformRings(6)->latestFlight()->allRings();
        $set['holo'] = Release::platformRings(5)->latestFlight()->allRings();
        $set['team'] = Release::platformRings(7)->latestFlight()->allRings();
        $set['mobile'] = Release::platformRings(2)->latestFlight()->allRings();
        $set['sdk'] = Release::platformRings(8)->latestFlight()->allRings();
        $set['iso'] = Release::platformRings(9)->latestFlight()->allRings();

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

        foreach($milestones as $milestone) {
            if ( in_array( 1, $milestone->getFlights()[getPlatformClass($platform_id)] ) ) {
                $set[$milestone->id]['milestone'] = $milestone;
                $releases = Release::platformRings(1)->latestFlight()->allRings();

                foreach($milestone->getFlights()[getPlatformClass($platform_id)] as $ring => $flight) {
                    if ($flight == 1) {
                        $set[$milestone->id]['flights'][$ring] = $releases[getRingIdByClass($ring)];
                    } elseif ($flight == 0) {
                        $set[$milestone->id]['flights'][$ring] = false;
                    }
                }
            }
        }

        return view('rings.platform', compact('set'));
    }
}
