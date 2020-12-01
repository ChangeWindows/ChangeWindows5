<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->authorize('show_channels');

        $channels = Channel::all();

        return view('core.channels.index', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->authorize('create_channel');

        $this->validate(request(), [
            'name' => ['required'],
            'color' => ['required'],
            'position' => ['required']
        ], [
            'name.required' => 'The name is required.',
            'color.required' => 'The color is required.',
            'position.required' => 'The position is required.'
        ]);

        $channel = Channel::create([
            'name' => request('name'),
            'color' => '#'.request('color'),
            'position' => request('position')
        ]);

        return redirect()->route('admin.channels.edit', $channel)->with('status', 'The channel <b>'.$channel->name.'</b> has been added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel) {
        $this->authorize('edit_channel');

        return view('core.channels.edit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel) {
        $this->authorize('edit_channel');

        $this->validate(request(), [
            'name' => ['required'],
            'color' => ['required'],
            'position' => ['required']
        ], [
            'name.required' => 'The name is required.',
            'color.required' => 'The color is required.',
            'position.required' => 'The position is required.'
        ]);

        $channel->update([
            'name' => request('name'),
            'color' => '#'.request('color'),
            'position' => request('position')
        ]);

        return redirect()->route('admin.channels')->with('status', 'The changes to <b>'.$channel->name.'</b> have been saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel) {
        $this->authorize('delete_channel');

        $channel->delete();

        return redirect()->route('admin.channels')->with('status', 'The channel <b>'.$channel->name.'</b> has been removed.');
    }
}
