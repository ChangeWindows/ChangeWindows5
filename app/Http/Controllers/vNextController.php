<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VNext;
use Parsedown;

class vNextController extends Controller
{
    public function index($platform = 'pc') {
        $platform_id = $platform === null ? 1 : getPlatformIdByClass($platform);

        $changelog = VNext::findOrFail($platform_id);
        $parsedown = new Parsedown();

        return view('vnext.show', compact('changelog', 'parsedown'));
    }

    public function edit(Request $request, $platform) {
        $this->authorize('edit_log');
        
        $platform_id = $platform === null ? 1 : getPlatformIdByClass($platform);

        $changelog = VNext::findOrFail($platform_id);

        return view('vnext.edit', compact('changelog'));
    }

    public function update(Request $request, $platform) {
        $this->authorize('edit_log');

        $changelog = VNext::find($platform);
        
        $changelog->changelog = request()->get('changelog');
        $changelog->save();

        return redirect('/vnext/'.getPlatformClass($platform));
    }
}
