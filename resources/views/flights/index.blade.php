@extends('layouts.app')
@section('title') Flights @endsection

@php
    $previous = null;
@endphp

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Flights</h2>
        <div class="btn-toolbar">
            <a class="btn btn-primary" href="#newBuildModal" data-toggle="modal" data-target="#newBuildModal"><i class="fal fa-fw fa-plus"></i> New flight</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="timeline">
            @foreach ($timeline as $date => $builds)
                <div class="date-heading">{{ $date }}</div>
                <div></div>
                <div class="row flight-row">
                    @foreach ($builds as $build => $deltas)
                        @foreach ($deltas as $delta => $platforms)
                            @foreach ($platforms as $platform => $rings)
                                @foreach ($rings as $ring)
                                    <div class="col-xl-2 col-md-3 col-sm-4 col-xs-6 flight-block">
                                        <div class="flight-set">
                                            <a class="flight" href="{{ route('showRelease', ['build' => $build, 'platform' => $platform]) }}">
                                                <div class="img"><img src="{{ asset('img/platform/'.getPlatformImage($platform)) }}" class="img-fluid" alt="{{ getPlatformById($platform) }}" /></div>
                                                <div class="data">
                                                    <p class="build">{{ $build }}.{{ $delta }}</p>
                                                    <p class="ring"><span class="label {{ $ring->class }}">{{ $ring->flight }}</span></p>
                                                </div>
                                            </a>
                                            <form method="POST" action="{{ route('destroyFlight', ['id' => $ring->id]) }}" class="d-inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-outline-danger"><i class="fal fa-fw fa-trash-alt"></i></button>
                                            </form>
                                            <a href="{{ route('editFlight', $ring->id) }}" class="btn btn-outline-primary"><i class="fal fa-fw fa-pencil"></i> Edit</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            @endforeach
        </div>
        {{ $releases->links() }}
    </div>
</div>
@endsection

@section('modals')
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
                    <div class="col-12">
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="tweet" name="tweet" value="1" checked="checked"><label class="custom-control-label" for="tweet"> Tweet this</label></label></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm">
                        <label for="ring" class="control-label">PC</label>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f11" name="flight[1][1]" value="1"><label class="custom-control-label" for="f11"><span class="label skip">Skip Ahead</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f12" name="flight[1][2]" value="2"><label class="custom-control-label" for="f12"><span class="label fast">Fast Ring</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f13" name="flight[1][3]" value="3"><label class="custom-control-label" for="f13"><span class="label slow">Slow Ring</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f15" name="flight[1][5]" value="5"><label class="custom-control-label" for="f15"><span class="label release">Release Preview Ring</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f16" name="flight[1][6]" value="6"><label class="custom-control-label" for="f16"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f17" name="flight[1][7]" value="7"><label class="custom-control-label" for="f17"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f18" name="flight[1][8]" value="8"><label class="custom-control-label" for="f18"><span class="label ltsc">LTSC</span></label></label></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm">
                        <label for="ring" class="control-label">Mobile</label>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f22" name="flight[2][2]" value="2"><label class="custom-control-label" for="f22"><span class="label fast">Fast Ring</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f23" name="flight[2][3]" value="3"><label class="custom-control-label" for="f23"><span class="label slow">Slow Ring</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f25" name="flight[2][5]" value="5"><label class="custom-control-label" for="f25"><span class="label release">Release Preview Ring</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f26" name="flight[2][6]" value="6"><label class="custom-control-label" for="f26"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f27" name="flight[2][7]" value="7"><label class="custom-control-label" for="f27"><span class="label broad">Semi-Annual Broad</span></label></label></div>
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
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f47" name="flight[4][7]" value="7"><label class="custom-control-label" for="f47"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f48" name="flight[4][8]" value="8"><label class="custom-control-label" for="f48"><span class="label ltsc">LTSC</span></label></label></div>
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
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f76" name="flight[7][6]" value="6"><label class="custom-control-label" for="f76"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f77" name="flight[7][7]" value="7"><label class="custom-control-label" for="f77"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm">
                        <label for="ring" class="control-label">ISO</label>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f86" name="flight[8][6]" value="6"><label class="custom-control-label" for="f86"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm">
                        <label for="ring" class="control-label">SDK</label>
                        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f96" name="flight[9][6]" value="6"><label class="custom-control-label" for="f96"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block  mt-3"><i class="fal fa-fw fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection