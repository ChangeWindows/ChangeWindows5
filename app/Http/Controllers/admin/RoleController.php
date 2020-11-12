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

        return redirect()->route('admin.roles.edit', $role)->with('status', 'De rol <b>'.$role->name.'</b> heeft nu de <b>'.$ability->name.'</b>-permissie.');
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
        ], [
            'name.required' => 'De rol moet een naam hebben.',
            'description.required' => 'De rol moet een beschrijving hebben.'
        ]);

        $role = Role::create([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return redirect()->route('admin.roles.edit', $role)->with('status', 'De rol <b>'.$role->name.'</b> is aangemaakt, je kan het nu bewerken.');
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
        ], [
            'name.required' => 'De rol moet een naam hebben.',
            'description.required' => 'De rol moet een beschrijving hebben.'
        ]);

        $role->update([
            'name' => request('name'),
            'description' => request('description')
        ]);

        return redirect()->route('admin.roles')->with('status', 'De wijzigingen voor <b>'.$role->name.'</b> zijn opgeslagen.');
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

        return redirect()->route('admin.roles')->with('status', 'De rol <b>'.$role->title.'</b> is verwijderd.');
    }

    public function default(Role $role) {
        $this->authorize('edit_role');

        $default_roles = Role::where('is_default', 1)->get();

        foreach ($default_roles as $default_role) {
            $default_role->update([ 'is_default' => 0 ]);
        }

        $role->update([ 'is_default' => 1 ]);

        return redirect()->route('admin.roles')->with('status', '<b>'.$role->name.'</b> is nu de standaard rol voor nieuwe gebruikers.');
    }
}
