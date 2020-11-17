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
        <form method="POST" action="{{ route('front.profile.changePassword', $user) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="row">
                <div class="col-12">
                    <h3 class="h2">Settings <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-fw fa-save"></i> Save</button></h3>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="password_confirmation">Confirm password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
