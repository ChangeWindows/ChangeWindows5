@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2><i class="fab fa-windows"></i> {{ $milestone->osname }} {{ $milestone->name }}<small>version {{ $milestone->version }}</small></h2>
        <p class="lead">{{ $milestone->description }}</p>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('milestones/'.$milestone->id) }}">
                    Overview
                </a>
            </li>
            @foreach ($platforms as $platform)
                <li class="nav-item">
                    <a class="nav-link {{ $platform_id == $platform->platform ? 'active' : '' }}" href="{{ URL::to('milestones/'.$milestone->id.'/'.$platform->platform) }}">
                        {{ getPlatformById($platform->platform) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-6">
        @if ($previous)
            <a href="{{ URL::to('milestones/'.$previous->id) }}" class="milestone-navigation" style="background-color: #{{ $previous->color }}">
                <i class="fal fa-fw fa-angle-double-left"></i> <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $previous->osname }}</span> {{ $previous->name }}
            </a>
        @endif
    </div>
    <div class="col-6">
        @if ($next)
            <a href="{{ URL::to('milestones/'.$next->id) }}" class="milestone-navigation" style="background-color: #{{ $next->color }}">
                <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $next->osname }}</span> {{ $next->name }} <i class="fal fa-fw fa-angle-double-right"></i>
            </a>
        @endif
    </div>
    <div class="spacing-10"></div>
    <div class="col">
        <div class="timeline">
            @foreach ($timeline as $build => $rings)
                <div class="timeline-row">
                    <a class="row" href="{{ URL::to('build/'.$build.'/'.$platform_id) }}">
                        <div class="col-6 col-md-2 build"><img src="{{ asset('img/platform/'.getPlatformImage($platform_id)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform_id) }}" />{{ $build }}</div>
                        @foreach ($rings as $ring_id => $date)
                            <div class="col-6 col-md-2 ring">
                                <span class="label {{ getRingClassById($ring_id) }}">{{ $date }}</span>
                            </div>
                        @endforeach
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection