@extends('layouts.app')
@section('title') Reset password @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Reset password</h2>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form method="POST" action="{{ route('password.update') }}" class="login-form">
                @csrf

                <img class="login-logo" src="{{ asset('img/logo.png') }}" />
                <input type="hidden" name="token" value="{{ $token }}">

                <label for="email">E-mail address</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="E-mail address" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <label for="password">Password</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placehlder="Password" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <label for="password-confirm">Confirm password</label>

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>

                <button type="submit" class="btn btn-primary">
                    <i class="far fa-fw fa-key"></i> Reset password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
