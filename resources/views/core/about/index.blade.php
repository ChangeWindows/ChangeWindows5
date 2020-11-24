@extends('core.layouts.app')
@section('title') About @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">About</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item active">About</li>
    </ol>
</div>
<div class="content-box">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <h3 class="h6 m-3 mb-0">About ChangeWindows {{ config('app.viv') }}</h3>
                <div class="card-body">
                    <a href="https://github.com/ChangeWindows/Viv" class="btn btn-primary btn-sm mb-3"><i class="fab fa-fw fa-github"></i> GitHub</a>
                    <p class="mb-0">&copy; Studio 384 &middot; 2014-2020</p>
                    <p>All Rights Reserved</p>
                    <a href="https://studio384.be" class="h4 f-384">Studio <span class="studio-384">384</span></a>
                </div>
            </div>
        </div>
        <div class="col-12" id="new">
            <div class="card border-0 shadow">
                <h3 class="h6 m-3">What's new?</h3>
                <div class="card-body">
                    <h3 class="mt-0">ChangeWindows 6.0</h3>
                    <h5 class="mt-3">What's new in ChangeWindows 6.0-alpha.1? <small class="text-muted">24 November 2020</small></h5>
                    <p><i class="fab fa-fw fa-laravel"></i> Laravel 8.15.0 &middot; <i class="fab fa-fw fa-bootstrap"></i> Bootstrap 5.0.0-alpha3 &middot; <i class="fab fa-fw fa-font-awesome"></i> Font Awesome 5.15.1</p>
                    <p class="mb-1"><b>Backstage</b></p>
                    <ul>
                        <li><span class="badge bg-success">new</span> Introduces the Backstage, a new admin panel for ChangeWindows.</li>
                        <li><span class="badge bg-success">new</span> You can now search for milestones, flights, changelogs and users in the Backstage.</li>
                    </ul>
                    <p class="mb-1"><b>Accounts, profile and settings</b></p>
                    <ul>
                        <li>The Light and Black themes are now available for all users.</li>
                        <li><span class="badge bg-success">new</span> Users can now change their email address and password from within their profile.</li>
                        <li><span class="badge bg-success">new</span> Accounts can now add an avatar.</li>
                    </ul>
                    <p class="mb-1"><b>Other changes</b></p>
                    <ul>
                        <li>Minor enhancements to the front-end theme, including better spacing, custom scrollbar design and an updated navigation.</li>
                        <li><span class="badge bg-dark">system</span> Upgraded various components.</li>
                        <li><span class="badge bg-danger">removed</span> Temporarily removed Patron list from About.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
