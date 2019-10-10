@extends('layouts.app')
@section('title') Milestones @endsection

@section('toolset')
<a class="dropdown-item" href="#newMilestoneModal" data-toggle="modal" data-target="#newMilestoneModal"><i class="fad text-primary fa-fw fa-plus"></i> New milestone</a>
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
                    <a class="milestone" href="{{ route('showMilestone', ['id' => $milestone->id]) }}" style="background: #{{ $milestone->color }}">
                        <h4 class="text-center">
                            <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $milestone->osname }}</span>
                        </h4>
                        <h3 class="text-center font-weight-normal">
                            version {{ $milestone->version }}
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
                            <span aria-hidden="true"><i class="fad fa-fw fa-times"></i></span>
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
                                                <input type="checkbox" class="custom-control-input" id="pcSkip" name="pcSkip" value="1">
                                                <label class="custom-control-label" for="pcSkip"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="xboxSkip" name="xboxSkip" value="1">
                                                <label class="custom-control-label" for="xboxSkip"></label>
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
                                                <input type="checkbox" class="custom-control-input" id="pcFast" name="pcFast" value="1">
                                                <label class="custom-control-label" for="pcFast"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mobileFast" name="mobileFast" value="1">
                                                <label class="custom-control-label" for="mobileFast"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="xboxFast" name="xboxFast" value="1">
                                                <label class="custom-control-label" for="xboxFast"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="holographicFast" name="holographicFast" value="1">
                                                <label class="custom-control-label" for="holographicFast"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="teamFast" name="teamFast" value="1">
                                                <label class="custom-control-label" for="teamFast"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-right"><span class="label slow">Slow</span></th>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="pcSlow" name="pcSlow" value="1">
                                                <label class="custom-control-label" for="pcSlow"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mobileSlow" name="mobileSlow" value="1">
                                                <label class="custom-control-label" for="mobileSlow"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="xboxSlow" name="xboxSlow" value="1">
                                                <label class="custom-control-label" for="xboxSlow"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="serverSlow" name="serverSlow" value="1">
                                                <label class="custom-control-label" for="serverSlow"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="holographicSlow" name="holographicSlow" value="1">
                                                <label class="custom-control-label" for="holographicSlow"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="iotSlow" name="iotSlow" value="1">
                                                <label class="custom-control-label" for="iotSlow"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="teamSlow" name="teamSlow" value="1">
                                                <label class="custom-control-label" for="teamSlow"></label>
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
                                                <input type="checkbox" class="custom-control-input" id="xboxPreview" name="xboxPreview" value="1">
                                                <label class="custom-control-label" for="xboxPreview"></label>
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
                                                <input type="checkbox" class="custom-control-input" id="pcReleasePreview" name="pcReleasePreview" value="1">
                                                <label class="custom-control-label" for="pcReleasePreview"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mobileReleasePreview" name="mobileReleasePreview" value="1">
                                                <label class="custom-control-label" for="mobileReleasePreview"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="xboxReleasePreview" name="xboxReleasePreview" value="1">
                                                <label class="custom-control-label" for="xboxReleasePreview"></label>
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
                                        <th scope="row" class="text-right"><span class="label targeted">Production</span></th>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="pcTargeted" name="pcTargeted" value="1">
                                                <label class="custom-control-label" for="pcTargeted"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="mobileTargeted" name="mobileTargeted" value="1">
                                                <label class="custom-control-label" for="mobileTargeted"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="xboxTargeted" name="xboxTargeted" value="1">
                                                <label class="custom-control-label" for="xboxTargeted"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="serverTargeted" name="serverTargeted" value="1">
                                                <label class="custom-control-label" for="serverTargeted"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="holographicTargeted" name="holographicTargeted" value="1">
                                                <label class="custom-control-label" for="holographicTargeted"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="iotTargeted" name="iotTargeted" value="1">
                                                <label class="custom-control-label" for="iotTargeted"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="teamTargeted" name="teamTargeted" value="1">
                                                <label class="custom-control-label" for="teamTargeted"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="iso" name="iso" value="1">
                                                <label class="custom-control-label" for="iso"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="sdk" name="sdk" value="1">
                                                <label class="custom-control-label" for="sdk"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-right"><span class="label ltsc">LTSC</span></th>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="pcLTS" name="pcLTS" value="1">
                                                <label class="custom-control-label" for="pcLTS"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="serverLTS" name="serverLTS" value="1">
                                                <label class="custom-control-label" for="serverLTS"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="holographicLTS" name="holographicLTS" value="1">
                                                <label class="custom-control-label" for="holographicLTS"></label>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fad fa-fw fa-plus"></i> Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endauth
@endsection
