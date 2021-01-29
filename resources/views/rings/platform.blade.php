@extends('layouts.app')
@section('title') Channels @endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="pt-2 mb-2">Channels</h2>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link {{ Request::is('channels') ? 'active' : '' }}" href="{{ route('channels') }}">Overview</a>
                <a class="nav-link {{ Request::is('channels/pc') ? 'active' : '' }}" href="{{ route('platformChannels', ['platform' => 'pc']) }}">PC</a>
                <a class="nav-link {{ Request::is('channels/xbox') ? 'active' : '' }}" href="{{ route('platformChannels', ['platform' => 'xbox']) }}">Xbox</a>
                <a class="nav-link {{ Request::is('channels/server') ? 'active' : '' }}" href="{{ route('platformChannels', ['platform' => 'server']) }}">Server</a>
                <a class="nav-link {{ Request::is('channels/tenx') ? 'active' : '' }}" href="{{ route('platformChannels', ['platform' => 'tenx']) }}">10X</a>
                <a class="nav-link {{ Request::is('channels/holographic') ? 'active' : '' }}" href="{{ route('platformChannels', ['platform' => 'holographic']) }}">Holographic</a>
                <a class="nav-link {{ Request::is('channels/team') ? 'active' : '' }}" href="{{ route('platformChannels', ['platform' => 'team']) }}">Team</a>
                <a class="nav-link {{ Request::is('channels/iot') ? 'active' : '' }}" href="{{ route('platformChannels', ['platform' => 'iot']) }}">IoT</a>
            </nav>
        </div>
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
                <div class="col-xl col-md-3 col-sm-4 col-6">
                    <?php getChannelTile($flight['flight'], $flight['channel']) ?>
                </div>
            @else
                <div class="col-xl d-none d-xl-block"></div>
            @endif
        @endforeach
    @endforeach
</div>
@endsection
