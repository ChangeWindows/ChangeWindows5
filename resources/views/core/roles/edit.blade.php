@extends('core.layouts.app')
@section('title') {{ $role->name }} &middot; Roles @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">{{ $role->name }}</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Users</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles') }}">Roles</a></li>
        <li class="breadcrumb-item active">{{ $role->name }}</li>
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
    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
        <fieldset class="row" @cannot('edit_role') disabled @endcannot>
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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" name="name" id="name" required placeholder="Titel">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $role->description) }}" name="description" id="description" required placeholder="Description">
                            @error('description')
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
            <h3 class="h5 title">Accounts</h3>
        </div>
        <div class="col-12">
            <div class="avatar-bar avatar-bar-sm flex-wrap default m-0">
                @foreach ($role->users as $user)
                    <a href="{{ route('admin.accounts.edit', $user) }}" class="icon-avatar" data-bs-toggle="tooltip" data-placement="top" title="{{ $user->name }}"><img src="{{ $user->avatar }}" /></a>
                @endforeach
            </div>
        </div>
        <div class="col-12">
            <h3 class="h5 title">Permissions</h3>
            <p class="mb-0">Some permissions are dependening on other permissions.</p>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($abilities as $ability)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-g">
                        <div class="card shadow border-0 h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <div class="flex-grow-1">
                                        <h3 class="card-title h6 mt-1 mb-0">{{ $ability->name }}</h3>
                                        <p class="card-text card-description-overflow"><small class="text-muted">{{ $ability->label }}</small></p>
                                    </div>
                                </div>
                                <div class="flex-grow-1"></div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="btn-group">
                                        <form method="POST" action="{{ route('admin.roles.toggle', [$role, $ability]) }}">
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            @if ($role->abilities->contains($ability))
                                                @can('assign_ability')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-fw fa-trash-alt"></i> Retract permission</button>
                                                @else
                                                    <p class="text-success mb-0"><i class="far fa-fw fa-check"></i> Permission</i></p>
                                                @endcan
                                            @else
                                                @can('assign_ability')
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-fw fa-plus"></i> Add permission</button>
                                                @else
                                                    <p class="text-danger mb-0"><i class="far fa-fw fa-times"></i> No permission</i></p>
                                                @endcan
                                            @endif
                                        </form>
                                    </div>
                                </div>
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
    @can('delete_role')
        <div class="row">
            <div class="col-12">
                <h3 class="h5 title text-danger">Danger zone</h3>
            </div>
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3 d-block" action="{{ route('admin.roles.delete', $role) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <h3 class="h6">Delete role</h3>
                    <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="far fa-fw fa-trash-alt"></i> Delete role</button>
                    <small class="form-text">Delete this role. This action is ireversable.</small>
                </form>
            </div>
        </div>
    @endcan
</div>
@endsection
