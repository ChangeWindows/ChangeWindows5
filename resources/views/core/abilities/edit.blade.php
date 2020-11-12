@extends('core.layouts.app')
@section('title') {{ $ability->name }} &middot; Permissions @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">{{ $ability->name }}</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Users</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.abilities') }}">Permissions</a></li>
        <li class="breadcrumb-item active">{{ $ability->name }}</li>
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
    <form method="POST" action="{{ route('admin.abilities.update', $ability) }}">
        <fieldset class="row" @cannot('edit_ability') disabled @endcannot>
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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $ability->name) }}" name="name" id="name" required placeholder="Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="label">Label</label>
                            <input type="text" class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $ability->label) }}" name="label" id="label" required placeholder="Label">
                            @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection
