@extends('layouts.app')

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
                                <label for="ring" class="control-label extra-margin">PC</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][1]" value="1"> <span class="label skip">Skip Ahead</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][2]" value="2"> <span class="label fast">Fast Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][3]" value="3"> <span class="label slow">Slow Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][5]" value="5"> <span class="label release">Release Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[1][8]" value="8"> <span class="label ltsc">LTSC</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Mobile</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][2]" value="2"> <span class="label fast">Fast Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][3]" value="3"> <span class="label slow">Slow Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][5]" value="5"> <span class="label release">Release Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[2][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Xbox</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][1]" value="1"> <span class="label skip">Skip Ahead</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][2]" value="2"> <span class="label fast">Alpha Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][3]" value="3"> <span class="label slow">Beta Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][5]" value="4"> <span class="label preview">Delta Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][4]" value="5"> <span class="label release">Omega Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[3][6]" value="6"> <span class="label targeted">Production</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Server</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][3]" value="3"> <span class="label slow">Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][8]" value="8"> <span class="label ltsc">LTSC</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Holographic</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][2]" value="2"> <span class="label fast">Fast Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][3]" value="3"> <span class="label slow">Slow Ring</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[5][8]" value="8"> <span class="label ltsc">LTSC</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">IoT</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[6][3]" value="3"> <span class="label slow">Preview</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[6][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[6][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">Team</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[7][6]" value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
                                <div class="checkbox"><label><input type="checkbox" name="flight[7][7]" value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">ISO</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[8][6]" value="6"> <span class="label targeted">Public</span></label></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label extra-margin">SDK</label>
                                <div class="checkbox"><label><input type="checkbox" name="flight[9][6]" value="6"> <span class="label targeted">Public</span></label></div>
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