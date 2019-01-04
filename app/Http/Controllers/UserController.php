<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
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
        $request->user()->authorizeRoles('Admin');

        $users = User::paginate(50);

        return view('users', compact('users'));
    }

    public function promote(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $user = User::find($id);

        $old_role = Role::find($user->roles[0]->id);
        $new_role = Role::find($user->roles[0]->id - 1);

        $user->roles()->detach($old_role);
        $user->roles()->attach($new_role);

        return redirect('/users');
    }

    public function demote(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $user = User::find($id);

        $old_role = Role::find($user->roles[0]->id);
        $new_role = Role::find($user->roles[0]->id + 1);

        $user->roles()->detach($old_role);
        $user->roles()->attach($new_role);

        return redirect('/users');
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
    public function edit($id) {
        //
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
    public function destroy(Request $request, $id) {
        $request->user()->authorizeRoles('Admin');

        $user = User::find($id);
        $user->delete();

        return redirect('/users');
    }
}
