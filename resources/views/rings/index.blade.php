@extends('layouts.app')
@section('title') Channels @endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="pt-2 mb-2">Channels</h2>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link {{ Request::is('rings') ? 'active' : '' }}" href="{{ route('rings') }}">Overview</a>
                <a class="nav-link {{ Request::is('rings/pc') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'pc']) }}">PC</a>
                <a class="nav-link {{ Request::is('rings/xbox') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'xbox']) }}">Xbox</a>
                <a class="nav-link {{ Request::is('rings/server') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'server']) }}">Server</a>
                <a class="nav-link {{ Request::is('rings/10x') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => '10x']) }}">10X</a>
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
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['dev'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['beta'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['release-preview'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['sa'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['sa-b'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['pc']['lts'] ) ?></div>
        </div>
    </div>
    <div class="col-12" id="xbox">
        <p class="h3 xbox">{!! getPlatformIconNoStyle(3) !!} Xbox</p>
        <div class="row row-gutter">
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['skip'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['dev'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['beta'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['preview'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['release-preview'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['xbox']['sa'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-6" id="server">
        <p class="h3 server">{!! getPlatformIconNoStyle(4) !!} Server</p>
        <div class="row row-gutter">
            <div class="col-xl col-sm-4 col-6"><?php getTile( $flights['server']['beta'] ) ?></div>
            <div class="col-xl col-sm-4 col-6"><?php getTile( $flights['server']['sa'] ) ?></div>
            <div class="col-xl col-sm-4 col-12"><?php getTile( $flights['server']['lts'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-2" id="10x">
        <p class="h3 10x">{!! getPlatformIconNoStyle(10) !!} 10X</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['10x']['beta'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-4" id="iot">
        <p class="h3 iot">{!! getPlatformIconNoStyle(6) !!} IoT</p>
        <div class="row row-gutter">
            <div class="col-xl col-6"><?php getTile( $flights['iot']['sa'] ) ?></div>
            <div class="col-xl col-6"><?php getTile( $flights['iot']['sa-b'] ) ?></div>
        </div>
    </div>
    <div class="col-12" id="holographic">
        <p class="h3 holographic">{!! getPlatformIconNoStyle(5) !!} Holographic</p>
        <div class="row row-gutter">
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['holographic']['dev'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['holographic']['beta'] ) ?></div>
            <div class="col-md col-sm-4 col-6"><?php getTile( $flights['holographic']['sa'] ) ?></div>
            <div class="col-md col-sm-6 col-6"><?php getTile( $flights['holographic']['sa-b'] ) ?></div>
            <div class="col-md col-sm-6 col-12"><?php getTile( $flights['holographic']['lts'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-8 col-12" id="team">
        <p class="h3 team">{!! getPlatformIconNoStyle(7) !!} Team</p>
        <div class="row row-gutter">
            <div class="col-md col-6"><?php getTile( $flights['team']['dev'] ) ?></div>
            <div class="col-md col-6"><?php getTile( $flights['team']['beta'] ) ?></div>
            <div class="col-md col-6"><?php getTile( $flights['team']['sa'] ) ?></div>
            <div class="col-md col-6"><?php getTile( $flights['team']['sa-b'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-2 col-6" id="sdk">
        <p class="h3 sdk">{!! getPlatformIconNoStyle(9) !!} SDK</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['sdk']['sa'] ) ?></div>
        </div>
    </div>
    <div class="col-lg-2 col-6" id="iso">
        <p class="h3 iso">{!! getPlatformIconNoStyle(8) !!} ISO</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['iso']['sa'] ) ?></div>
        </div>
    </div>
</div>
@endsection
