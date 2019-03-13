@extends('layouts.app')
@section('title') @yield('title') @endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fal fa-rss"></i> BuildFeed</h2>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link {{ Request::is('buildfeed*') && !Request::is('buildfeed/about') ? 'active' : '' }}" href="{{ route('buildfeed') }}">BuildFeed</a>
                <a class="nav-link {{ Request::is('buildfeed/about') ? 'active' : '' }}" href="{{ route('aboutBuildfeed') }}">About</a>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
    @yield('content')
@endsection