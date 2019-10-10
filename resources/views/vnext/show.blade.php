@extends('layouts.app')
@section('title') vNext @endsection

@section('toolset')
<a class="dropdown-item" href="{{ route('editVNext', ['platform_id' => $changelog->id]) }}"><i class="fad text-primary fa-fw fa-pencil"></i> Edit vNext</a>
<div class="dropdown-divider"></div>
@endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fab fa-fw fa-windows"></i> vNext</h2>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link {{ Request::is('vnext') || Request::is('vnext/pc') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 'pc']) }}">PC</a>
                <a class="nav-link {{ Request::is('vnext/xbox') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 'xbox']) }}">Xbox</a>
                <a class="nav-link {{ Request::is('vnext/iot') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 'iot']) }}">IoT</a>
                <a class="nav-link {{ Request::is('vnext/server') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 'server']) }}">Server</a>
                <a class="nav-link {{ Request::is('vnext/holographic') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 'holographic']) }}">Holographic</a>
                <a class="nav-link {{ Request::is('vnext/team') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 'team']) }}">Team</a>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="changelog">
            {!! $parsedown->text($changelog->changelog) !!}
        </div>
    </div>
</div>
@endsection
