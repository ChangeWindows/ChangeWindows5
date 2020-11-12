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
            'phone' => ['required'],
            'email' => ['required', 'email']
        ], [
            'name.required' => 'De achternaam is vereist.',
            'role_id.required' => 'De permissie is vereist.',
            'phone.required' => 'Het telefoonnummer is vereist.',
            'email.required' => 'Het e-mail adres is vereist.',
            'email.email' => 'Het gegeven e-mail adres is niet geldig.',
        ]);

        $user->update([
            'name' => request('name'),
            'role_id' => request('role_id'),
            'email' => request('email'),
            'phone' => request('phone')
        ]);

        return redirect()->route('admin.accounts')->with('status', 'De wijzigingen voor <b>'.$user->name.'</b> zijn opgeslagen.');
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

        return redirect()->route('admin.users')->with('status', 'De gebruiker <b>'.$user->name.'</b> is verwijderd.');
    }
}
