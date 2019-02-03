<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Release;
use App\Milestone;

class RingsController extends Controller
{
    public function index() {
        $flights['pc']['skip'] = Release::pc()->skip()->latestFlight()->first();
        $flights['pc']['fast'] = Release::pc()->active()->latestFlight()->first();
        $flights['pc']['slow'] = Release::pc()->slow()->latestFlight()->first();
        $flights['pc']['release'] = Release::pc()->release()->latestFlight()->first();
        $flights['pc']['targeted'] = Release::pc()->targeted()->latestFlight()->first();
        $flights['pc']['broad'] = Release::pc()->broad()->latestFlight()->first();
        $flights['pc']['ltsc'] = Release::pc()->ltsc()->latestFlight()->first();

        $flights['xbox']['skip'] = Release::xbox()->skip()->latestFlight()->first();
        $flights['xbox']['fast'] = Release::xbox()->active()->latestFlight()->first();
        $flights['xbox']['slow'] = Release::xbox()->slow()->latestFlight()->first();
        $flights['xbox']['preview'] = Release::xbox()->preview()->latestFlight()->first();
        $flights['xbox']['release'] = Release::xbox()->release()->latestFlight()->first();
        $flights['xbox']['targeted'] = Release::xbox()->targeted()->latestFlight()->first();

        $flights['server']['slow'] = Release::server()->slow()->latestFlight()->first();
        $flights['server']['targeted'] = Release::server()->targeted()->latestFlight()->first();
        $flights['server']['ltsc'] = Release::server()->ltsc()->latestFlight()->first();

        $flights['iot']['slow'] = Release::iot()->slow()->latestFlight()->first();
        $flights['iot']['targeted'] = Release::iot()->targeted()->latestFlight()->first();
        $flights['iot']['broad'] = Release::iot()->broad()->latestFlight()->first();

        $flights['holo']['fast'] = Release::holographic()->active()->latestFlight()->first();
        $flights['holo']['slow'] = Release::holographic()->slow()->latestFlight()->first();
        $flights['holo']['targeted'] = Release::holographic()->targeted()->latestFlight()->first();
        $flights['holo']['broad'] = Release::holographic()->broad()->latestFlight()->first();
        $flights['holo']['ltsc'] = Release::holographic()->ltsc()->latestFlight()->first();

        $flights['team']['targeted'] = Release::team()->targeted()->latestFlight()->first();
        $flights['team']['broad'] = Release::team()->broad()->latestFlight()->first();

        $flights['mobile']['targeted'] = Release::mobile()->targeted()->latestFlight()->first();
        $flights['mobile']['broad'] = Release::mobile()->broad()->latestFlight()->first();

        $flights['sdk']['targeted'] = Release::sdk()->targeted()->latestFlight()->first();
        $flights['iso']['targeted'] = Release::iso()->targeted()->latestFlight()->first();

        return view('rings.index', compact('flights'));
    }

    public function platform(Request $request, $platform) {
        $request->user()->authorizeRoles(['Admin', 'Insider']);
        $platform_id = getPlatformIdByClass($platform);

        $milestones = Milestone::orderBy('version', 'DESC')->get();

        foreach($milestones as $milestone) {
            if ( in_array( 1, $milestone->getFlights()[getPlatformClass($platform_id)] ) ) {
                $set[$milestone->id]['milestone'] = $milestone;

                foreach($milestone->getFlights()[getPlatformClass($platform_id)] as $ring => $flight) {
                    if ($flight == 1) {
                        $release = Release::where('milestone', $milestone->id)->where('ring', getRingIdByClass($ring))->orderBy('date', 'desc')->first();
                        $set[$milestone->id]['flights'][$ring] = $release;
                    } elseif ($flight == 0) {
                        $set[$milestone->id]['flights'][$ring] = false;
                    }
                }
            }
        }

        return view('rings.platform', compact('set'));
    }
}
