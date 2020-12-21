@extends('layouts.app')
@section('title') Rings @endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="pt-2 mb-2">Rings</h2>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link {{ Request::is('rings') ? 'active' : '' }}" href="{{ route('rings') }}">Overview</a>
                <a class="nav-link {{ Request::is('rings/pc') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'pc']) }}">PC</a>
                <a class="nav-link {{ Request::is('rings/xbox') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'xbox']) }}">Xbox</a>
                <a class="nav-link {{ Request::is('rings/server') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'server']) }}">Server</a>
                <a class="nav-link {{ Request::is('rings/tenx') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'tenx']) }}">10X</a>
                <a class="nav-link {{ Request::is('rings/holographic') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'holographic']) }}">Holographic</a>
                <a class="nav-link {{ Request::is('rings/team') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'team']) }}">Team</a>
                <a class="nav-link {{ Request::is('rings/iot') ? 'active' : '' }}" href="{{ route('platformRings', ['platform' => 'iot']) }}">IoT</a>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-gutter">
    <div class="col">
        <h3 class="mt-4">We're working on it...</h3>
        <p>We can't show you this information right now. Not here at least. You can go to the ChangeWindows Preview and view it there.</p>
        <a href="https://viv.changewindows.org/channels" class="btn btn-primary"><i class="far fa-fw fa-arrow-right"></i> Channels (Preview)</a>
    </div>
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
