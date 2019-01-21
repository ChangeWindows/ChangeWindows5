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
        <div class="checkbox"><label><input type="checkbox" name="pcSkip" {{ $milestone->pcSkip == '1' ? 'checked' : '' }} value="1"> <span class="label skip">Skip Ahead</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="pcFast" {{ $milestone->pcFast == '1' ? 'checked' : '' }} value="2"> <span class="label fast">Fast Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="pcSlow" {{ $milestone->pcSlow == '1' ? 'checked' : '' }} value="3"> <span class="label slow">Slow Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="pcReleasePreview" {{ $milestone->pcReleasePreview == '1' ? 'checked' : '' }} value="5"> <span class="label release">Release Preview</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="pcTargeted" {{ $milestone->pcTargeted == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="pcBroad" {{ $milestone->pcBroad == '1' ? 'checked' : '' }} value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="pcLTS" {{ $milestone->pcLTS == '1' ? 'checked' : '' }} value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Mobile</label>
        <div class="checkbox"><label><input type="checkbox" name="mobileFast" {{ $milestone->mobileFast == '1' ? 'checked' : '' }} value="2"> <span class="label fast">Fast Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="mobileSlow" {{ $milestone->mobileSlow == '1' ? 'checked' : '' }} value="3"> <span class="label slow">Slow Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="mobileReleasePreview" {{ $milestone->mobileReleasePreview == '1' ? 'checked' : '' }} value="5"> <span class="label release">Release Preview</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="mobileTargeted" {{ $milestone->mobileTargeted == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="mobileBroad" {{ $milestone->mobileBroad == '1' ? 'checked' : '' }} value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Xbox</label>
        <div class="checkbox"><label><input type="checkbox" name="xboxSkip" {{ $milestone->xboxSkip == '1' ? 'checked' : '' }} value="1"> <span class="label skip">Alpha Skip Ahead Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="xboxFast" {{ $milestone->xboxFast == '1' ? 'checked' : '' }} value="2"> <span class="label fast">Alpha Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="xboxSlow" {{ $milestone->xboxSlow == '1' ? 'checked' : '' }} value="3"> <span class="label slow">Beta Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="xboxPreview" {{ $milestone->xboxPreview == '1' ? 'checked' : '' }} value="4"> <span class="label preview">Delta Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="xboxReleasePreview" {{ $milestone->xboxReleasePreview == '1' ? 'checked' : '' }} value="5"> <span class="label release">Omega Ring</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="xboxTargeted" {{ $milestone->xboxTargeted == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Production</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Server</label>
        <div class="checkbox"><label><input type="checkbox" name="serverSlow" {{ $milestone->serverSlow == '1' ? 'checked' : '' }} value="3"> <span class="label slow">Preview</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="serverTargeted" {{ $milestone->serverTargeted == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="serverBroad" {{ $milestone->serverBroad == '1' ? 'checked' : '' }} value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="serverLTS" {{ $milestone->serverLTS == '1' ? 'checked' : '' }} value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Holographic</label>
        <div class="checkbox"><label><input type="checkbox" name="holographicTargeted" {{ $milestone->holographicTargeted == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="holographicBroad" {{ $milestone->holographicBroad == '1' ? 'checked' : '' }} value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="holographicLTS" {{ $milestone->holographicLTS == '1' ? 'checked' : '' }} value="8"> <span class="label ltsc">Long-Term Servicing Channel</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">IoT</label>
        <div class="checkbox"><label><input type="checkbox" name="iotSlow" {{ $milestone->iotSlow == '1' ? 'checked' : '' }} value="3"> <span class="label slow">Preview</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="iotTargeted" {{ $milestone->iotTargeted == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="iotBroad" {{ $milestone->iotBroad == '1' ? 'checked' : '' }} value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">Team</label>
        <div class="checkbox"><label><input type="checkbox" name="teamTargeted" {{ $milestone->teamTargeted == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Semi-Annual Targeted</span></label></div>
        <div class="checkbox"><label><input type="checkbox" name="teamBroad" {{ $milestone->teamBroad == '1' ? 'checked' : '' }} value="7"> <span class="label broad">Semi-Annual Broad</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">ISO</label>
        <div class="checkbox"><label><input type="checkbox" name="iso" {{ $milestone->iso == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Public</span></label></div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm">
        <label for="ring" class="control-label extra-margin">SDK</label>
        <div class="checkbox"><label><input type="checkbox" name="sdk" {{ $milestone->sdk == '1' ? 'checked' : '' }} value="6"> <span class="label targeted">Public</span></label></div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-save"></i> Save</button>
    </div>
</form>
@endsection