@extends('layouts.app')
@section('title') Register @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center login-form">
        <div class="col-md-6">
            <div class="d-flex shadow-lg my-5">
                <div class="">
                    <img class="login-logo" src="{{ asset('img/logo.png') }}" />
                </div>
                <div class="flex-fill bg-g-primary text-white p-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h3>Register</h3>

                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <label for="email">E-mail address</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail address" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif

                        <label for="password-confirm">Confirm password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>

                        <div class="btn-toolbar justify-content-between">
                            <a class="btn btn-outline-light" href="{{ route('login') }}">
                                Login
                            </a>
                            <button type="submit" class="btn btn-light">
                                <i class="far fa-fw fa-user-plus"></i> Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
