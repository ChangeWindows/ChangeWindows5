<?php

namespace App\Http\Controllers\Admin;

use App\Ability;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbilityController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->authorize('show_abilities');

        $abilities = Ability::get();

        return view('core.abilities.index', compact('abilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_ability');

        $this->validate(request(), [
            'name' => ['required'],
            'label' => ['required']
        ], [
            'name.required' => 'De permissie moet een naam hebben.',
            'label.required' => 'De permissie moet een label hebben.'
        ]);

        $ability = Ability::create([
            'name' => request('name'),
            'label' => request('label')
        ]);

        return redirect()->route('admin.abilities.edit', $ability)->with('status', 'De permissie <b>'.$ability->name.'</b> is aangemaakt, je kan het nu bewerken.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function edit(Ability $ability) {
        return view('core.abilities.edit', compact('ability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ability $ability) {
        $this->authorize('edit_ability');

        $this->validate(request(), [
            'name' => ['required'],
            'label' => ['required']
        ], [
            'name.required' => 'De permissie moet een naam hebben.',
            'label.required' => 'De permissie moet een label hebben.'
        ]);

        $ability->update([
            'name' => request('name'),
            'label' => request('label')
        ]);

        return redirect()->route('admin.abilities')->with('status', 'De wijzigingen voor <b>'.$ability->name.'</b> zijn opgeslagen.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ability  $ability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ability $ability) {
        //
    }
}
