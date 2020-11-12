@extends('core.layouts.app')
@section('title') General &middot; Settings @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">General</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.settings.general') }}">Settings</a></li>
        <li class="breadcrumb-item active">General</li>
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
    <form method="POST" action="{{ route('admin.settings.general.update') }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <fieldset class="row" @cannot('edit_settings') disabled @endcannot>
            <div class="col-12">
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        Identity
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ getSetting('name') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Short name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="Short name" value="{{ getSetting('short_name') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Slogan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="slogan" name="slogan" placeholder="Slogan" value="{{ getSetting('slogan') }}">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@endsection
