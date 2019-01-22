@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2>Rings</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link {{ Request::is('rings') ? 'active' : '' }}" href="{{ route('rings') }}">Overview</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/1') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 1]) }}">PC</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/3') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 3]) }}">Xbox</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/6') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 6]) }}">IoT</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/4') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 4]) }}">Server</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/5') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 5]) }}">Holographic</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/7') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 7]) }}">Team</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('rings/2') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 2]) }}">Mobile</a></li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    @foreach ($milestones as $milestone)
        <div class="col-12">
            <a href="{{ route('showMilestone', ['id' => $milestone->id]) }}" class="h3" style="color: #{{ $milestone->color }}">
                <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $milestone->osname }}</span> <span class="font-weight-regular">{{ $milestone->name }}</span> <small>version {{ $milestone->version }}</small>
            </a>
        </div>
    @endforeach
</div>
@endsection