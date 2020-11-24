@extends('layouts.app')
@section('title') Timeline @endsection

@php
    $previous = null;
@endphp

@section('toolset')
<a class="dropdown-item" href="https://viv.changewindows.org/admin/flights"><i class="far fa-fw fa-plus"></i> New flight</a>
<div class="dropdown-divider"></div>
@endsection

@section('hero')
<div class="jumbotron highlights tabs">
    <div class="container">
<!--
        <div class="row">
            <div class="col-lg-8 col-sm-6">
                <a class="hero hero-preview" href="https://medium.com/changewindows/changewindows-5-0-b0e63d01067">
                    <span class="text">
                        <span class="h2">ChangeWindows 5</span>
                        <span class="h5">Welcome to a brand new ChangeWindows</span>
                    </span>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6 d-none d-sm-block">
                <a class="hero hero-buildfeed" href="{{ route('buildfeed') }}">
                    <span class="text">
                        <span class="h2">BuildFeed</span>
                        <span class="h5">but archived</span>
                    </span>
                </a>
            </div>
        </div>
-->
        <nav class="nav">
            <a class="nav-link {{ $request->platform == '' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => null, 'ring' => $request->ring]) }}">All</a>
            <a class="nav-link {{ $request->platform == 'pc' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'pc', 'ring' => $request->ring]) }}">PC</a>
            <a class="nav-link {{ $request->platform == 'xbox' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'xbox', 'ring' => $request->ring]) }}">Xbox</a>
            <a class="nav-link {{ $request->platform == 'server' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'server', 'ring' => $request->ring]) }}">Server</a>
            <a class="nav-link {{ $request->platform == 'tenx' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'tenx', 'ring' => $request->ring]) }}">10X</a>
            <a class="nav-link {{ $request->platform == 'holographic' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'holographic', 'ring' => $request->ring]) }}">Holographic</a>
            <a class="nav-link {{ $request->platform == 'team' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'team', 'ring' => $request->ring]) }}">Team</a>
            <a class="nav-link {{ $request->platform == 'iot' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'iot', 'ring' => $request->ring]) }}">IoT</a>
            <a class="nav-link {{ $request->platform == 'sdk' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'sdk', 'ring' => $request->ring]) }}">SDK</a>
            <a class="nav-link {{ $request->platform == 'iso' ? 'active' : '' }}" href="{{ route('timeline', ['platform' => 'iso', 'ring' => $request->ring]) }}">ISO</a>
            <a class="nav-link dropdown {{ $request->platform == 'mobile' ? 'active' : '' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-ellipsis-h"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('timeline', ['platform' => 'mobile', 'ring' => $request->ring]) }}"><i class="far fa-fw fa-mobile"></i> Mobile</a>
            </div>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="row px-n10">
    <div class="col-lg-7">
        <div class="text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-light btn-filter dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="filter-title">Ring:</span> {{ getRingByClass($request->ring) }}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => null]) }}">All</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'skip']) }}">Fast Skip Ahead/Alpha Skip Ahead</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'fast']) }}">Fast Active/Alpha Active/Fast/Dev</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'slow']) }}">Slow/Beta/Preview</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'preview']) }}">Delta</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'release']) }}">Release Preview/Omega</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'targeted']) }}">Semi-Annual Targeted/Release</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'broad']) }}">Semi-Annual Broad</a>
                    <a class="dropdown-item" href="{{ route('timeline', ['platform' => $request->platform, 'ring' => 'lts']) }}">Long-Term Servicing</a>
                </div>
                @auth
                    @if (Auth::user()->hasAnyRole(['Admin']))
                        <a class="btn btn-light btn-filter" href="https://viv.changewindows.org/admin/flights"><span class="filter-title"><i class="far text-primary fa-fw fa-plus"></i> Flight</span></a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="timeline">
            @if ($timeline)
                @foreach ($timeline as $date => $builds)
                    <div class="date-heading">{{ $date }}</div>
                    <div></div>
                    @foreach ($builds as $build => $deltas)
                        @foreach ($deltas as $delta => $platforms)
                            @foreach ($platforms as $platform => $rings)
                                <div class="timeline-row">
                                    <a class="row" href="{{ route('platformMilestone', ['id' => $rings['default']->milestone, 'platform' => getPlatformClass($platform)]) }}">
                                        <div class="col-6 col-md-4 build"><span class="pr-2 platform-icon">{!! getPlatformIcon($platform) !!}</span> {{ $build }}.{{ $delta }}</div>
                                        <div class="col-6 col-md-8 ring">
                                            @foreach ($rings as $name => $ring)
                                                @if ($name !== 'default')
                                                    <span class="label {{ $ring->class }}">{{ $ring->flight }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </a>
                                    <a class="dot-container" data-toggle="tooltip" data-placement="left" title="Version {{ $rings['default']->version }}">
                                        <span class="dot" style="background-color: #{{ $rings['default']->color }}"></span>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @else
                <div class="no-results text-center">
                    <h3>No results have been found.</h3>
                    <p class="lead">Your current selection has no flights. Try to change the platform and/or ring.</p>
                </div>
            @endif
        </div>
        {{ $releases->appends(['platform' => $request->platform, 'ring' => $request->ring])->links() }}
    </div>
    <div class="d-none d-lg-block col-lg-5">
        <div class="row row-gutter">
            <div class="col">
                <a href="{{ route('showVNext') }}" class="btn btn-vnext btn-block">The changelog for the next public release</a>
            </div>
        </div>
        <p class="h3 font-weight-bold pc">{!! getPlatformIconNoStyle(1) !!} PC</p>
        <div class="row row-gutter">
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['pc']['fast'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['pc']['slow'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['pc']['release'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['pc']['targeted'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['pc']['broad'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['pc']['ltsc'] ) ?></div>
        </div>
        <p class="h3 font-weight-bold xbox">{!! getPlatformIconNoStyle(3) !!} Xbox</p>
        <div class="row row-gutter">
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['skip'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['fast'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['slow'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['preview'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['release'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['targeted'] ) ?></div>
        </div>
        <p class="h3 font-weight-bold iot">{!! getPlatformIconNoStyle(6) !!} IoT</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['iot']['targeted'] ) ?></div>
            <div class="col"><?php getTile( $flights['iot']['broad'] ) ?></div>
        </div>
        <p class="h3 font-weight-bold server">{!! getPlatformIconNoStyle(4) !!} Server</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['server']['slow'] ) ?></div>
            <div class="col"><?php getTile( $flights['server']['targeted'] ) ?></div>
            <div class="col"><?php getTile( $flights['server']['ltsc'] ) ?></div>
        </div>
        <p class="h3 font-weight-bold tenx">{!! getPlatformIconNoStyle(10) !!} 10X</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['tenx']['slow'] ) ?></div>
        </div>
        <p class="h3 font-weight-bold holographic">{!! getPlatformIconNoStyle(5) !!} Holographic</p>
        <div class="row row-gutter">
            <div class="col-xl-6 col-lg-6 col-sm-6 col-6"><?php getTile( $flights['holo']['fast'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-6"><?php getTile( $flights['holo']['slow'] ) ?></div>
            <div class="col-xl-4 col-lg-12 col-sm-4 col-12"><?php getTile( $flights['holo']['targeted'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['holo']['broad'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['holo']['ltsc'] ) ?></div>
        </div>
        <p class="h3 font-weight-bold team">{!! getPlatformIconNoStyle(7) !!} Team</p>
        <div class="row row-gutter">
            <div class="col-6"><?php getTile( $flights['team']['fast'] ) ?></div>
            <div class="col-6"><?php getTile( $flights['team']['slow'] ) ?></div>
            <div class="col-6"><?php getTile( $flights['team']['targeted'] ) ?></div>
            <div class="col-6"><?php getTile( $flights['team']['broad'] ) ?></div>
        </div>
        <div class="row no-gutters mt-2">
            <div class="col">
                <p class="h3 font-weight-bold sdk">{!! getPlatformIconNoStyle(9) !!} SDK</p>
                <div class="row row-gutter">
                    <div class="col"><?php getTile( $flights['sdk']['targeted'] ) ?></div>
                </div>
            </div>
            <div class="col">
                <p class="h3 font-weight-bold iso">{!! getPlatformIconNoStyle(8) !!} ISO</p>
                <div class="row row-gutter">
                    <div class="col"><?php getTile( $flights['iso']['targeted'] ) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection