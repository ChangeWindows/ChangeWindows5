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
            <a class="btn btn-primary" href="#newBuildModal" data-toggle="modal" data-target="#newBuildModal"><i class="fad fa-fw fa-plus"></i> New flight</a>
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
                                            <a class="flight" href="{{ route('showBuild', ['milestone' => $ring->milestone, 'build' => $build, 'platform' => getPlatformClass($platform)]) }}#{{ $delta }}">
                                                <div class="img"><img src="{{ asset('img/platform/'.getPlatformImage($platform)) }}" class="img-fluid" alt="{{ getPlatformById($platform) }}" /></div>
                                                <div class="data">
                                                    <p class="build">{{ $build }}.{{ $delta }}</p>
                                                    <p class="ring"><span class="label {{ $ring->class }}">{{ $ring->flight }}</span></p>
                                                </div>
                                            </a>
                                            <div class="btn-toolbar justify-content-between" role="toolbar">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('editFlight', $ring->id) }}" class="btn btn-outline-primary"><i class="fad fa-fw fa-pencil"></i> Edit</a>
                                                </div>
                                                <div class="btn-group" role="group">
                                                    <form method="POST" action="{{ route('destroyFlight', ['id' => $ring->id]) }}" class="d-inline">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-outline-danger"><i class="fad fa-fw fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </div>
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
<form method="POST" action="{{ route('storeFlight') }}">
    {{ csrf_field() }}
    <div class="modal fade" id="newBuildModal" tabindex="-1" role="dialog" aria-labelledby="newBuildModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New flight</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fad fa-fw fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string" value="10.0.">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="date" class="form-control" id="release" name="release" aria-describedby="release" placeholder="Date" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fad fa-fw fa-plus"></i> Add</button>
                        </div>
                        <div class="col-12">
                            <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="tweet" name="tweet" value="1" checked="checked"><label class="custom-control-label" for="tweet"> Tweet this</label></label></div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"><img src="{{ asset('img/platform/pc.png') }}" height="32px" width="32px" alt="PC" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/mobile.png') }}" height="32px" width="32px" alt="Mobile" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/xbox.png') }}" height="32px" width="32px" alt="Xbox" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/server.png') }}" height="32px" width="32px" alt="Server" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/holographic.png') }}" height="32px" width="32px" alt="Holographic" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/iot.png') }}" height="32px" width="32px" alt="IoT" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/team.png') }}" height="32px" width="32px" alt="Team" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/iso.png') }}" height="32px" width="32px" alt="ISO" /></th>
                            <th scope="col"><img src="{{ asset('img/platform/sdk.png') }}" height="32px" width="32px" alt="SDK" /></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="text-right"><span class="label skip">Skip Ahead</span></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f11" name="flight[1][1]" value="1">
                                    <label class="custom-control-label" for="f11"></label>
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f31" name="flight[3][1]" value="1">
                                    <label class="custom-control-label" for="f31"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right"><span class="label fast">Fast</span></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f12" name="flight[1][2]" value="1">
                                    <label class="custom-control-label" for="f12"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f22" name="flight[2][2]" value="1">
                                    <label class="custom-control-label" for="f22"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f32" name="flight[3][2]" value="1">
                                    <label class="custom-control-label" for="f32"></label>
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f52" name="flight[5][2]" value="1">
                                    <label class="custom-control-label" for="f52"></label>
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f72" name="flight[7][2]" value="1">
                                    <label class="custom-control-label" for="f72"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right"><span class="label slow">Slow</span></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f13" name="flight[1][3]" value="1">
                                    <label class="custom-control-label" for="f13"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f23" name="flight[2][3]" value="1">
                                    <label class="custom-control-label" for="f23"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f33" name="flight[3][3]" value="1">
                                    <label class="custom-control-label" for="f33"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f43" name="flight[4][3]" value="1">
                                    <label class="custom-control-label" for="f43"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f53" name="flight[5][3]" value="1">
                                    <label class="custom-control-label" for="f53"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f63" name="flight[6][3]" value="1">
                                    <label class="custom-control-label" for="f63"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f73" name="flight[7][3]" value="1">
                                    <label class="custom-control-label" for="f73"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right"><span class="label preview">Preview</span></th>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f34" name="flight[3][4]" value="1">
                                    <label class="custom-control-label" for="f34"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right"><span class="label release">Release Preview</span></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f15" name="flight[1][5]" value="1">
                                    <label class="custom-control-label" for="f15"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f25" name="flight[2][5]" value="1">
                                    <label class="custom-control-label" for="f25"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f55" name="flight[5][5]" value="1">
                                    <label class="custom-control-label" for="f55"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right"><span class="label targeted">Targeted</span></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f16" name="flight[1][6]" value="1">
                                    <label class="custom-control-label" for="f16"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f26" name="flight[2][6]" value="1">
                                    <label class="custom-control-label" for="f26"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f36" name="flight[3][6]" value="1">
                                    <label class="custom-control-label" for="f36"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f46" name="flight[4][6]" value="1">
                                    <label class="custom-control-label" for="f46"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f56" name="flight[5][6]" value="1">
                                    <label class="custom-control-label" for="f56"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f66" name="flight[6][6]" value="1">
                                    <label class="custom-control-label" for="f66"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f76" name="flight[7][6]" value="1">
                                    <label class="custom-control-label" for="f76"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f86" name="flight[8][6]" value="1">
                                    <label class="custom-control-label" for="f86"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f96" name="flight[9][6]" value="1">
                                    <label class="custom-control-label" for="f96"></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right"><span class="label broad">Broad</span></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f17" name="flight[1][7]" value="1">
                                    <label class="custom-control-label" for="f17"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f27" name="flight[2][7]" value="1">
                                    <label class="custom-control-label" for="f27"></label>
                                </div>
                            </td>
                            <td></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f47" name="flight[4][7]" value="1">
                                    <label class="custom-control-label" for="f47"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f57" name="flight[5][7]" value="1">
                                    <label class="custom-control-label" for="f57"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f67" name="flight[6][7]" value="1">
                                    <label class="custom-control-label" for="f67"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f77" name="flight[7][7]" value="1">
                                    <label class="custom-control-label" for="f77"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-right"><span class="label ltsc">LTSC</span></th>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f18" name="flight[1][8]" value="1">
                                    <label class="custom-control-label" for="f18"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f48" name="flight[4][8]" value="1">
                                    <label class="custom-control-label" for="f48"></label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="f58" name="flight[5][8]" value="1">
                                    <label class="custom-control-label" for="f58"></label>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
@endsection
