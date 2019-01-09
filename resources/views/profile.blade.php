@extends('layouts.app')

@section('hero')
<div class="profile-header">
    <span class="display-1"><i class="fal fa-fw fa-user-circle"></i></span>
    <h1>Hi <span class="font-bold">{{ Auth::user()->name }}</span></h1>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-9">
        <h2>Settings</h2>
        <p>There are currently no settings available.</p>
        @if (Auth::user()->hasAnyRole(['Admin', 'Insider']))
            <h2>Insider features</h2>
            <p>There are currently no Insider features available. Check back soon!</p>
        @endif
    </div>
    <div class="col-3">
        <h2>Details</h2>
        <p>
            <b>Name</b>: {{ Auth::user()->name }}<br />
            <b>Email</b>: {{ Auth::user()->email }}<br />
            <b>Role</b>: {{ Auth::user()->getRoles()->name }}
        </p>
    </div>
</div>
@endsection