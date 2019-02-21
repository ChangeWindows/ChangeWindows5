@extends('layouts.app')
@section('title') Milestones @endsection

@section('toolset')
<a class="dropdown-item" href="#newMilestoneModal" data-toggle="modal" data-target="#newMilestoneModal"><i class="fal fa-fw fa-plus"></i> New milestone</a>
<div class="dropdown-divider"></div>
@endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Milestones</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="row">
            @foreach ($milestones as $milestone)
                <div class="col-lg-4 col-md-6 col-12">
                    <a class="milestone" href="{{ route('showMilestone', ['id' => $milestone->id]) }}">
                        <h4 class="text-center" style="color: #{{ $milestone->color }}">
                            <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $milestone->osname }}</span>
                        </h4>
                        <h3 class="text-center" style="color: #{{ $milestone->color }}">
                            {{ $milestone->name }}
                        </h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('modals')
@auth
    @if (Auth::user()->hasAnyRole(['Admin']))
        <div class="modal fade" id="newMilestoneModal" tabindex="-1" role="dialog" aria-labelledby="newMilestoneModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New build</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-fw fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('storeMilestone') }}" class="row row-p-10">
                            {{ csrf_field() }}
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id" aria-describedby="id" placeholder="ID">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="osname">OS name</label>
                                    <input type="text" class="form-control" id="osname" name="osname" aria-describedby="osname" placeholder="OS name">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="codename">Codename</label>
                                    <input type="text" class="form-control" id="codename" name="codename" aria-describedby="codename" placeholder="Codename">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="version">Version</label>
                                    <input type="text" class="form-control" id="version" name="version" aria-describedby="version" placeholder="Version">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input type="text" class="form-control" id="color" name="color" aria-describedby="color" placeholder="Color">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" aria-describedby="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="col-12"><hr /></div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="preview">Preview</label>
                                    <input type="date" class="form-control" id="preview" name="preview" aria-describedby="preview" placeholder="Preview">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="public">Public</label>
                                    <input type="date" class="form-control" id="public" name="public" aria-describedby="public" placeholder="Public">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="mainEol">Main end</label>
                                    <input type="date" class="form-control" id="mainEol" name="mainEol" aria-describedby="mainEol" placeholder="Main end">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="mainXol">Extended end</label>
                                    <input type="date" class="form-control" id="mainXol" name="mainXol" aria-describedby="mainXol" placeholder="Extended end">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="ltsEol">LTSC end</label>
                                    <input type="date" class="form-control" id="ltsEol" name="ltsEol" aria-describedby="ltsEol" placeholder="LTSC end">
                                </div>
                            </div>
                            <div class="col-12"><hr /></div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">PC</label>
                                <div class="checkbox"><input type="checkbox" name="pcSkip" value="1"> <span class="label skip">Skip Ahead</span></div>
                                <div class="checkbox"><input type="checkbox" name="pcFast" value="2"> <span class="label fast">Fast Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="pcSlow" value="3"> <span class="label slow">Slow Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="pcReleasePreview" value="5"> <span class="label release">Release Preview</span></div>
                                <div class="checkbox"><input type="checkbox" name="pcTargeted" value="6"> <span class="label targeted">Semi-Annual Targeted</span></div>
                                <div class="checkbox"><input type="checkbox" name="pcBroad" value="7"> <span class="label broad">Semi-Annual Broad</span></div>
                                <div class="checkbox"><input type="checkbox" name="pcLTS" value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Mobile</label>
                                <div class="checkbox"><input type="checkbox" name="mobileFast" value="2"> <span class="label fast">Fast Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="mobileSlow" value="3"> <span class="label slow">Slow Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="mobileReleasePreview" value="5"> <span class="label release">Release Preview</span></div>
                                <div class="checkbox"><input type="checkbox" name="mobileTargeted" value="6"> <span class="label targeted">Semi-Annual Targeted</span></div>
                                <div class="checkbox"><input type="checkbox" name="mobileBroad" value="7"> <span class="label broad">Semi-Annual Broad</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Xbox</label>
                                <div class="checkbox"><input type="checkbox" name="xboxSkip" value="1"> <span class="label skip">Alpha Skip Ahead Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="xboxFast" value="2"> <span class="label fast">Alpha Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="xboxSlow" value="3"> <span class="label slow">Beta Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="xboxPreview" value="4"> <span class="label preview">Delta Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="xboxReleasePreview" value="5"> <span class="label release">Omega Ring</span></div>
                                <div class="checkbox"><input type="checkbox" name="xboxTargeted" value="6"> <span class="label targeted">Production</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Server</label>
                                <div class="checkbox"><input type="checkbox" name="serverSlow" value="3"> <span class="label slow">Preview</span></div>
                                <div class="checkbox"><input type="checkbox" name="serverTargeted" value="6"> <span class="label targeted">Semi-Annual Targeted</span></div>
                                <div class="checkbox"><input type="checkbox" name="serverBroad" value="7"> <span class="label broad">Semi-Annual Broad</span></div>
                                <div class="checkbox"><input type="checkbox" name="serverLTS" value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Holographic</label>
                                <div class="checkbox"><input type="checkbox" name="holographicTargeted" value="6"> <span class="label targeted">Semi-Annual Targeted</span></div>
                                <div class="checkbox"><input type="checkbox" name="holographicBroad" value="7"> <span class="label broad">Semi-Annual Broad</span></div>
                                <div class="checkbox"><input type="checkbox" name="holographicLTS" value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">IoT</label>
                                <div class="checkbox"><input type="checkbox" name="iotSlow" value="3"> <span class="label slow">Preview</span></div>
                                <div class="checkbox"><input type="checkbox" name="iotTargeted" value="6"> <span class="label targeted">Semi-Annual Targeted</span></div>
                                <div class="checkbox"><input type="checkbox" name="iotBroad" value="7"> <span class="label broad">Semi-Annual Broad</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">Team</label>
                                <div class="checkbox"><input type="checkbox" name="teamTargeted" value="6"> <span class="label targeted">Semi-Annual Targeted</span></div>
                                <div class="checkbox"><input type="checkbox" name="teamBroad" value="7"> <span class="label broad">Semi-Annual Broad</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">ISO</label>
                                <div class="checkbox"><input type="checkbox" name="iso" value="6"> <span class="label targeted">Public</span></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm">
                                <label for="ring" class="control-label">SDK</label>
                                <div class="checkbox"><input type="checkbox" name="sdk" value="6"> <span class="label targeted">Public</span></div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fal fa-fw fa-plus"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth
@endsection