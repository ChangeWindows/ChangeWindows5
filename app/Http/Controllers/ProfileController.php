<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\Rule;

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
        $user = Auth::user();

        return view('profile.index', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function password() {
        $user = Auth::user();

        return view('profile.password', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user) {
        $attributes = request()->validate([
            'email' => ['string', 'required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'avatar' => ['nullable', 'mimes:png', 'max:40960', 'dimensions:min_width=400,min_height=400,max_width=400,max_height=400'],
        ], [
            'email.required' => 'Email is required.',
            'email.max' => 'Email cannot be longer than 255 characters.',
            'email.email' => 'Email is not a valid address.',
            'avatar.mimes' => 'Avatar is not a png-file.',
            'avatar.dimensions' => 'Avatar must be 400x400 pixels in size.'
        ]);

        $updateable = [
            'email' => request('email'),
            'theme' => request('theme')
        ];

        if (request('avatar')) {
            $media = request()->file('avatar');
            $storage_location = $media->store('avatars');

            $updateable['avatar_path'] = $storage_location;
        }

        $user->update($updateable);

        return redirect()->route('front.profile')->with('status', 'Your changes have been saved.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(User $user) {
        $attributes = request()->validate([
            'password' => ['nullable', 'string', 'min:8', 'max:255', 'confirmed']
        ], [
            'password.min' => 'Wachtwoord moet minstens 8 tekens bevatten.',
            'password.max' => 'Wachtwoord mag maximum 255 tekens bevatten.',
            'password.confirmed' => 'Wachtwoord komt niet overeen.'
        ]);

        $user->update([
            'password' => request('password')
        ]);

        return redirect()->route('front.profile')->with('status', 'Your password has been updated.');
    }
}
