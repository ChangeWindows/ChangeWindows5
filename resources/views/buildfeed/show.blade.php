@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2 class="mb-4"><i class="fal fa-rss"></i> BuildFeed data</h2>
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
    <div class="col-12 build-title">
        <h2>{{ $build->buildstring }}</h2>
        <h5>{!! getFamily($build->family) !!}</h5>
    </div>
    <div class="col-3 build-detail">
        <p>Major</p>
        <h4>{{ $build->major }}</h4>
    </div>
    <div class="col-3 build-detail">
        <p>Minor</p>
        <h4>{{ $build->minor }}</h4>
    </div>
    <div class="col-3 build-detail">
        <p>Build</p>
        <h4>{{ $build->build }}</h4>
    </div>
    <div class="col-3 build-detail">
        <p>Revision</p>
        <h4>{{ $build->revision }}</h4>
    </div>
    <div class="col-3 build-detail">
        <p>Lab</p>
        <h4>{{ $build->lab }}</h4>
    </div>
    <div class="col-3 build-detail">
        <p>Buildtime</p>
        <h4>{{ $build->buildtime }}</h4>
    </div>
    <div class="col-3 build-detail">
        <p>Source</p>
        <h4>{{ getSource($build->sourcetype) }}</h4>
    </div>
    <div class="col-3 build-detail">
        <p>Leak date</p>
        <h4>{{ $build->leakdate }}</h4>
    </div>
    <div class="col-12 build-detail">
        <p>Details</p>
        <h4>{!! $build->sourcedetails !!}</h4>
    </div>
    <div class="col-12 build-detail">
        <p>Alternative build string</p>
        <h4>{{ $build->alternatebuildstring }}</h4>
    </div>
</div>
@endsection

@section('modals')

@endsection