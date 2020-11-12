@extends('core.layouts.app')
@section('title') {{ $role->name }} &middot; Rollen @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">{{ $role->name }}</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Gebruikers</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles') }}">Rollen</a></li>
        <li class="breadcrumb-item active">{{ $role->name }}</li>
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
    <form method="POST" action="{{ route('admin.roles.update', $role) }}">
        <fieldset class="row" @cannot('edit_role') disabled @endcannot>
            <div class="col-12">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        Algemeen
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Opslaan</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Naam</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" name="name" id="name" required placeholder="Titel">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="description">Beschrijving</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('description', $role->description) }}" name="description" id="description" required placeholder="Beschrijving">
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
                    <a href="{{ route('admin.accounts.edit', $user) }}" class="icon-avatar" data-toggle="tooltip" data-placement="top" title="{{ $user->name }}"><img src="{{ $user->avatar }}" /></a>
                @endforeach
            </div>
        </div>
        <div class="col-12">
            <h3 class="h5 title">Permissies</h3>
            <p class="mb-0">Sommige permissies vereisen dat een andere permissie al gegeven is voordat een UI getoond kan worden. Let erop dat het zelf hebben aangemaakt van bepaalde objecten (zoals leden en inzendingen) de permissie altijd zal overschrijven. Bijvoorbeeld: een gebruiker zal altijd een eigen inzending kunnen verwijderen ookal is <code>delete_submission</code> uitgeschakelt, in deze gevallen is de permissie globaal voor het mogen verwijderen van alle inzendingen ongeacht de gebruiker.</p>
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
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-fw fa-trash-alt"></i> Verwijder permissie</button>
                                                @else
                                                    <p class="text-success mb-0"><i class="far fa-fw fa-check"></i> Permissie</i></p>
                                                @endcan
                                            @else
                                                @can('assign_ability')
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-fw fa-plus"></i> Permissie toevoegen</button>
                                                @else
                                                    <p class="text-danger mb-0"><i class="far fa-fw fa-times"></i> Geen permissie</i></p>
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
                        <h4>Geen permissies beschikbaar...</h4>
                        <p>Maak er een om te beginnen!</p>
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
                    <h3 class="h6">Rol verwijderen</h3>
                    <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="far fa-fw fa-trash-alt"></i> Rol verwijderen</button>
                    <small class="form-text">Verwijder de rol. Deze actie verwijderd alle data gerelateerd aan deze rol en is direct en onomkeerbaar.</small>
                </form>
            </div>
        </div>
    @endcan
</div>
@endsection
