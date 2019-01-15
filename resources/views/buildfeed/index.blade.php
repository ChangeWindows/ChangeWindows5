@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fal fa-fw fa-rss"></i> BuildFeed data</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ URL::to('buildfeed') }}">
                    Buildfeed
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('buildfeed/about') }}">
                    About
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        @foreach ($builds as $build)
            <p>{{ $build->buildstring }}</p>
        @endforeach
        {{ $builds->links() }}
    </div>
</div>
@endsection

@section('modals')

@endsection