@extends('layouts.app')

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
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="id">ID</label>
            <input type="text" class="form-control" id="id" name="id" aria-describedby="id" placeholder="ID" value="{{ $milestone->id }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="osname">OS name</label>
            <input type="text" class="form-control" id="osname" name="osname" aria-describedby="osname" placeholder="OS name" value="{{ $milestone->osname }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Name" value="{{ $milestone->name }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="codename">Codename</label>
            <input type="text" class="form-control" id="codename" name="codename" aria-describedby="codename" placeholder="Codename" value="{{ $milestone->codename }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="version">Version</label>
            <input type="text" class="form-control" id="version" name="version" aria-describedby="version" placeholder="Version" value="{{ $milestone->version }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
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
    <div class="col-12"><hr /></div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="preview">Preview</label>
            <input type="date" class="form-control" id="preview" name="preview" aria-describedby="preview" placeholder="Preview" value="{{ $milestone->preview->format('Y-m-d') }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="public">Public</label>
            <input type="date" class="form-control" id="public" name="public" aria-describedby="public" placeholder="Public" value="{{ $milestone->public->format('Y-m-d') }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="mainEol">Main end</label>
            <input type="date" class="form-control" id="mainEol" name="mainEol" aria-describedby="mainEol" placeholder="Main end" value="{{ $milestone->mainEol->format('Y-m-d') }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="mainXol">Extended end</label>
            <input type="date" class="form-control" id="mainXol" name="mainXol" aria-describedby="mainXol" placeholder="Extended end" value="{{ $milestone->mainXol->format('Y-m-d') }}">
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="form-group">
            <label for="ltsEol">LTSC end</label>
            <input type="date" class="form-control" id="ltsEol" name="ltsEol" aria-describedby="ltsEol" placeholder="LTSC end" value="{{ $milestone->ltsEol->format('Y-m-d') }}">
        </div>
    </div>
    <div class="col-12"><hr /></div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">PC</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="pcSkip" name="pcSkip" {{ $milestone->pcSkip == '1' ? 'checked' : '' }} value="1"><label class="custom-control-label" for="pcSkip"><span class="label skip">Skip Ahead</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="pcFast" name="pcFast" {{ $milestone->pcFast == '1' ? 'checked' : '' }} value="2"><label class="custom-control-label" for="pcFast"><span class="label fast">Fast Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="pcSlow" name="pcSlow" {{ $milestone->pcSlow == '1' ? 'checked' : '' }} value="3"><label class="custom-control-label" for="pcSlow"><span class="label slow">Slow Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="pcReleasePreview" name="pcReleasePreview" {{ $milestone->pcReleasePreview == '1' ? 'checked' : '' }} value="5"><label class="custom-control-label" for="pcReleasePreview"><span class="label release">Release Preview</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="pcTargeted" name="pcTargeted" {{ $milestone->pcTargeted == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="pcTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="pcBroad" name="pcBroad" {{ $milestone->pcBroad == '1' ? 'checked' : '' }} value="7"><label class="custom-control-label" for="pcBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="pcLTS" name="pcLTS" {{ $milestone->pcLTS == '1' ? 'checked' : '' }} value="8"><label class="custom-control-label" for="pcLTS"><span class="label ltsc">Long-Term Servicing Channel</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Mobile</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mobileFast" name="mobileFast" {{ $milestone->mobileFast == '1' ? 'checked' : '' }} value="2"><label class="custom-control-label" for="mobileFast"><span class="label fast">Fast Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mobileSlow" name="mobileSlow" {{ $milestone->mobileSlow == '1' ? 'checked' : '' }} value="3"><label class="custom-control-label" for="mobileSlow"><span class="label slow">Slow Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mobileReleasePreview" name="mobileReleasePreview" {{ $milestone->mobileReleasePreview == '1' ? 'checked' : '' }} value="5"><label class="custom-control-label" for="mobileReleasePreview"><span class="label release">Release Preview</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mobileTargeted" name="mobileTargeted" {{ $milestone->mobileTargeted == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="mobileTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mobileBroad" name="mobileBroad" {{ $milestone->mobileBroad == '1' ? 'checked' : '' }} value="7"><label class="custom-control-label" for="mobileBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Xbox</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="xboxSkip" name="xboxSkip" {{ $milestone->xboxSkip == '1' ? 'checked' : '' }} value="1"><label class="custom-control-label" for="xboxSkip"><span class="label skip">Alpha Skip Ahead Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="xboxFast" name="xboxFast" {{ $milestone->xboxFast == '1' ? 'checked' : '' }} value="2"><label class="custom-control-label" for="xboxFast"><span class="label fast">Alpha Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="xboxSlow" name="xboxSlow" {{ $milestone->xboxSlow == '1' ? 'checked' : '' }} value="3"><label class="custom-control-label" for="xboxSlow"><span class="label slow">Beta Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="xboxPreview" name="xboxPreview" {{ $milestone->xboxPreview == '1' ? 'checked' : '' }} value="4"><label class="custom-control-label" for="xboxPreview"><span class="label preview">Delta Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="xboxReleasePreview" name="xboxReleasePreview" {{ $milestone->xboxReleasePreview == '1' ? 'checked' : '' }} value="5"><label class="custom-control-label" for="xboxReleasePreview"><span class="label release">Omega Ring</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="xboxTargeted" name="xboxTargeted" {{ $milestone->xboxTargeted == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="xboxTargeted"><span class="label targeted">Production</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Server</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="serverSlow" name="serverSlow" {{ $milestone->serverSlow == '1' ? 'checked' : '' }} value="3"><label class="custom-control-label" for="serverSlow"><span class="label slow">Preview</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="serverTargeted" name="serverTargeted" {{ $milestone->serverTargeted == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="serverTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="serverBroad" name="serverBroad" {{ $milestone->serverBroad == '1' ? 'checked' : '' }} value="7"><label class="custom-control-label" for="serverBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="serverLTS" name="serverLTS" {{ $milestone->serverLTS == '1' ? 'checked' : '' }} value="8"><label class="custom-control-label" for="serverLTS"><span class="label ltsc">Long-Term Servicing Channel</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Holographic</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="holographicTargeted" name="holographicTargeted" {{ $milestone->holographicTargeted == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="holographicTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="holographicBroad" name="holographicBroad" {{ $milestone->holographicBroad == '1' ? 'checked' : '' }} value="7"><label class="custom-control-label" for="holographicBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="holographicLTS" name="holographicLTS" {{ $milestone->holographicLTS == '1' ? 'checked' : '' }} value="8"><label class="custom-control-label" for="holographicLTS"><span class="label ltsc">Long-Term Servicing Channel</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">IoT</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="iotSlow" name="iotSlow" {{ $milestone->iotSlow == '1' ? 'checked' : '' }} value="3"><label class="custom-control-label" for="iotSlow"><span class="label slow">Preview</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="iotTargeted" name="iotTargeted" {{ $milestone->iotTargeted == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="iotTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="iotBroad" name="iotBroad" {{ $milestone->iotBroad == '1' ? 'checked' : '' }} value="7"><label class="custom-control-label" for="iotBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Team</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="teamTargeted" name="teamTargeted" {{ $milestone->teamTargeted == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="teamTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="teamBroad" name="teamBroad" {{ $milestone->teamBroad == '1' ? 'checked' : '' }} value="7"><label class="custom-control-label" for="teamBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">ISO</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="iso" name="iso" {{ $milestone->iso == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="iso"><span class="label targeted">Public</span></label></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">SDK</label>
        <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="sdk" name="sdk" {{ $milestone->sdk == '1' ? 'checked' : '' }} value="6"><label class="custom-control-label" for="sdk"><span class="label targeted">Public</span></label></label></div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-save"></i> Save</button>
    </div>
</form>
@endsection