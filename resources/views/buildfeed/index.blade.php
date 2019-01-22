@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fal fa-rss"></i> BuildFeed data</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('buildfeed') }}">
                    BuildFeed
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('aboutBuildfeed') }}">
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
            <a href="{{ route('showBuildfeed', ['id' => $build->id]) }}" class="bf">
                <span class="bf-header">{{ $build->major }}.{{ $build->minor }}.{{ $build->build }}.{{ $build->revision }}</span>
                <span class="bf-body">
                    <i class="fal fa-fw fa-clock"></i> {{ $build->buildtime }}
                    <br />
                    <i class="fal fa-fw fa-flask"></i> {{ $build->lab }}
                </span>
            </a>
        </div>
    @endforeach
    <div class="col-12">{{ $builds->links() }}</div>
</div>
@endsection

@section('modals')

@endsection