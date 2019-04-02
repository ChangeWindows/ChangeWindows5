<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $request->user()->authorizeRoles(['Admin', 'Editor', 'Platinum Insider', 'Gold Insider', 'Silver Insider', 'Bronze Insider', 'User']);

        return view('profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $request->user()->authorizeRoles(['Admin', 'Editor', 'Platinum Insider', 'Gold Insider', 'Silver Insider', 'Bronze Insider', 'User']);

        $user = User::find($id);

        $user->theme = request()->get('theme');

        $user->save();

        return redirect()->route('profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $request->user()->authorizeRoles('Admin');
        //
    }
}
