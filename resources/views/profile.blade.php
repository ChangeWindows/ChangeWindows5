@extends('layouts.app')

@section('hero')
<div class="profile-header">
    <span class="display-1"><i class="fal fa-fw fa-user-circle"></i></span>
    <h1>Hi <span class="font-bold">{{ Auth::user()->name }}</span></h1>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h2>Details</h2>
        <p><b>Name</b>: {{ Auth::user()->name }}</p>
        <p><b>Email</b>: {{ Auth::user()->email }}</p>
        <p><b>Role</b>: {{ Auth::user()->getRoles()->name }}</p>
    </div>
</div>
@endsection