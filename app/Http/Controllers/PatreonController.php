<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patreon;

class PatreonController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index(Request $request) {
        $request->user()->authorizeRoles('Admin');
        
        $patreons = Patreon::orderBy('amount', 'desc')
                            ->orderBy('name', 'desc')
                            ->paginate(50);

        return view('patreon.index', compact('patreons'));
    }

    public function edit(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $patreon = Patreon::find($id);

        return view('patreon.edit', compact('patreon'));
    }

    public function store(Request $request) {
        $request->user()->authorizeRoles('Admin');

        Patreon::create([
            'name' => request()->get('name'),
            'amount' => request()->get('amount')
        ]);

        return redirect('/patreons');
    }

    public function update(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $patreon = Patreon::find($id);

        $patreon->name = request()->get('name');
        $patreon->amount = request()->get('amount');

        $patreon->save();

        return redirect('/patreons');
    }

    public function destroy(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');
        
        Patreon::destroy($id);

        return redirect('/patreons');
    }
}
