<?php

namespace App\Http\Controllers\Admin;

use App\Platform;
use App\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlatformController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->authorize('show_platforms');

        $platforms = Platform::orderBy('position')->get();

        return view('core.platforms.index', compact('platforms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_platform');

        $this->validate(request(), [
            'name' => ['required'],
            'color' => ['required'],
            'position' => ['required'],
            'icon' => ['required']
        ], [
            'name.required' => 'The name is required.',
            'color.required' => 'The color is required.',
            'position.required' => 'The position is required.',
            'icon.required' => 'The icon is required.'
        ]);

        $platform = Platform::create([
            'name' => request('name'),
            'color' => '#'.request('color'),
            'position' => request('position'),
            'icon' => request('icon')
        ]);

        return redirect()->route('admin.platforms.edit', $platform)->with('status', 'The platform <b>'.$platform->name.'</b> has been added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\Response
     */
    public function edit(Platform $platform) {
        $this->authorize('edit_platform');

        $channels = Channel::all();

        return view('core.platforms.edit', compact('platform', 'channels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Platform $platform) {
        $this->authorize('edit_platform');

        $this->validate(request(), [
            'name' => ['required'],
            'color' => ['required'],
            'position' => ['required'],
            'icon' => ['required']
        ], [
            'name.required' => 'The name is required.',
            'color.required' => 'The color is required.',
            'position.required' => 'The position is required.',
            'icon.required' => 'The icon is required.'
        ]);

        $platform->update([
            'name' => request('name'),
            'color' => '#'.request('color'),
            'position' => request('position'),
            'icon' => request('icon'),
            'active' => request('active') !== null ? 1 : 0
        ]);

        return redirect()->route('admin.platforms')->with('status', 'The changes to <b>'.$platform->name.'</b> have been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Platform $platform) {
        $this->authorize('delete_platform');

        $platform->delete();

        return redirect()->route('admin.platforms')->with('status', 'The platform <b>'.$platform->name.'</b> has been removed.');
    }
}
