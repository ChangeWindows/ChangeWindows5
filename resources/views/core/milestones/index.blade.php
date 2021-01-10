@extends('core.layouts.app')
@section('title') Milestones @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Milestones</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
        <li class="breadcrumb-item active">Milestones</li>
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
            @can('create_milestone')
                <form method="POST" class="card border-0 shadow p-3" action="{{ route('admin.milestones.store') }}">
                    {{ csrf_field() }}
                    <h3 class="h6">
                        New milestone
                        <button type="submit" class="btn btn-primary float-end btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="product_name">Product name</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ old('product_name') }}" required placeholder="OS name">
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required placeholder="Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="codename">Codename</label>
                            <input type="text" class="form-control @error('codename') is-invalid @enderror" name="codename" id="codename" value="{{ old('codename') }}" required placeholder="Codename">
                            @error('codename')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="version">Version</label>
                            <input type="text" class="form-control @error('version') is-invalid @enderror" name="version" id="version" value="{{ old('version') }}" required placeholder="Version">
                            @error('version')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="canonical_version">Canonical version</label>
                            <input type="text" class="form-control @error('canonical_version') is-invalid @enderror" name="canonical_version" id="canonical_version" value="{{ old('canonical_version') }}" required placeholder="Canonical version">
                            @error('canonical_version')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="color">Color</label>
                            <div class="input-group @error('color') is-invalid @enderror">
                                <div class="input-group-prepend"><span class="input-group-text">#</span></div>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="color" value="{{ old('color') }}" required placeholder="OS name">
                            </div>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            @endcan
        </div>
        <div class="col-12">
            <h3 class="h5 title">Milestones</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($milestones as $milestone)
                    @include('core.search._milestone', ['milestone' => $milestone])
                @empty
                    <div class="col-12 text-center my-5">
                        <h6>No milestone available...</h6>
                        <p>Create one to get started</p>
                    </div>
                @endforelse
            </div>
        </div>
        @if ($milestones->hasPages())
            <div class="col-12 d-flex flex-row justify-content-center">
                {{ $milestones->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
