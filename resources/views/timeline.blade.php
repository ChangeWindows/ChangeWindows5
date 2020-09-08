@extends('layouts.app')
@section('title') Timeline @endsection

@php
    $previous = null;
@endphp

@section('toolset')
<a class="dropdown-item" href="#newBuildModal" data-toggle="modal" data-target="#newBuildModal"><i class="far fa-fw fa-plus"></i> New flight</a>
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
                        <a class="btn btn-light btn-filter" href="#newBuildModal" data-toggle="modal" data-target="#newBuildModal"><span class="filter-title"><i class="far text-primary fa-fw fa-plus"></i> Flight</span></a>
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

@section('modals')
@auth
    @if (Auth::user()->hasAnyRole(['Admin']))
        <div class="modal fade" id="newBuildModal" tabindex="-1" role="dialog" aria-labelledby="newBuildModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New build</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="far fa-fw fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('storeFlight') }}" class="row row-p-10">
                            {{ csrf_field() }}
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="build_string">String</label>
                                    <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string" value="10.0.">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="release">Date</label>
                                    <input type="date" class="form-control" id="release" name="release" aria-describedby="release" placeholder="Date" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="tweet" name="tweet" value="1" checked="checked"><label class="custom-control-label" for="tweet"> Tweet this</label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">PC</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f12" name="flight[1][2]" value="2"><label class="custom-control-label" for="f12"><span class="label fast">Dev</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f13" name="flight[1][3]" value="3"><label class="custom-control-label" for="f13"><span class="label slow">Beta</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f15" name="flight[1][5]" value="5"><label class="custom-control-label" for="f15"><span class="label release">Release Preview</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f16" name="flight[1][6]" value="6"><label class="custom-control-label" for="f16"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f17" name="flight[1][7]" value="7"><label class="custom-control-label" for="f17"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f18" name="flight[1][8]" value="8"><label class="custom-control-label" for="f18"><span class="label ltsc">LTSC</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Xbox</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f31" name="flight[3][1]" value="1"><label class="custom-control-label" for="f31"><span class="label skip">Skip Ahead</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f32" name="flight[3][2]" value="2"><label class="custom-control-label" for="f32"><span class="label fast">Alpha Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f33" name="flight[3][3]" value="3"><label class="custom-control-label" for="f33"><span class="label slow">Beta Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f34" name="flight[3][4]" value="4"><label class="custom-control-label" for="f34"><span class="label preview">Delta Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f35" name="flight[3][5]" value="5"><label class="custom-control-label" for="f35"><span class="label release">Omega Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f36" name="flight[3][6]" value="6"><label class="custom-control-label" for="f36"><span class="label targeted">Production</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Server</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f43" name="flight[4][3]" value="3"><label class="custom-control-label" for="f43"><span class="label slow">Preview</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f46" name="flight[4][6]" value="6"><label class="custom-control-label" for="f46"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f48" name="flight[4][8]" value="8"><label class="custom-control-label" for="f48"><span class="label ltsc">LTSC</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">10X</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f103" name="flight[10][3]" value="3"><label class="custom-control-label" for="f103"><span class="label slow">Preview</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Holographic</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f52" name="flight[5][2]" value="2"><label class="custom-control-label" for="f52"><span class="label fast">Fast Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f53" name="flight[5][3]" value="3"><label class="custom-control-label" for="f53"><span class="label slow">Slow Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f56" name="flight[5][6]" value="6"><label class="custom-control-label" for="f56"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f57" name="flight[5][7]" value="7"><label class="custom-control-label" for="f57"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f58" name="flight[5][8]" value="8"><label class="custom-control-label" for="f58"><span class="label ltsc">LTSC</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">IoT</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f63" name="flight[6][3]" value="3"><label class="custom-control-label" for="f63"><span class="label slow">Preview</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f66" name="flight[6][6]" value="6"><label class="custom-control-label" for="f66"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f67" name="flight[6][7]" value="7"><label class="custom-control-label" for="f67"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Team</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f72" name="flight[7][2]" value="2"><label class="custom-control-label" for="f72"><span class="label fast">Fast Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f73" name="flight[7][3]" value="3"><label class="custom-control-label" for="f73"><span class="label slow">Slow Ring</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f76" name="flight[7][6]" value="6"><label class="custom-control-label" for="f76"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f77" name="flight[7][7]" value="7"><label class="custom-control-label" for="f77"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">ISO</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f86" name="flight[8][6]" value="6"><label class="custom-control-label" for="f86"><span class="label targeted">Public</span></label></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">SDK</label>
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f96" name="flight[9][6]" value="6"><label class="custom-control-label" for="f96"><span class="label targeted">Public</span></label></label></div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block mt-3"><i class="far fa-fw fa-plus"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth
@endsection
