@extends('layouts.app')
@section('title') vNExt @endsection

@section('toolset')
<a class="dropdown-item" href="{{ route('editVNext', ['platform_id' => $changelog->id]) }}"><i class="fal fa-fw fa-pencil"></i> Edit vNext</a>
<div class="dropdown-divider"></div>
@endsection

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fab fa-fw fa-windows"></i> vNext</h2>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link {{ Request::is('vnext') || Request::is('vnext/pc') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 1]) }}">PC</a>
                <a class="nav-link {{ Request::is('vnext/xbox') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 3]) }}">Xbox</a>
                <a class="nav-link {{ Request::is('vnext/iot') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 6]) }}">IoT</a>
                <a class="nav-link {{ Request::is('vnext/server') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 4]) }}">Server</a>
                <a class="nav-link {{ Request::is('vnext/holographic') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 5]) }}">Holographic</a>
                <a class="nav-link {{ Request::is('vnext/team') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 7]) }}">Team</a>
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

@section('modals')

@endsection