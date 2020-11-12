@extends('core.layouts.app')
@section('title') {{ $user->name }} &middot; Accounts @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">{{ $user->name }}</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Gebruikers</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Accounts</a></li>
        <li class="breadcrumb-item active">{{ $user->name }}</li>
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
    <form method="POST" action="{{ route('admin.accounts.update', $user) }}">
        <fieldset class="row" @cannot('edit_user') disabled @endcannot>
            <div class="col-12">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        General
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Opslaan</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" name="name" id="name" required placeholder="Name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="role">Gebruikersrol</label>
                            <select class="form-select" @error('role') is-invalid @enderror" id="role" name="role_id" aria-describedby="roleHelp" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role->id) == $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" id="email" name="email" aria-describedby="emailHelp" required placeholder="E-mail">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="emailHelp" class="form-text">Niet zichtbaar.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phone">Telefoonnummer</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" id="phone" name="phone" aria-describedby="phoneHelp" placeholder="Telefoonnummer">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small id="phoneHelp" class="form-text">Niet zichtbaar.</small>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    <div class="row">
        @can('delete_user')
            <div class="col-12">
                <h3 class="h5 title text-danger">Danger zone</h3>
            </div>
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3 d-block" action="{{ route('admin.accounts.delete', $user) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <h3 class="h6">Account verwijderen</h3>
                    <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="far fa-fw fa-trash-alt"></i> Account verwijderen</button>
                    <small class="form-text">Verwijder de gebruiker. Deze actie is direct en onomkeerbaar. Voor een leidingsaccount zou deze optie nooit nodig moeten zijn.</small>
                </form>
            </div>
        @endcan
    </div>
</div>
@endsection
