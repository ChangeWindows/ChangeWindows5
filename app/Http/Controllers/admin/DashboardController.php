<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('core.dashboard.index');
    }

    public function onboarding() {
        $user = Auth::user();

        $user->update(['onboarding' => config('app.viv')]);

        return redirect()->route('admin.dashboard');
    }
}
