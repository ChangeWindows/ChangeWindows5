<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Member;
use App\Role;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

class AccountController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->authorize('show_users');

        $users = User::orderBy('name')->paginate(50);

        return view('core.accounts.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $roles = Role::get();

        return view('core.accounts.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user) {
        $this->authorize('edit_user');

        $this->validate(request(), [
            'name' => ['required'],
            'role_id' => ['required'],
            'email' => ['required', 'email']
        ]);

        $user->update([
            'name' => request('name'),
            'role_id' => request('role_id'),
            'email' => request('email')
        ]);

        return redirect()->route('admin.accounts')->with('status', 'The changes for <b>'.$user->name.'</b> have been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $this->authorize('delete_user');

        $user->delete();

        return redirect()->route('admin.users')->with('status', 'The account <b>'.$user->name.'</b> has been removed.');
    }
}
