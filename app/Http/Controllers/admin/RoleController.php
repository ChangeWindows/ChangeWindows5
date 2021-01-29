<?php

namespace App\Http\Controllers\Admin;

use App\Ability;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->authorize('show_roles');

        $roles = Role::get();

        return view('core.roles.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggle(Role $role, Ability $ability) {
        $this->authorize('assign_ability');

        if ($role->abilities->contains($ability)) {
            $role->abilities()->detach($ability);
        } else {
            $role->allowTo($ability);
        }

        return redirect()->route('admin.roles.edit', $role)->with('status', 'The role <b>'.$role->name.'</b> now has the <b>'.$ability->name.'</b>-permission.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_role');

        $this->validate(request(), [
            'name' => ['required'],
            'description' => ['required']
        ]);

        $role = Role::create([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return redirect()->route('admin.roles.edit', $role)->with('status', 'The role <b>'.$role->name.'</b> has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {
        $this->authorize('show_roles');

        $abilities = Ability::get();

        return view('core.roles.edit', compact('role', 'abilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role) {
        $this->authorize('edit_role');

        $this->validate(request(), [
            'name' => ['required'],
            'description' => ['required']
        ]);

        $role->update([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return redirect()->route('admin.roles')->with('status', 'The changes for <b>'.$role->name.'</b> have been stored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) {
        $this->authorize('delete_role');

        $role->delete();

        return redirect()->route('admin.roles')->with('status', 'The role <b>'.$role->title.'</b> has been removed.');
    }

    public function default(Role $role) {
        $this->authorize('edit_role');

        $default_roles = Role::where('is_default', 1)->get();

        foreach ($default_roles as $default_role) {
            $default_role->update(['is_default' => 0]);
        }

        $role->update(['is_default' => 1]);

        return redirect()->route('admin.roles')->with('status', '<b>'.$role->name.'</b> is now the default role for new users.');
    }
}
