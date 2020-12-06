@extends('core.layouts.app')
@section('title') {{ $milestone->osname }} version {{ $milestone->version }} @endsection

@section('content')
<div class="page-bar">
    <div class="d-flex flex-md-row flex-column align-items-end">
        <h1 class="h4 d-none d-md-inline-block m-0">{{ $milestone->osname }} version {{ $milestone->version }}</h1>
        <ol class="breadcrumb pt-2 pt-md-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Milestone</a></li>
            <li class="breadcrumb-item active">{{ $milestone->osname }} version {{ $milestone->version }}</li>
        </ol>
    </div>
</div>
<div class="content-box">
    @if (session('status'))
        <div class="row mb-3">
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="mr-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.milestones.update', $milestone) }}">
        <fieldset class="row" @cannot('edit_milestone') disabled @endcannot>
            <div class="col-12">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        General
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="id">ID</label>
                            <input type="text" class="form-control @error('id') is-invalid @enderror" name="id" id="id" required placeholder="ID" value="{{ old('id', $milestone->id) }}">
                            @error('id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="osname">OS name</label>
                            <input type="text" class="form-control @error('osname') is-invalid @enderror" name="osname" id="osname" required placeholder="OS name" value="{{ old('osname', $milestone->osname) }}">
                            @error('osname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name', $milestone->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="codename">Codename</label>
                            <input type="text" class="form-control @error('codename') is-invalid @enderror" name="codename" id="codename" required placeholder="Codename" value="{{ old('codename', $milestone->codename) }}">
                            @error('codename')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="version">Version</label>
                            <input type="text" class="form-control @error('version') is-invalid @enderror" name="version" id="version" required placeholder="Version" value="{{ old('version', $milestone->version) }}">
                            @error('version')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="color">Color</label>
                            <div class="input-group @error('color') is-invalid @enderror">
                                <div class="input-group-prepend"><span class="input-group-text">#</span></div>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="color" required placeholder="Color" value="{{ old('color', $milestone->color) }}">
                            </div>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        Flights
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="start_build">Start build</label>
                            <input type="text" class="form-control @error('start_build') is-invalid @enderror" name="start_build" id="start_build" required placeholder="Start build" value="{{ old('start_build', $milestone->start_build) }}">
                            @error('start_build')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        Dates
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="preview">Preview</label>
                            <input type="date" class="form-control @error('preview') is-invalid @enderror" name="preview" id="preview" placeholder="Preview" value="{{ old('preview', $milestone->preview->format('Y-m-d')) }}">
                            @error('preview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="public">Public</label>
                            <input type="date" class="form-control @error('public') is-invalid @enderror" name="public" id="public" placeholder="Public" value="{{ old('public', $milestone->public->format('Y-m-d')) }}">
                            @error('public')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="mainEol">Main end</label>
                            <input type="date" class="form-control @error('mainEol') is-invalid @enderror" name="mainEol" id="mainEol" placeholder="Main end" value="{{ old('mainEol', $milestone->mainEol->format('Y-m-d')) }}">
                            @error('mainEol')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="mainXol">Extended end</label>
                            <input type="date" class="form-control @error('mainXol') is-invalid @enderror" name="mainXol" id="mainXol" placeholder="Extended end" value="{{ old('mainXol', $milestone->mainXol->format('Y-m-d')) }}">
                            @error('mainXol')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="ltsEol">LTSC end</label>
                            <input type="date" class="form-control @error('ltsEol') is-invalid @enderror" name="ltsEol" id="ltsEol" placeholder="LTSC end" value="{{ old('ltsEol', $milestone->ltsEol->format('Y-m-d')) }}">
                            @error('ltsEol')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        Rings
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">PC</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="pcFast" name="pcFast" {{ $milestone->pcFast == '1' ? 'checked' : '' }} value="2"><label class="form-check-label" for="pcFast"><span class="label fast">Dev</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="pcSlow" name="pcSlow" {{ $milestone->pcSlow == '1' ? 'checked' : '' }} value="3"><label class="form-check-label" for="pcSlow"><span class="label slow">Beta</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="pcReleasePreview" name="pcReleasePreview" {{ $milestone->pcReleasePreview == '1' ? 'checked' : '' }} value="5"><label class="form-check-label" for="pcReleasePreview"><span class="label release">Release Preview</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="pcTargeted" name="pcTargeted" {{ $milestone->pcTargeted == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="pcTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="pcBroad" name="pcBroad" {{ $milestone->pcBroad == '1' ? 'checked' : '' }} value="7"><label class="form-check-label" for="pcBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="pcLTS" name="pcLTS" {{ $milestone->pcLTS == '1' ? 'checked' : '' }} value="8"><label class="form-check-label" for="pcLTS"><span class="label ltsc">Long-Term Servicing Channel</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Xbox</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="xboxSkip" name="xboxSkip" {{ $milestone->xboxSkip == '1' ? 'checked' : '' }} value="1"><label class="form-check-label" for="xboxSkip"><span class="label skip">Alpha Skip Ahead Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="xboxFast" name="xboxFast" {{ $milestone->xboxFast == '1' ? 'checked' : '' }} value="2"><label class="form-check-label" for="xboxFast"><span class="label fast">Alpha Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="xboxSlow" name="xboxSlow" {{ $milestone->xboxSlow == '1' ? 'checked' : '' }} value="3"><label class="form-check-label" for="xboxSlow"><span class="label slow">Beta Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="xboxPreview" name="xboxPreview" {{ $milestone->xboxPreview == '1' ? 'checked' : '' }} value="4"><label class="form-check-label" for="xboxPreview"><span class="label preview">Delta Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="xboxReleasePreview" name="xboxReleasePreview" {{ $milestone->xboxReleasePreview == '1' ? 'checked' : '' }} value="5"><label class="form-check-label" for="xboxReleasePreview"><span class="label release">Omega Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="xboxTargeted" name="xboxTargeted" {{ $milestone->xboxTargeted == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="xboxTargeted"><span class="label targeted">Production</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">10X</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="tenXSlow" name="tenXSlow" {{ $milestone->tenXSlow == '1' ? 'checked' : '' }} value="3"><label class="form-check-label" for="tenXSlow"><span class="label slow">Preview</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Server</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="serverSlow" name="serverSlow" {{ $milestone->serverSlow == '1' ? 'checked' : '' }} value="3"><label class="form-check-label" for="serverSlow"><span class="label slow">Preview</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="serverTargeted" name="serverTargeted" {{ $milestone->serverTargeted == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="serverTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="serverLTS" name="serverLTS" {{ $milestone->serverLTS == '1' ? 'checked' : '' }} value="8"><label class="form-check-label" for="serverLTS"><span class="label ltsc">Long-Term Servicing Channel</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Holographic</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="holographicTargeted" name="holographicTargeted" {{ $milestone->holographicTargeted == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="holographicTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="holographicBroad" name="holographicBroad" {{ $milestone->holographicBroad == '1' ? 'checked' : '' }} value="7"><label class="form-check-label" for="holographicBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="holographicLTS" name="holographicLTS" {{ $milestone->holographicLTS == '1' ? 'checked' : '' }} value="8"><label class="form-check-label" for="holographicLTS"><span class="label ltsc">Long-Term Servicing Channel</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">IoT</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="iotSlow" name="iotSlow" {{ $milestone->iotSlow == '1' ? 'checked' : '' }} value="3"><label class="form-check-label" for="iotSlow"><span class="label slow">Preview</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="iotTargeted" name="iotTargeted" {{ $milestone->iotTargeted == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="iotTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="iotBroad" name="iotBroad" {{ $milestone->iotBroad == '1' ? 'checked' : '' }} value="7"><label class="form-check-label" for="iotBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">Team</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="teamFast" name="teamFast" {{ $milestone->teamFast == '1' ? 'checked' : '' }} value="2"><label class="form-check-label" for="teamFast"><span class="label fast">Fast Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="teamSlow" name="teamSlow" {{ $milestone->teamSlow == '1' ? 'checked' : '' }} value="7"><label class="form-check-label" for="teamSlow"><span class="label slow">Slow Ring</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="teamTargeted" name="teamTargeted" {{ $milestone->teamTargeted == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="teamTargeted"><span class="label targeted">Semi-Annual Targeted</span></label></label></div>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="teamBroad" name="teamBroad" {{ $milestone->teamBroad == '1' ? 'checked' : '' }} value="7"><label class="form-check-label" for="teamBroad"><span class="label broad">Semi-Annual Broad</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">ISO</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="iso" name="iso" {{ $milestone->iso == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="iso"><span class="label targeted">Public</span></label></label></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label for="ring" class="control-label mb-2">SDK</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="sdk" name="sdk" {{ $milestone->sdk == '1' ? 'checked' : '' }} value="6"><label class="form-check-label" for="sdk"><span class="label targeted">Public</span></label></label></div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row mt-3">
            <div class="col-12">
                <h3 class="h5 title">
                    Platforms and channels
                    @can('edit_milestone')
                        <div class="btn-group float-right">
                            <div class="dropdown">
                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                    <i class="far fa-plus"></i> Add platfrom
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    @foreach ($platforms as $platform)
                                        @if (!$milestone->milestonePlatforms->pluck('platform.id')->contains($platform->id))
                                            <li>
                                                <form method="POST" action="{{ route('admin.milestonePlatforms.store', ['milestone' => $milestone, 'platform' => $platform]) }}">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="dropdown-item">{!! $platform->colored_icon !!} {{ $platform->name }}</button>
                                                </form>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endcan
                </h3>
            </div>
            <div class="col-12 card-set">
                <div class="row mt-3">
                    @foreach($milestone->milestonePlatforms as $milestonePlatform)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
                            <div class="card shadow border-0 h-100">
                                <div class="p-3 text-white d-flex align-items-center justify-content-between" style="{{ $milestonePlatform->platform->bg_color }}">
                                    <span>{!! $milestonePlatform->platform->plain_icon !!} {{ $milestonePlatform->platform->name }}</span>
                                    @can('edit_milestone')
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                                <i class="far fa-plus"></i> Add channel
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                                @foreach($milestonePlatform->platform->channelPlatforms as $channelPlatform)
                                                    @if (!$milestonePlatform->channelMilestonePlatform->pluck('channel_platform_id')->contains($channelPlatform->id))
                                                        <li>
                                                            <form method="POST" action="{{ route('admin.channelMilestonePlatforms.store', [$milestonePlatform, $channelPlatform]) }}">
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                                                    <div class="dot" style="background-color: {{ $channelPlatform->channel->color }}"></div>
                                                                    {{ $channelPlatform->name }}
                                                                </button>
                                                            </form>
                                                        <li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endcan
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <div class="flex-grow-1">
                                            @foreach($milestonePlatform->channelMilestonePlatform as $cmp)
                                                <div class="d-flex align-items-center justify-content-between @if (!$loop->first) mt-2 @endif">
                                                    <div class="dot" style="background-color: {{ $cmp->channelPlatform->channel->color }}"></div>
                                                    <span>{{ $cmp->channelPlatform->name }}</span>
                                                    <div class="flex-grow-1"></div>
                                                    <div class="btn-toolbar @loop">
                                                        <form method="POST" action="{{ route('admin.channelMilestonePlatforms.toggle', $cmp) }}">
                                                            {{ method_field('PATCH') }}
                                                            {{ csrf_field() }}
                                                            @if ($cmp->active)
                                                                <button type="submit" class="btn btn-success btn-sm mr-2"><i class="far fa-fw fa-check"></i></button>
                                                            @else
                                                                <button type="submit" class="btn btn-danger btn-sm mr-2"><i class="far fa-fw fa-times"></i></button>
                                                            @endif
                                                        </form>
                                                        <form method="POST" action="{{ route('admin.channelMilestonePlatforms.delete', $cmp) }}">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-fw fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex-grow-1"></div>
                                </div>
                                @can('edit_milestone')
                                    <div class="d-flex justify-content-between align-items-center card-footer">
                                        <form method="POST" action="{{ route('admin.milestonePlatforms.delete', $milestonePlatform) }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm float-right"><i class="far fa-trash-alt"></i> Delete</button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
    @can('delete_milestone')
        <div class="row">
            <div class="col-12">
                <h3 class="h5 title text-danger">Danger zone</h3>
            </div>
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3 d-block" action="{{ route('admin.milestones.delete', $milestone) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <h3 class="h6">Delete milestone</h3>
                    <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="far fa-fw fa-trash-alt"></i> Delete milestone</button>
                    <small class="form-text">Deletes all data related to the milestone. This action is irreversable.</small>
                </form>
            </div>
        </div>
    @endcan
</div>
@endsection
