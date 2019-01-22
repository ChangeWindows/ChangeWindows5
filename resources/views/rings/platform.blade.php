@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2>Rings</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link {{ Request::is('rings') ? 'active' : '' }}" href="{{ URL::to('rings') }}">Overview</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/1') ? 'active' : '' }}" href="{{ URL::to('rings/1') }}">PC</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/3') ? 'active' : '' }}" href="{{ URL::to('rings/3') }}">Xbox</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/6') ? 'active' : '' }}" href="{{ URL::to('rings/6') }}">IoT</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/4') ? 'active' : '' }}" href="{{ URL::to('rings/4') }}">Server</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/5') ? 'active' : '' }}" href="{{ URL::to('rings/5') }}">Holographic</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/7') ? 'active' : '' }}" href="{{ URL::to('rings/7') }}">Team</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/2') ? 'active' : '' }}" href="{{ URL::to('rings/2') }}">Mobile</a></li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    @foreach ($milestones as $milestone)
        <div class="col-12">
            <a href="{{ URL::to('milestones/'.$milestone->id) }}" class="h3" style="color: #{{ $milestone->color }}">
                <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $milestone->osname }}</span> <span class="font-weight-regular">{{ $milestone->name }}</span> <small>version {{ $milestone->version }}</small>
            </a>
        </div>
    @endforeach
</div>
@endsection