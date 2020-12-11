@extends('core.layouts.app')
@section('title') Dashboard @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Dashboard</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</div>
<div class="content-box">
    <div class="row">
        @if (Auth::user()->onboarding !== config('app.viv'))
            <div class="col-12">
                <div class="rounded px-4 py-5 bg-top shadow text-white position-relative">
                    @if (Auth::user()->onboarding === null)
                        <h1 class="m-0 fw-light">Hello.<br />Welcome to <span class="fw-bold">ChangeWindows</span>.</h1>
                    @else
                        <h1 class="mb-0 fw-light"><span class="fw-bold">Welcome</span> back.</h1>
                        <h4 class="mb-4 fw-light"><span class="fw-bold">ChangeWindows</span> has been updated to version {{ config('app.viv') }}.</h4>
                        <a href="{{ route('admin.about') }}#new" class="btn btn-light"><i class="far fa-fw fa-layer-plus"></i> What's new?</a>
                    @endif
                    <form method="POST" action="{{ route('admin.dashboard.onboarding') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <button type="submit" class="action-close"><i class="far fa-fw fa-times"></i></button>
                    </form>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card border-0 shadow p-3">
                <h3 class="h6">
                    Timeline
                    <a class="btn btn-primary btn-sm float-end" href="{{ route('admin.settings') }}">
                        <i class="far fa-cog"></i> Settings
                    </a>
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection
