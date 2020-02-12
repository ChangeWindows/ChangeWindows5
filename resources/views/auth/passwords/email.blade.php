@extends('layouts.app')
@section('title') Reset password @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center login-form">
        <div class="col-md-6">
            <div class="d-flex shadow-lg my-5">
                <div class="">
                    <img class="login-logo" src="{{ asset('img/logo.png') }}" />
                </div>
                <div class="flex-fill bg-g-primary text-white p-5">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <h3>Reset password</h3>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <label for="email">E-mail address</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-mail address" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <div class="btn-toolbar justify-content-between">
                            <button type="submit" class="btn btn-light">
                                <i class="far fa-fw fa-paper-plane"></i> Send password reset link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
