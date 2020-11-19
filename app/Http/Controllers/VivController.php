<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patreon;

class VivController extends Controller
{
    public function index() {
        return view('viv.index');
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
