@extends('layouts.buildfeed')
@section('title') {{ $build->build }}.{{ $build->revision}} &middot; BuildFeed @endsection

@section('content')
<div class="row buildfeed">
    <div class="col-12 build-title">
        <h2>{{ $build->buildstring }}</h2>
        <h5><a href="{{ route('buildfeed', ['family' => $build->family]) }}">{!! getFamily($build->family) !!}</a></h5>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
        <p>Major</p>
        <h4>{{ $build->major }}</h4>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
        <p>Minor</p>
        <h4>{{ $build->minor }}</h4>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
        <p>Build</p>
        <h4><a href="{{ route('buildfeed', ['build' => $build->build]) }}">{{ $build->build }}</a></h4>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
        <p>Revision</p>
        <h4>{{ $build->revision }}</h4>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
        <p>Lab</p>
        <h4><a href="{{ route('buildfeed', ['lab' => $build->lab]) }}">{{ $build->lab }}</a></h4>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
        <p>Buildtime</p>
        <h4>{{ $build->buildtime }}</h4>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
        <p>Source</p>
        <h4><a href="{{ route('buildfeed', ['sourcetype' => $build->sourcetype]) }}">{{ getSource($build->sourcetype) }}</a></h4>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 col-xs-12 build-detail">
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