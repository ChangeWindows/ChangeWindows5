@extends('core.layouts.app')
@section('title') {{ $platform->name }} &middot; Platforms @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">{{ $platform->name }}</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.platforms') }}">Platform</a></li>
        <li class="breadcrumb-item active">{{ $platform->name }}</li>
    </ol>
</div>
<div class="content-box">
    @if (session('status'))
        <div class="row mb-3">
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="me-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.platforms.update', $platform) }}">
        <fieldset class="row" @cannot('edit_platform') disabled @endcannot>
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
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $platform->name) }}" name="name" id="name" required placeholder="Titel">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="position">Position</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" aria-describedby="position" placeholder="Position" value="{{ old('position', $platform->position) }}">
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        Icon
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="description">Color</label>
                            <div class="input-group @error('color') is-invalid @enderror">
                                <div class="input-group-prepend"><span class="input-group-text">#</span></div>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" aria-describedby="color" placeholder="Color" value="{{ str_replace('#', '', old('color', $platform->color)) }}">
                            </div>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="description">Icon</label>
                            <div class="input-group @error('icon') is-invalid @enderror">
                                <div class="input-group-prepend"><span class="input-group-text">far fa-fw fa-</span></div>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" aria-describedby="icon" placeholder="Icon" value="{{ old('icon', $platform->icon) }}">
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">A <a href="https://fontawesome.com/icons?d=gallery&s=regular">Font Awesome 5 Pro Regular</a>-icon to represent the platform.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        Status
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <div class="mb-2">
                                <div class="form-check">
                                    <input type="checkbox" id="active" name="active" class="form-check-input" value="1" {{ old('active', $platform->active) == 1 ? 'checked="checked"' : ''}}>
                                    <label class="form-check-label" for="active">Platform is active</label>
                                </div>
                                <small id="activeHelp" class="form-text">Inactive platforms will be shown less prominently and be excluded from the Flight form.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="row mt-3">
            <div class="col-12">
                <h3 class="h5 title">
                    Channels
                    @can('edit_platform')
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-target="#channelModal">
                                <i class="far fa-plus"></i> Add channel
                            </button>
                        </div>
                    @endcan
                </h3>
            </div>
            <div class="col-12 card-set">
                <div class="row mt-3">
                    @foreach($platform->channelPlatforms as $channelPlatforms)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
                            <div class="card shadow border-0 h-100 overflow-hidden">
                                <div class="p-3 text-white" style="{{ $channelPlatforms->channel->bg_color }}">
                                    <i class="fab fa-fw fa-windows"></i> {{ $channelPlatforms->channel->name }}
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <div class="flex-grow-1">
                                            <h3 class="card-title h6 mb-0">{{ $channelPlatforms->name }}</h3>
                                            <p class="text-muted m-0"><small>{{ $channelPlatforms->short_name }}</small></p>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1"></div>
                                </div>
                                @can('edit_channel')
                                    <div class="d-flex justify-content-between align-items-center card-footer">
                                        <form method="POST" action="{{ route('admin.channelPlatforms.delete', $channelPlatforms) }}">
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
    @can('delete_theme')
        <div class="row">
            <div class="col-12">
                <h3 class="h5 title text-danger">Danger zone</h3>
            </div>
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3 d-block" action="{{ route('admin.platforms.delete', $platform) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <h3 class="h6">Delete platform</h3>
                    <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="far fa-fw fa-trash-alt"></i> Delete platform</button>
                    <small class="form-text">Delete this platform and all its related content.</small>
                </form>
            </div>
        </div>
    @endcan
</div>

<div class="modal fade" id="channelModal" tabindex="-1" role="dialog" aria-labelledby="channelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('admin.channelPlatforms.store') }}" class="modal-content row">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title" id="channelModalLabel">Add channel</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Sluiten"><i class="far fa-fw fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <input type="hidden" name="platform" value="{{ $platform->id }}" />
                    <div class="col-12">
                        <label class="form-label" for="channel">Channel</label>
                        <select class="form-select" @error('channel') is-invalid @enderror" id="channel" name="channel" aria-describedby="channelHelp" required>
                            @foreach ($channels as $channel)
                                @if (!$platform->channelPlatforms->pluck('channel.id')->contains($channel->id))
                                    <option value="{{ $channel->id }}" {{ old('channel') === $channel->id ? 'selected' : ''}}>{{ $channel->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('channel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" required placeholder="Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="short_name">Short name</label>
                        <input type="text" class="form-control @error('short_name') is-invalid @enderror" value="{{ old('short_name') }}" name="short_name" id="short_name" required placeholder="Short name">
                        @error('short_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
            </div>
        </form>
    </div>
</div>
@endsection
