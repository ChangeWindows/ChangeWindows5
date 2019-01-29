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
<div class="row row-gutter">
    @foreach ($set as $group => $content)
        <div class="col-12 ring-milestones">
            <a href="{{ route('showMilestone', ['id' => $content['milestone']->id]) }}" class="h3" style="color: #{{ $content['milestone']->color }}">
                <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $content['milestone']->osname }}</span> <span class="font-weight-normal">version {{ $content['milestone']->version }}</span> <small>{{ $content['milestone']->codename }}{!! $content['milestone']->name !== '' ? ' &middot; '.$content['milestone']->name : '' !!}</small>
            </a>
        </div>
        @foreach ($content['flights'] as $ring => $flight)
            @if ($flight)
                <div class="col-xl col-md-3 col-sm-4 col-6"><?php getTile( $flight ) ?></div>
            @else
                <div class="col-xl d-none d-xl-block"></div>
            @endif
        @endforeach
    @endforeach
</div>
@endsection