@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fal fa-fw fa-rss"></i> BuildFeed data</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ URL::to('buildfeed') }}">
                    BuildFeed
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
<div class="row buildfeed">
    @foreach ($builds as $build)
        <div class="col-6 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header">{{ $build->major }}.{{ $build->minor }}.{{ $build->build }}.{{ $build->revision }}</div>
                <div class="card-body">
                    <i class="fal fa-fw fa-clock"></i> {{ $build->buildtime }}
                </div>
            </div>
        </div>
    @endforeach
    <div class="col-12">{{ $builds->links() }}</div>
</div>
@endsection

@section('modals')

@endsection