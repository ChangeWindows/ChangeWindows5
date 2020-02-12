@extends('layouts.app')
@section('title') Login @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center login-form">
        <div class="col-md-6">
            <div class="d-flex shadow-lg my-5">
                <div class="">
                    <img class="login-logo" src="{{ asset('img/logo.png') }}" />
                </div>
                <div class="flex-fill bg-g-primary text-white p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h3>Login</h3>

                        <label for="email">E-mail address</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>

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

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Remember me</label>
                        </div>

                        <div class="btn-toolbar justify-content-between">
                            <a class="btn btn-outline-light" href="{{ route('password.request') }}">
                                Forgotten password
                            </a>
                            <button type="submit" class="btn btn-light">
                                <i class="far fa-fw fa-sign-in"></i> Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
