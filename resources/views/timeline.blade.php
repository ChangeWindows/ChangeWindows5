@extends('layouts.app')

@section('hero')
<a class="hero" href="{{ route('viv') }}">
    <span class="text">
        <span class="h2">viv Preview</span>
        <span class="h5">The ChangeWindows 5 Preview is here, let us walk you through it</span>
    </span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="timeline">
            @foreach ($releases as $release)
                <div class="timeline-row">
                    <a class="row" href="#">
                        <div class="col-6 col-md-4 build"><img src="{{ asset('img/platform/'.$release->platform_img) }}" class="img-platform img-jump" alt="{{ $release->device }}" />{{ $release->build }}.{{ $release->delta }}</div>
                        <div class="col-6 col-md-8 ring"><span class="label {{ $release->class }}">{{ $release->flight }}</span></div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-5">
        @auth
            @if (Auth::user()->hasAnyRole(['Admin']))
                <p class="h3">Tools</p>
                <a class="btn btn-primary" href="#newBuildModal" data-toggle="modal" data-target="#newBuildModal"><i class="fal fa-fw fa-plus"></i> New build</a>
            @endif
        @endauth
        @foreach ($flights as $key => $platform)
            <p class="h3">{{ $key }}</p>
            <div class="row min-gutter">
                @foreach ($platform as $flight)
                    <div class="col-4">
                        <div class="tile {{ $flight->class }}">
                            <span class="ring">{{ $flight->flight }}</span>
                            <span class="build">{{ $flight->build }}.{{ $flight->delta }}</span>
                            <span class="date">{{ $flight->format }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

{{ $releases->links() }}
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
                                <div class="checkbox"><label><input type="checkbox" name="flight[4][6]" value="7"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
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