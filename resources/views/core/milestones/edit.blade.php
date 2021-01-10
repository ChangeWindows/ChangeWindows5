@extends('core.layouts.app')
@section('title') {{ $milestone->product_name }} version {{ $milestone->version }} @endsection

@section('content')
<div class="page-bar">
    <div class="d-flex flex-md-row flex-column align-items-end">
        <h1 class="h4 d-none d-md-inline-block m-0">{{ $milestone->product_name }} version {{ $milestone->version }}</h1>
        <ol class="breadcrumb pt-2 pt-md-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Milestone</a></li>
            <li class="breadcrumb-item active">{{ $milestone->product_name }} version {{ $milestone->version }}</li>
        </ol>
    </div>
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
    <form method="POST" action="{{ route('admin.milestones.update', $milestone) }}">
        <fieldset class="row" @cannot('edit_milestone') disabled @endcannot>
            <div class="col-12">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        General
                        <button type="submit" class="btn btn-sm btn-primary float-end"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="product_name">Product name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" required placeholder="Product name" value="{{ old('product_name', $milestone->product_name) }}">
                            @error('product_name')
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
                            <label class="form-label" for="canonical_version">Canonical version</label>
                            <input type="text" class="form-control @error('canonical_version') is-invalid @enderror" name="canonical_version" id="canonical_version" required placeholder="Canonical version" value="{{ old('canonical_version', $milestone->canonical_version) }}">
                            @error('canonical_version')
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
                        <button type="submit" class="btn btn-sm btn-primary float-end"><i class="far fa-save"></i> Save</button>
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
                        <button type="submit" class="btn btn-sm btn-primary float-end"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="start_preview">Start preview</label>
                            <input type="date" class="form-control @error('start_preview') is-invalid @enderror" name="start_preview" id="start_preview" placeholder="Start preview" value="{{ old('start_preview', $milestone->start_preview->format('Y-m-d')) }}">
                            @error('start_preview')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="start_public">Start public</label>
                            <input type="date" class="form-control @error('start_public') is-invalid @enderror" name="start_public" id="start_public" placeholder="Start public" value="{{ old('start_public', $milestone->start_public->format('Y-m-d')) }}">
                            @error('start_public')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="start_extended">Start extended</label>
                            <input type="date" class="form-control @error('start_extended') is-invalid @enderror" name="start_extended" id="start_extended" placeholder="Start extended" value="{{ old('start_extended', $milestone->start_extended->format('Y-m-d')) }}">
                            @error('start_extended')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="start_lts">Start LTS</label>
                            <input type="date" class="form-control @error('start_lts') is-invalid @enderror" name="start_lts" id="start_lts" placeholder="Start LTS" value="{{ old('start_lts', $milestone->start_lts->format('Y-m-d')) }}">
                            @error('start_lts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="end_lts">End LTS</label>
                            <input type="date" class="form-control @error('end_lts') is-invalid @enderror" name="end_lts" id="end_lts" placeholder="End LTS" value="{{ old('end_lts', $milestone->end_lts->format('Y-m-d')) }}">
                            @error('end_lts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <div class="row">
        <div class="col-12">
            <h3 class="h5 title">
                Platforms and channels
                @can('edit_milestone')
                    <div class="btn-group float-end">
                        <div class="dropdown">
                            <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-plus"></i> Add platform
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                @foreach ($platforms as $platform)
                                    @if (!$milestone->platforms->pluck('platform.id')->contains($platform->id))
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
            <div class="row">
                @foreach($milestone->milestonePlatforms as $platform)
                    {{ dd($platform)}}
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
                        <div class="card shadow border-0 h-100">
                            <div class="p-3 text-white d-flex align-items-center justify-content-between" style="{{ $platform->platform->bg_color }}">
                                <span>{!! $platform->platform->plain_icon !!} {{ $platform->platform->name }}</span>
                                @can('edit_milestone')
                                    <div class="dropdown">
                                        <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="far fa-plus"></i> Add channel
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                            @foreach($platform->platform->channels as $channel)
                                                <li>
                                                    <form method="POST" action="{{ route('admin.channelMilestonePlatforms.store', [$platform->platform, $channel]) }}">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="dropdown-item d-flex align-items-center">
                                                            <div class="dot" style="background-color: {{ $channel->color }}"></div>
                                                            {{ $channel->name }}
                                                        </button>
                                                    </form>
                                                <li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endcan
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <div class="flex-grow-1">
                                        @foreach($platform->channels as $channel)
                                            <div class="d-flex align-items-center justify-content-between @if (!$loop->first) mt-2 @endif">
                                                <div class="dot" style="background-color: {{ $channel->color }}"></div>
                                                <span>{{ $channel->pivot->name }}</span>
                                                <div class="flex-grow-1"></div>
                                                <div class="btn-toolbar @loop">
                                                    <form method="POST" action="{{ route('admin.channelMilestonePlatforms.toggle', $channel) }}">
                                                        {{ method_field('PATCH') }}
                                                        {{ csrf_field() }}
                                                        @if ($channel->pivot->active)
                                                            <button type="submit" class="btn btn-success btn-sm me-2"><i class="far fa-fw fa-check"></i></button>
                                                        @else
                                                            <button type="submit" class="btn btn-danger btn-sm me-2"><i class="far fa-fw fa-times"></i></button>
                                                        @endif
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.channelMilestonePlatforms.delete', $channel) }}">
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
                                    <form method="POST" action="{{ route('admin.milestonePlatforms.delete', $platform) }}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm float-end"><i class="far fa-trash-alt"></i> Delete</button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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