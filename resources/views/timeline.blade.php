@extends('layouts.app')

@php
    $previous = null;
@endphp

@section('hero')
<div class="jumbotron bg-dark">
    <div class="container">
        <a class="hero" href="{{ route('viv') }}">
            <span class="text">
                <span class="h2">viv Preview</span>
                <span class="h5">The ChangeWindows 5 Preview is here</span>
            </span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row px-n10">
    <div class="col-lg-7">
        <div class="timeline">
            @foreach ($timeline as $date => $builds)
                <div class="date-heading">{{ $date }}</div>
                <div></div>
                @foreach ($builds as $build => $deltas)
                    @foreach ($deltas as $delta => $platforms)
                        @foreach ($platforms as $platform => $rings)
                            <div class="timeline-row">
                                <a class="row" href="{{ URL::to('build/'.$build.'/'.$platform) }}">
                                    <div class="col-6 col-md-4 build"><img src="{{ asset('img/platform/'.getPlatformImage($platform)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform) }}" />{{ $build }}.{{ $delta }}</div>
                                    <div class="col-6 col-md-8 ring">
                                        @foreach ($rings as $ring)
                                            <span class="label {{ $ring->class }}">{{ $ring->flight }}</span>
                                        @endforeach
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </div>
        {{ $releases->links() }}
    </div>
    <div class="col-lg-5">
        @auth
            @if (Auth::user()->hasAnyRole(['Admin']))
                <p class="h3">Admin tools</p>
                <a class="btn btn-primary" href="#newBuildModal" data-toggle="modal" data-target="#newBuildModal"><i class="fal fa-fw fa-plus"></i> New build</a>
            @endif
        @endauth
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Desktop</p>
        <div class="row row-gutter">
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['desktop']['skip'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['desktop']['active'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['desktop']['slow'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-md-3 col-sm-6 col-6"><?php getTile( $flights['desktop']['release'] ) ?></div>
            <div class="col-xl-4 col-lg-12 col-md-4 col-sm-4 col-12"><?php getTile( $flights['desktop']['target'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-4 col-6"><?php getTile( $flights['desktop']['broad'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-4 col-6"><?php getTile( $flights['desktop']['ltsc'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-xbox"></i> Xbox</p>
        <div class="row row-gutter">
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['skip'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['active'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['slow'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['preview'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['release'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['xbox']['target'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> IoT</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['iot']['slow'] ) ?></div>
            <div class="col"><?php getTile( $flights['iot']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['iot']['broad'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Server</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['server']['slow'] ) ?></div>
            <div class="col"><?php getTile( $flights['server']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['server']['ltsc'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Holographic</p>
        <div class="row row-gutter">
            <div class="col-xl-6 col-lg-6 col-sm-6 col-6"><?php getTile( $flights['holo']['active'] ) ?></div>
            <div class="col-xl-6 col-lg-6 col-sm-6 col-6"><?php getTile( $flights['holo']['slow'] ) ?></div>
            <div class="col-xl-4 col-lg-12 col-sm-4 col-12"><?php getTile( $flights['holo']['target'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['holo']['broad'] ) ?></div>
            <div class="col-xl-4 col-lg-6 col-sm-4 col-6"><?php getTile( $flights['holo']['ltsc'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Team</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['team']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['team']['broad'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> Mobile</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['mobile']['target'] ) ?></div>
            <div class="col"><?php getTile( $flights['mobile']['broad'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> SDK</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['sdk']['target'] ) ?></div>
        </div>
        <p class="h3"><i class="fab fa-fw fa-windows"></i> ISO</p>
        <div class="row row-gutter">
            <div class="col"><?php getTile( $flights['iso']['target'] ) ?></div>
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
                            <span aria-hidden="true"><i class="fal fa-fw fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('storeRelease') }}" class="row row-p-10">
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
                                    <input type="date" class="form-control" id="release" name="release" aria-describedby="release" placeholder="Date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Desktop</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][0]" value="0"> <span class="label leak">vNext</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][1]" value="1"> <span class="label skip">Skip Ahead</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][2]" value="2"> <span class="label fast">Fast Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][3]" value="3"> <span class="label slow">Slow Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][5]" value="5"> <span class="label release">Release Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][8]" value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Mobile</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][0]" value="0"> <span class="label leak">vNext</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][2]" value="2"> <span class="label fast">Fast Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][3]" value="3"> <span class="label slow">Slow Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][5]" value="5"> <span class="label release">Release Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Xbox</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][0]" value="0"> <span class="label leak">vNext</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][1]" value="1"> <span class="label skip">Alpha Skip Ahead Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][2]" value="2"> <span class="label fast">Alpha Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][3]" value="3"> <span class="label slow">Beta Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][5]" value="4"> <span class="label preview">Delta Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][4]" value="5"> <span class="label release">Omega Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][6]" value="6"> <span class="label targeted">Production</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Server</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][0]" value="0"> <span class="label leak">vNext</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][3]" value="3"> <span class="label slow">Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][8]" value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Mixed Reality</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][0]" value="0"> <span class="label leak">vNext</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][8]" value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">IoT</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[6][0]" value="0"> <span class="label leak">vNext</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[6][3]" value="3"> <span class="label slow">Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[6][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[6][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Team</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[7][0]" value="0"> <span class="label leak">vNext</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[7][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[7][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-plus"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth
@endsection