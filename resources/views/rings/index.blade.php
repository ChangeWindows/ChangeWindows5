@extends('layouts.app')
@section('title') Rings @endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="pt-2 mb-2">Rings</h2>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link {{ Request::is('rings') ? 'active' : '' }}" href="{{ route('rings') }}">Overview</a>
                <a class="nav-link {{ Request::is('rings/pc') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'pc']) }}">PC</a>
                <a class="nav-link {{ Request::is('rings/xbox') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'xbox']) }}">Xbox</a>
                <a class="nav-link {{ Request::is('rings/server') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'server']) }}">Server</a>
                <a class="nav-link {{ Request::is('rings/holographic') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'holographic']) }}">Holographic</a>
                <a class="nav-link {{ Request::is('rings/team') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'team']) }}">Team</a>
                <a class="nav-link {{ Request::is('rings/iot') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'iot']) }}">IoT</a>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row px-n10 rings">
    <div class="col-12" id="pc">
        <p class="h3 pc">{!! getPlatformIconNoStyle(1) !!} PC</p>
        <div class="row row-gutter">
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['fast'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['slow'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['release'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['targeted'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['broad'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['ltsc'] ) ?></div>
        </div>
    </div>
    <div class="col-12" id="xbox">
        <p class="h3 xbox">{!! getPlatformIconNoStyle(3) !!} Xbox</p>
        <div class="row row-gutter">
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['skip'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['fast'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['slow'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['preview'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['release'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['targeted'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-6" id="iot">
        <p class="h3 iot">{!! getPlatformIconNoStyle(6) !!} IoT</p>
        <div class="row row-gutter">
            <div class="col-xl col-6"><?php getTile( $flights['iot']['targeted'] ) ?></div>
            <div class="col-xl col-6"><?php getTile( $flights['iot']['broad'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-6" id="server">
        <p class="h3 server">{!! getPlatformIconNoStyle(4) !!} Server</p>
        <div class="row row-gutter">
            <div class="col-xl col-sm-4 col-6"><?php getTile( $flights['server']['slow'] ) ?></div>
            <div class="col-xl col-sm-4 col-6"><?php getTile( $flights['server']['targeted'] ) ?></div>
            <div class="col-xl col-sm-4 col-12"><?php getTile( $flights['server']['ltsc'] ) ?></div>
        </div>
    </div>
    <div class="col-12" id="holographic">
        <p class="h3 holographic">{!! getPlatformIconNoStyle(5) !!} Holographic</p>
        <div class="row row-gutter">
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['holo']['fast'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['holo']['slow'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['holo']['targeted'] ) ?></div>
            <div class="col-md col-sm-6 col-6"><?php getTile( $flights['holo']['broad'] ) ?></div>
            <div class="col-md col-sm-6 col-12"><?php getTile( $flights['holo']['ltsc'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-8 col-12" id="team">
        <p class="h3 team">{!! getPlatformIconNoStyle(7) !!} Team</p>
        <div class="row row-gutter">
            <div class="col-md col-6"><?php getTile( $flights['team']['fast'] ) ?></div>
            <div class="col-md col-6"><?php getTile( $flights['team']['slow'] ) ?></div>
            <div class="col-md col-6"><?php getTile( $flights['team']['targeted'] ) ?></div>
            <div class="col-md col-6"><?php getTile( $flights['team']['broad'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-2 col-6" id="sdk">
        <p class="h3 sdk">{!! getPlatformIconNoStyle(9) !!} SDK</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['sdk']['targeted'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-2 col-6" id="iso">
        <p class="h3 iso">{!! getPlatformIconNoStyle(8) !!} ISO</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['iso']['targeted'] ) ?></div>
        </div>
    </div>
</div>
@endsection
