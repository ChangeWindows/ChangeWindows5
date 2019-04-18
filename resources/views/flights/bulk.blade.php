@extends('layouts.app')
@section('title') Flights @endsection

@php
    $previous = null;
@endphp

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>New flights</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
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
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">PC</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f11" name="flight[1][1]" value="1"><label class="custom-control-label" for="f11"><span class="label skip">Skip Ahead</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f12" name="flight[1][2]" value="2"><label class="custom-control-label" for="f12"><span class="label fast">Fast</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f13" name="flight[1][3]" value="3"><label class="custom-control-label" for="f13"><span class="label slow">Slow</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f15" name="flight[1][5]" value="5"><label class="custom-control-label" for="f15"><span class="label release">Release Preview</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f16" name="flight[1][6]" value="6"><label class="custom-control-label" for="f16"><span class="label targeted">Targeted</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f17" name="flight[1][7]" value="7"><label class="custom-control-label" for="f17"><span class="label broad">Broad</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f18" name="flight[1][8]" value="8"><label class="custom-control-label" for="f18"><span class="label ltsc">LTSC</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">Mobile</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f22" name="flight[2][2]" value="2"><label class="custom-control-label" for="f22"><span class="label fast">Fast</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f23" name="flight[2][3]" value="3"><label class="custom-control-label" for="f23"><span class="label slow">Slow</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f25" name="flight[2][5]" value="5"><label class="custom-control-label" for="f25"><span class="label release">Release Preview</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f26" name="flight[2][6]" value="6"><label class="custom-control-label" for="f26"><span class="label targeted">Targeted</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f27" name="flight[2][7]" value="7"><label class="custom-control-label" for="f27"><span class="label broad">Broad</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">Xbox</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f31" name="flight[3][1]" value="1"><label class="custom-control-label" for="f31"><span class="label skip">Skip Ahead</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f32" name="flight[3][2]" value="2"><label class="custom-control-label" for="f32"><span class="label fast">Alpha</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f33" name="flight[3][3]" value="3"><label class="custom-control-label" for="f33"><span class="label slow">Beta</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f34" name="flight[3][4]" value="4"><label class="custom-control-label" for="f34"><span class="label preview">Delta</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f35" name="flight[3][5]" value="5"><label class="custom-control-label" for="f35"><span class="label release">Omega</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f36" name="flight[3][6]" value="6"><label class="custom-control-label" for="f36"><span class="label targeted">Production</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">Server</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f43" name="flight[4][3]" value="3"><label class="custom-control-label" for="f43"><span class="label slow">Preview</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f46" name="flight[4][6]" value="6"><label class="custom-control-label" for="f46"><span class="label targeted">Targeted</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f47" name="flight[4][7]" value="7"><label class="custom-control-label" for="f47"><span class="label broad">Broad</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f48" name="flight[4][8]" value="8"><label class="custom-control-label" for="f48"><span class="label ltsc">LTSC</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">Holographic</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f52" name="flight[5][2]" value="2"><label class="custom-control-label" for="f52"><span class="label fast">Fast</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f53" name="flight[5][3]" value="3"><label class="custom-control-label" for="f53"><span class="label slow">Slow</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f56" name="flight[5][6]" value="6"><label class="custom-control-label" for="f56"><span class="label targeted">Targeted</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f57" name="flight[5][7]" value="7"><label class="custom-control-label" for="f57"><span class="label broad">Broad</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f58" name="flight[5][8]" value="8"><label class="custom-control-label" for="f58"><span class="label ltsc">LTSC</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">IoT</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f63" name="flight[6][3]" value="3"><label class="custom-control-label" for="f63"><span class="label slow">Preview</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f66" name="flight[6][6]" value="6"><label class="custom-control-label" for="f66"><span class="label targeted">Targeted</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f67" name="flight[6][7]" value="7"><label class="custom-control-label" for="f67"><span class="label broad">Broad</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">Team</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f76" name="flight[7][6]" value="6"><label class="custom-control-label" for="f76"><span class="label targeted">Targeted</span></label></label></div>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f77" name="flight[7][7]" value="7"><label class="custom-control-label" for="f77"><span class="label broad">Broad</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">ISO</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f86" name="flight[8][6]" value="6"><label class="custom-control-label" for="f86"><span class="label targeted">Targeted</span></label></label></div>
            </div>
            <div class="col-lg-3 col-sm-4 col-6">
                <label for="ring" class="control-label">SDK</label>
                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="f96" name="flight[9][6]" value="6"><label class="custom-control-label" for="f96"><span class="label targeted">Targeted</span></label></label></div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block  mt-3"><i class="fal fa-fw fa-plus"></i> Add</button>
            </div>
        </form>
    </div>
</div>
@endsection