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
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link {{ Request::is('vnext') || Request::is('vnext/1') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 1]) }}">PC</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('vnext/3') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 3]) }}">Xbox</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('vnext/6') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 6]) }}">IoT</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('vnext/4') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 4]) }}">Server</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('vnext/5') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 5]) }}">Holographic</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('vnext/7') ? 'active' : '' }}" href="{{ route('showVNext', ['platform' => 7]) }}">Team</a></li>
        </ul>
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