@extends('layouts.app')
@section('title') @yield('title') @endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2><span class="font-light">change</span><span class="font-bold">windows</span> <span class="font-light">viv</span></h2>
        <h5>Changing Windows one build at a time</h5>
        <div class="nav-scroll mt-2">
            <nav class="nav">
                <a class="nav-link {{ Request::is('viv') ? 'active' : '' }}" href="{{ route('viv') }}">About</a>
                <a class="nav-link {{ Request::is('viv/changelog') ? 'active' : '' }}" href="{{ route('vivChangelog') }}">Changelog</a>
                <a class="nav-link {{ Request::is('viv/terms') ? 'active' : '' }}" href="{{ route('vivTerms') }}">Terms</a>
                <a class="nav-link {{ Request::is('viv/privacy') ? 'active' : '' }}" href="{{ route('vivPrivacy') }}">Privacy</a>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
    @yield('content')
@endsection