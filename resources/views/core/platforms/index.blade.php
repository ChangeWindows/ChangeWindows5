@extends('core.layouts.app')
@section('title') Platforms @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Platforms</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
        <li class="breadcrumb-item active">Platforms</li>
    </ol>
</div>
<div class="content-box">
    <div class="row">
        @if (session('status'))
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="me-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        @endif
        <div class="col-12">
            @can('create_platform')
                <form method="POST" class="card border-0 shadow p-3" action="{{ route('admin.platforms.store') }}">
                    {{ csrf_field() }}
                    <h3 class="h6">
                        New platform
                        <button type="submit" class="btn btn-primary float-right btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="name" placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="color">Color</label>
                            <div class="input-group @error('color') is-invalid @enderror">
                                <div class="input-group-prepend"><span class="input-group-text">#</span></div>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" aria-describedby="color" placeholder="Color" value="{{ old('color') }}">
                            </div>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="icon">Icon</label>
                            <div class="input-group @error('icon') is-invalid @enderror">
                                <div class="input-group-prepend"><span class="input-group-text">far fa-fw fa-</span></div>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" aria-describedby="icon" placeholder="Icon" value="{{ old('icon') }}">
                            </div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">A <a href="https://fontawesome.com/icons?d=gallery&s=regular">Font Awesome 5 Pro Regular</a>-icon to represent the platform.</small>
                        </div>
                    </div>
                </form>
            @endcan
        </div>
        <div class="col-12">
            <h3 class="h5 title">Platforms</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($platforms as $platform)
                    @include('core.search._platform', ['platform' => $platform])
                @empty
                    <div class="col-12 text-center my-5">
                        <h6>No platforms available...</h6>
                        <p>Create one to get started!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
