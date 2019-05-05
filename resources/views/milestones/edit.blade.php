@extends('layouts.app')
@section('title') {{ $milestone->codename }} &middot; Milestones @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>
            Milestones
        </h2>
    </div>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('updateMilestone', $milestone->id) }}" class="row">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" id="id" name="id" aria-describedby="id" placeholder="ID" value="{{ $milestone->id }}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group">
            <label for="osname">OS name</label>
            <input type="text" class="form-control" id="osname" name="osname" aria-describedby="osname" placeholder="OS name" value="{{ $milestone->osname }}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group">
            <label for="version">Version</label>
            <input type="text" class="form-control" id="version" name="version" aria-describedby="version" placeholder="Version" value="{{ $milestone->version }}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group">
            <label for="codename">Codename</label>
            <input type="text" class="form-control" id="codename" name="codename" aria-describedby="codename" placeholder="Codename" value="{{ $milestone->codename }}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Name" value="{{ $milestone->name }}">
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-12">
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color" aria-describedby="color" placeholder="Color" value="{{ $milestone->color }}">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" aria-describedby="description" placeholder="Description">{{ $milestone->description }}</textarea>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-12">
        <div class="form-group">
            <label for="preview">Preview</label>
            <input type="date" class="form-control" id="preview" name="preview" aria-describedby="preview" placeholder="Preview" value="{{ $milestone->preview->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="public">Public</label>
            <input type="date" class="form-control" id="public" name="public" aria-describedby="public" placeholder="Public" value="{{ $milestone->public->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="mainEol">Main end</label>
            <input type="date" class="form-control" id="mainEol" name="mainEol" aria-describedby="mainEol" placeholder="Main end" value="{{ $milestone->mainEol->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="mainXol">Extended end</label>
            <input type="date" class="form-control" id="mainXol" name="mainXol" aria-describedby="mainXol" placeholder="Extended end" value="{{ $milestone->mainXol->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="ltsEol">LTSC end</label>
            <input type="date" class="form-control" id="ltsEol" name="ltsEol" aria-describedby="ltsEol" placeholder="LTSC end" value="{{ $milestone->ltsEol->format('Y-m-d') }}">
        </div>
    </div>
    <div class="col-lg-9 col-md-8 col-12">
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"><img src="{{ asset('img/platform/pc.svg') }}" height="32px" width="32px" alt="PC" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/mobile.svg') }}" height="32px" width="32px" alt="Mobile" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/xbox.svg') }}" height="32px" width="32px" alt="Xbox" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/server.svg') }}" height="32px" width="32px" alt="Server" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/holographic.svg') }}" height="32px" width="32px" alt="Holographic" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/iot.svg') }}" height="32px" width="32px" alt="IoT" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/team.svg') }}" height="32px" width="32px" alt="Team" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/iso.svg') }}" height="32px" width="32px" alt="ISO" /></th>
                    <th scope="col"><img src="{{ asset('img/platform/sdk.svg') }}" height="32px" width="32px" alt="SDK" /></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="text-right"><span class="label skip">Skip Ahead</span></th>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="pcSkip" name="pcSkip" {{ $milestone->pcSkip == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="pcSkip"></label>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="xboxSkip" name="xboxSkip" {{ $milestone->xboxSkip == '1' ? 'checked' : '' }} value="1">
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
                            <input type="checkbox" class="custom-control-input" id="pcFast" name="pcFast" {{ $milestone->pcFast == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="pcFast"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="mobileFast" name="mobileFast" {{ $milestone->mobileFast == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="mobileFast"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="xboxFast" name="xboxFast" {{ $milestone->xboxFast == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="xboxFast"></label>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="holographicFast" name="holographicFast" {{ $milestone->holographicFast == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="holographicFast"></label>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="teamFast" name="teamFast" {{ $milestone->teamFast == '1' ? 'checked' : '' }} value="1">
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
                            <input type="checkbox" class="custom-control-input" id="pcSlow" name="pcSlow" {{ $milestone->pcSlow == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="pcSlow"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="mobileSlow" name="mobileSlow" {{ $milestone->mobileSlow == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="mobileSlow"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="xboxSlow" name="xboxSlow" {{ $milestone->xboxSlow == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="xboxSlow"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="serverSlow" name="serverSlow" {{ $milestone->serverSlow == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="serverSlow"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="holographicSlow" name="holographicSlow" {{ $milestone->holographicSlow == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="holographicSlow"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="iotSlow" name="iotSlow" {{ $milestone->iotSlow == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="iotSlow"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="teamSlow" name="teamSlow" {{ $milestone->teamSlow == '1' ? 'checked' : '' }} value="1">
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
                            <input type="checkbox" class="custom-control-input" id="xboxPreview" name="xboxPreview" {{ $milestone->xboxPreview == '1' ? 'checked' : '' }} value="1">
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
                            <input type="checkbox" class="custom-control-input" id="pcReleasePreview" name="pcReleasePreview" {{ $milestone->pcReleasePreview == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="pcReleasePreview"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="mobileReleasePreview" name="mobileReleasePreview" {{ $milestone->mobileReleasePreview == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="mobileReleasePreview"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="xboxReleasePreview" name="xboxReleasePreview" {{ $milestone->xboxReleasePreview == '1' ? 'checked' : '' }} value="1">
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
                    <th scope="row" class="text-right"><span class="label targeted">Targeted</span></th>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="pcTargeted" name="pcTargeted" {{ $milestone->pcTargeted == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="pcTargeted"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="mobileTargeted" name="mobileTargeted" {{ $milestone->mobileTargeted == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="mobileTargeted"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="xboxTargeted" name="xboxTargeted" {{ $milestone->xboxTargeted == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="xboxTargeted"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="serverTargeted" name="serverTargeted" {{ $milestone->serverTargeted == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="serverTargeted"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="holographicTargeted" name="holographicTargeted" {{ $milestone->holographicTargeted == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="holographicTargeted"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="iotTargeted" name="iotTargeted" {{ $milestone->iotTargeted == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="iotTargeted"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="teamTargeted" name="teamTargeted" {{ $milestone->teamTargeted == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="teamTargeted"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="iso" name="iso" {{ $milestone->iso == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="iso"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sdk" name="sdk" {{ $milestone->sdk == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="sdk"></label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-right"><span class="label broad">Broad</span></th>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="pcBroad" name="pcBroad" {{ $milestone->pcBroad == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="pcBroad"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="mobileBroad" name="mobileBroad" {{ $milestone->mobileBroad == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="mobileBroad"></label>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="holographicBroad" name="holographicBroad" {{ $milestone->holographicBroad == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="holographicBroad"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="iotBroad" name="iotBroad" {{ $milestone->iotBroad == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="iotBroad"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="teamBroad" name="teamBroad" {{ $milestone->teamBroad == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="teamBroad"></label>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row" class="text-right"><span class="label ltsc">LTSC</span></th>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="pcLTS" name="pcLTS" {{ $milestone->pcLTS == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="pcLTS"></label>
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="serverLTS" name="serverLTS" {{ $milestone->serverLTS == '1' ? 'checked' : '' }} value="1">
                            <label class="custom-control-label" for="serverLTS"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="holographicLTS" name="holographicLTS" {{ $milestone->holographicLTS == '1' ? 'checked' : '' }} value="1">
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
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fal fa-fw fa-save"></i> Save</button>
    </div>
</form>
@endsection