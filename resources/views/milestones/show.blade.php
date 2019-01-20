@extends('layouts.app')

@section('hero')
<div class="jumbotron tabs">
    <div class="container">
        <h2><i class="fab fa-windows"></i> {{ $milestone->osname }} {{ $milestone->name }}<small>version {{ $milestone->version }}</small></h2>
        <p class="lead">{{ $milestone->description }}</p>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="{{ URL::to('milestones/'.$milestone->id) }}">
                    Overview
                </a>
            </li>
            @foreach ($platforms as $platform)
                <li class="nav-item">
                    <a class="nav-link" href="{{ URL::to('milestones/'.$milestone->id.'/'.$platform->platform) }}">
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
    @if ($previous)
        <div class="col-6">
            <a href="{{ URL::to('milestones/'.$previous->id) }}" class="milestone-navigation" style="background-color: #{{ $previous->color }}">
                <i class="fal fa-fw fa-angle-double-left"></i> <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $previous->osname }}</span> {{ $previous->name }}
            </a>
        </div>
    @endif
    @if ($next)
        <div class="col-6">
            <a href="{{ URL::to('milestones/'.$next->id) }}" class="milestone-navigation" style="background-color: #{{ $next->color }}">
                <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $next->osname }}</span> {{ $next->name }} <i class="fal fa-fw fa-angle-double-right"></i>
            </a>
        </div>
    @endif
    <div class="spacing-40"></div>
    @if ($milestone->preview->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Start Preview</h5>
            <h4>{{ $milestone->preview->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->public->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Public Release</h5>
            <h4>{{ $milestone->public->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->mainEol->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Main Support</h5>
            <h4>{{ $milestone->mainEol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->mainXol->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>Extended Support</h5>
            <h4>{{ $milestone->mainXol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($milestone->ltsEol->timestamp > 0)
        <div class="col text-center lifecycle-stats">
            <h5>LTSC Support</h5>
            <h4>{{ $milestone->ltsEol->toFormattedDateString() }}</h4>
        </div>
    @endif
    @if ($progress)
        <div class="col-12">
            <div class="progress">
                <div class="progress-bar bg-preview-done" style="width: {{ $progress['preview_done'] }}%"></div>
                <div class="progress-bar bg-preview-go" style="width: {{ $progress['preview_go'] }}%"></div>
                <div class="progress-bar bg-public-done" style="width: {{ $progress['public_done'] }}%"></div>
                <div class="progress-bar bg-public-go" style="width: {{ $progress['public_go'] }}%"></div>
                <div class="progress-bar bg-extended-done" style="width: {{ $progress['extended_done'] }}%"></div>
                <div class="progress-bar bg-extended-go" style="width: {{ $progress['extended_go'] }}%"></div>
                <div class="progress-bar bg-lts-done" style="width: {{ $progress['lts_done'] }}%"></div>
                <div class="progress-bar bg-lts-go" style="width: {{ $progress['lts_go'] }}%"></div>
            </div>
        </div>
    @endif
    <div class="spacing-40"></div>
    @foreach ($platforms as $platform)
        <div class="col-xl-4 col-lg-6 col-12 platform-card">
            <h4>{{ getPlatformById($platform->platform) }}</h4>
            <h6>{{ $platform->count }} builds</h6>
            
            <div class="timeline">
                @foreach ($platform->builds as $build)
                    <div class="timeline-row">
                        <a class="row" href="{{ URL::to('build/'.$build->build.'/'.$build->platform) }}">
                            <div class="col-5 build"><img src="{{ asset('img/platform/'.getPlatformImage($build->platform)) }}" class="img-platform img-jump" alt="{{ getPlatformById($build->platform) }}" />{{ $build->build }}.{{ $build->delta }}</div>
                            <div class="col-3 ring">
                                <span class="label {{ $build->class }}">{{ $build->flight }}</span>
                            </div>
                            <div class="col-4 date">
                                <span class="date">{{ $build->date->format('j M Y') }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="timeline-row">
                    <a class="row" href="{{ URL::to('milestones/'.$milestone->id.'/'.$platform->platform) }}">
                        <div class="col"><img src="{{ asset('img/platform/'.getPlatformImage($platform->platform)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform->platform) }}" /></div>
                        <div class="col text-right">
                            See all <i class="fal fa-fw fa-angle-double-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection