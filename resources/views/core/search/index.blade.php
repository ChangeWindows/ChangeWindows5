@extends('core.layouts.app')
@section('title') Search @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Search</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item active">Search</li>
    </ol>
</div>
<div class="content-box">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h1 class="mt-5 mb-0"><i class="far fa-fw fa-search text-primary"></i> Search</h1>
            <p>Search in ChangeWindows's Backstage.</p>
        </div>
        <div class="col-12 col-sm-10 col-md-9 col-lg-7 col-xl-6 col-xxl-5 mb-5">
            <form class="d-flex shadow rounded" action="{{ route('admin.search.find') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input class="form-control form-control-lg border-0" type="search" name="search" placeholder="Search..." aria-label="Search..." accesskey="s">
                    <button class="btn btn-primary btn-lg" type="submit"><i class="far fa-fw fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
