@extends('core.layouts.app')
@section('title') Flights @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Flights</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
        <li class="breadcrumb-item active">Flights</li>
    </ol>
</div>
<div class="content-box">
    <div class="row">
        @if (session('status'))
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="mr-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        @endif
        <div class="col-12">
            @can('create_flight')
                <form method="POST" class="card border-0 shadow p-3" action="{{ route('admin.flights.store') }}">
                    {{ csrf_field() }}
                    <h3 class="h6">
                        New flight
                        <button type="submit" class="btn btn-primary float-right btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="build_string">String</label>
                            <input type="text" class="form-control @error('build_string') is-invalid @enderror" name="build_string" id="build_string" value="{{ old('build_string', '10.0.') }}" required placeholder="String">
                            @error('build_string')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required placeholder="Date">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="tweet">Tweet this</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="tweet" name="tweet" value="1" checked="checked"><label class="form-check-label" for="tweet"> Send a tweet on <a href="https://twitter.com/changewindows">@ChangeWindows</a></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">PC</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f12" name="flight[1][2]" value="2"><label class="form-check-label" for="f12"><span class="label fast">Dev</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f13" name="flight[1][3]" value="3"><label class="form-check-label" for="f13"><span class="label slow">Beta</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f15" name="flight[1][5]" value="5"><label class="form-check-label" for="f15"><span class="label release">Release Preview</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f16" name="flight[1][6]" value="6"><label class="form-check-label" for="f16"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f17" name="flight[1][7]" value="7"><label class="form-check-label" for="f17"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f18" name="flight[1][8]" value="8"><label class="form-check-label" for="f18"><span class="label ltsc">LTSC</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Xbox</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f31" name="flight[3][1]" value="1"><label class="form-check-label" for="f31"><span class="label skip">Skip Ahead</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f32" name="flight[3][2]" value="2"><label class="form-check-label" for="f32"><span class="label fast">Alpha Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f33" name="flight[3][3]" value="3"><label class="form-check-label" for="f33"><span class="label slow">Beta Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f34" name="flight[3][4]" value="4"><label class="form-check-label" for="f34"><span class="label preview">Delta Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f35" name="flight[3][5]" value="5"><label class="form-check-label" for="f35"><span class="label release">Omega Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f36" name="flight[3][6]" value="6"><label class="form-check-label" for="f36"><span class="label targeted">Production</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Server</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f43" name="flight[4][3]" value="3"><label class="form-check-label" for="f43"><span class="label slow">Preview</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f46" name="flight[4][6]" value="6"><label class="form-check-label" for="f46"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f48" name="flight[4][8]" value="8"><label class="form-check-label" for="f48"><span class="label ltsc">LTSC</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Holographic</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f52" name="flight[5][2]" value="2"><label class="form-check-label" for="f52"><span class="label fast">Fast Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f53" name="flight[5][3]" value="3"><label class="form-check-label" for="f53"><span class="label slow">Slow Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f56" name="flight[5][6]" value="6"><label class="form-check-label" for="f56"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f57" name="flight[5][7]" value="7"><label class="form-check-label" for="f57"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f58" name="flight[5][8]" value="8"><label class="form-check-label" for="f58"><span class="label ltsc">LTSC</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">IoT</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f63" name="flight[6][3]" value="3"><label class="form-check-label" for="f63"><span class="label slow">Preview</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f66" name="flight[6][6]" value="6"><label class="form-check-label" for="f66"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f67" name="flight[6][7]" value="7"><label class="form-check-label" for="f67"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Team</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f72" name="flight[7][2]" value="2"><label class="form-check-label" for="f72"><span class="label fast">Fast Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f73" name="flight[7][3]" value="3"><label class="form-check-label" for="f73"><span class="label slow">Slow Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f76" name="flight[7][6]" value="6"><label class="form-check-label" for="f76"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f77" name="flight[7][7]" value="7"><label class="form-check-label" for="f77"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">10X</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f103" name="flight[10][3]" value="3"><label class="form-check-label" for="f103"><span class="label slow">Preview</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">ISO</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f86" name="flight[8][6]" value="6"><label class="form-check-label" for="f86"><span class="label targeted">Public</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">SDK</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="f96" name="flight[9][6]" value="6"><label class="form-check-label" for="f96"><span class="label targeted">Public</span></label></label></div>
                        </div>
                    </div>
                </form>
            @endcan
        </div>
        <div class="col-12">
            <h3 class="h5 title">Flights</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($timeline as $date => $builds)
                    <div class="col-12 h6 text-primary mb-3">{{ $date }}</div>
                    @foreach ($builds as $build => $deltas)
                        @foreach ($deltas as $delta => $platforms)
                            @foreach ($platforms as $platform => $rings)
                                @foreach ($rings as $ring)
                                    @include('core.search._flight', ['platform' => $platform, 'ring' => $ring, 'build' => $build, 'delta' => $delta])
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @empty
                    <div class="col-12 text-center my-5">
                        <h6>No flight available...</h6>
                        <p>Create one to get started</p>
                    </div>
                @endforelse
            </div>
        </div>
        @if ($releases->hasPages())
            <div class="col-12 d-flex flex-row justify-content-center">
                {{ $releases->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
