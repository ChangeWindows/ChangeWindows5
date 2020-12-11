@extends('core.layouts.app')
@section('title') Roles @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Roles</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Users</a></li>
        <li class="breadcrumb-item active">Roles</li>
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
        @can('create_role')
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3" action="{{ route('admin.roles.store') }}">
                    {{ csrf_field() }}
                    <h3 class="h6">
                        New role
                        <button type="submit" class="btn btn-primary float-end btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
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
                            <label class="form-label" for="description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" aria-describedby="description" placeholder="Description" value="{{ old('description') }}">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
        @endcan
        <div class="col-12">
            <h3 class="h5 title">Roles</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($roles as $role)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
                        <div class="card shadow border-0 h-100 d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <div class="flex-grow-1 text-break">
                                        <h3 class="card-title h6 mb-1">
                                            {{ $role->name }}
                                        </h3>
                                        <p class="card-text card-description-overflow"><small class="text-muted">{{ $role->description }}</small></p>
                                    </div>
                                </div>
                                <div class="flex-grow-1"></div>
                                <div class="avatar-bar avatar-bar-sm flex-wrap default mt-4 mb-2">
                                    @foreach ($role->users as $user)
                                        <a href="{{ route('admin.accounts.edit', $user) }}" class="icon-avatar" data-bs-toggle="tooltip" data-placement="top" title="{{ $user->name }}"><img src="{{ $user->avatar }}" /></a>
                                        @if ($loop->iteration === 7 && $loop->remaining > 1)
                                            <div class="icon-avatar" data-bs-toggle="tooltip" data-placement="top" title="And {{ $loop->remaining }} more"><small>+{{ $loop->remaining }}</small></div>
                                        @endif
                                        @break($loop->iteration === 7 && $loop->remaining > 1)
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary btn-sm">
                                        @can('assign_ability')
                                            <i class="far fa-fw fa-pencil"></i> Edit</a>
                                        @else
                                            <i class="far fa-fw fa-info-circle"></i> Details</a>
                                        @endcan
                                    </a>
                                    @can('edit_role')
                                        <form method="POST" action="{{ route('admin.roles.default', $role) }}">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <div class="btn-group">
                                                @if ($role->is_default)
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-fw fa-check"></i></button>
                                                @else
                                                    <button type="submit" class="btn btn-light btn-sm"><i class="far fa-fw fa-check"></i></button>
                                                @endif
                                            </div>
                                        </form>
                                    @else
                                        <div class="btn-group">
                                            @if ($role->is_default)
                                                <button type="submit" class="btn btn-primary btn-sm" disabled><i class="far fa-fw fa-check"></i></button>
                                            @endif
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center my-5">
                        <h4>No roles available...</h4>
                        <p>Create one to get started.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
