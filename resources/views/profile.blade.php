@extends('layouts.app')
@section('title') {{ Auth::user()->name }} @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Hello {{ Auth::user()->name }} {{ getBadge(Auth::user()->getBadge()) }}</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-8">
        <h2>Settings</h2>
        <form method="POST" action="{{ route('updateProfile', Auth::user()->id) }}" class="row">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-12">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="theme-white" name="theme" value="0" {{ Auth::user()->theme == 0 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="theme-white">White</label>
                </div>
                @auth
                    @if (Auth::user()->hasAnyRole(['Admin', 'Insider']))
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="theme-light" name="theme" value="1" {{ Auth::user()->theme == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="theme-light">Light</label>
                        </div>
                    @endif
                @endauth
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="theme-dark" name="theme" value="2" {{ Auth::user()->theme == 2 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="theme-dark">Dark</label>
                </div>
                @auth
                    @if (Auth::user()->hasAnyRole(['Admin', 'Insider']))
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="theme-black" name="theme" value="3" {{ Auth::user()->theme == 3 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="theme-black">Black</label>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="spacing-20"></div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="fad fa-fw fa-save"></i> Save</button>
            </div>
        </form>
        @if (Auth::user()->hasAnyRole(['Admin', 'Insider']))
            <div class="spacing-20"></div>
            <h2>Insider features</h2>
            <p>There are currently no Insider features available.</p>
        @endif
    </div>
    <div class="col-12 col-md-4">
        <h2>Details</h2>
        <p>
            <b>Name</b>: {{ Auth::user()->name }}<br />
            <b>Email</b>: {{ Auth::user()->email }}<br />
            <b>Role</b>: {{ Auth::user()->role->name }}
        </p>
    </div>
</div>
@endsection
