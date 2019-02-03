@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Login</h2>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <img class="login-logo" src="{{ asset('img/logo_blue.png') }}" />

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
                
                <button type="submit" class="btn btn-primary">
                    <i class="fal fa-fw fa-sign-in"></i> Login
                </button>
                <a class="btn btn-light" href="{{ route('register') }}">
                    Register
                </a>
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Forgotten password
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
