@extends('core.layouts.app')
@section('title') Permissions @endsection

@section('hero')
<div class="jumbotron bg-dark text-white">
    <div class="container">
        <h2>Permissions</h2>
    </div>
</div>
@endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Permissions</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Users</a></li>
        <li class="breadcrumb-item active">Permissions</li>
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
        @can('create_ability')
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3" action="{{ route('admin.abilities.store') }}">
                    {{ csrf_field() }}
                    <h3 class="h6">
                        New permission
                        <button type="submit" class="btn btn-primary float-right btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-sm-6 col-12">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="name" placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6 col-12">
                            <label class="form-label" for="label">Label</label>
                            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" aria-describedby="label" placeholder="Label" value="{{ old('label') }}">
                            @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        @endcan
        <div class="col-12">
            <h3 class="h5 title">Permissions</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($abilities as $ability)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
                        <div class="card shadow border-0 h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <div class="flex-grow-1 text-break">
                                        <h3 class="card-title h6 m-0">{{ $ability->name }}</h3>
                                        <p class="card-text card-description-overflow"><small class="text-muted">{{ $ability->label }}</small></p>
                                    </div>
                                </div>
                                <div class="flex-grow-1"></div>
                                @can('edit_ability')
                                 <div class="d-flex justify-content-between align-items-center mt-4">
                                        <a href="{{ route('admin.abilities.edit', $ability) }}" class="btn btn-primary btn-sm"><i class="far fa-fw fa-pencil"></i> Edit</a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center my-5">
                        <h4>No permissions available...</h4>
                        <p>Create one to get started.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
