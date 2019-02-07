<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patreon;

class VivController extends Controller
{
    public function index() {
        $bronze = Patreon::where('amount', '=', 1)->orderBy('name', 'asc')->get();
        $silver = Patreon::where('amount', '>=', 2)->where('amount', '<', 5)->orderBy('name', 'asc')->get();
        $gold = Patreon::where('amount', '>=', 5)->where('amount', '<', 10)->orderBy('name', 'asc')->get();
        $platinum = Patreon::where('amount', '>=', 10)->orderBy('name', 'asc')->get();

        return view('viv.index', compact('bronze', 'silver', 'gold', 'platinum'));
    }

    public function changelog() {
        return view('viv.changelog');
    }

    public function terms() {
        return view('viv.terms');
    }

    public function privacy() {
        return view('viv.privacy');
    }
}
