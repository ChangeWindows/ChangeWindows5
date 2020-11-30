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
                    <div class="mr-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
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
                        <div class="col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $platform->name) }}" name="name" id="name" required placeholder="Titel">
                            @error('name')
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
                        <div class="col-md-6">
                            <label class="form-label" for="description">Color</label>
                            <div class="input-group @error('color') is-invalid @enderror">
                                <div class="input-group-prepend"><span class="input-group-text">#</span></div>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" aria-describedby="color" placeholder="Color" value="{{ str_replace('#', '', old('color', $platform->color)) }}">
                            </div>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="mb-2">
                                <div class="form-check">
                                    <input type="checkbox" id="active" name="active" class="form-check-input" value="1" {{ old('active', $platform->active) == 1 ? 'checked="checked"' : ''}}>
                                    <label class="form-check-label" for="active">Platform is active</label>
                                </div>
                                <small id="activeHelp" class="form-text">Inactive platforms will be shown less prominently.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
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
@endsection
