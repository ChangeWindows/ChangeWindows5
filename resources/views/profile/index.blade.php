@extends('layouts.app')
@section('title') {{ $user->name }} @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2><span class="fw-light">Hello</span> {{ $user->name }}</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-8">
        <form method="POST" action="{{ route('front.profile.update', $user) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-12">
                    <h3 class="h2">Settings <button type="submit" class="btn btn-sm btn-primary float-end"><i class="far fa-fw fa-save"></i> Save</button></h3>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" name="email" id="email" required placeholder="Email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="avatar">Avatar</label>
                    <div class="form-file @error('avatar') is-invalid @enderror">
                        <input type="file" class="form-control" name="avatar" id="avatar">
                    </div>
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small id="avatarHelp" class="form-text">Must be a <b>png</b>-file of 400 by 400 pixels.</small>
                </div>
                <div class="col-12">
                    <label class="form-label" for="theme">Theme</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="theme-white" name="theme" value="0" {{ Auth::user()->theme == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="theme-white">White</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="theme-light" name="theme" value="1" {{ Auth::user()->theme == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="theme-light">Light</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="theme-dark" name="theme" value="2" {{ Auth::user()->theme == 2 ? 'checked' : '' }}>
                        <label class="form-check-label" for="theme-dark">Dark</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="theme-black" name="theme" value="3" {{ Auth::user()->theme == 3 ? 'checked' : '' }}>
                        <label class="form-check-label" for="theme-black">Black</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3 class="h5 mt-4">Password</h3>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <a href="{{ route('front.profile.password') }}" class="btn btn-sm btn-primary"><i class="far fa-fw fa-key"></i> Change password</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-4">
        <h2>Details</h2>
        <p>
            <b>Name</b>: {{ $user->name }}<br />
            <b>Email</b>: {{ $user->email }}<br />
            <b>Role</b>: {{ $user->role->name }}
        </p>
    </div>
</div>
@endsection
