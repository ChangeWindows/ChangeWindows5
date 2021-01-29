<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MilestonePlatform;
use App\Milestone;
use App\Platform;

class MilestonePlatformController extends Controller {
    public function store(Milestone $milestone, Platform $platform) {
        $this->authorize('edit_milestone');

        $milestonePlatform = MilestonePlatform::create([
            'milestone_id' => $milestone->id,
            'platform_id' => $platform->id
        ]);

        return redirect()->back()->with('status', '<b>'.$milestonePlatform->platform->name.'</b> has been added to <b>'.$milestonePlatform->milestone->name.'</b>.');
    }

    public function destroy(MilestonePlatform $milestonePlatform) {
        $this->authorize('edit_milestone');

        $milestonePlatform->delete();

        return redirect()->back()->with('status', '<b>'.$milestonePlatform->platform->name.'</b> has been removed from <b>'.$milestonePlatform->milestone->name.'</b>.');
    }
}
