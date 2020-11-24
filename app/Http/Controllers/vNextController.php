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
}
