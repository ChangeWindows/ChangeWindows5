@extends('layouts.app')
@section('title') {{ $milestone->codename }} &middot; Milestones @endsection

@section('hero')
<div class="jumbotron tabs build-header">
    <div class="container">
        <h2 class="pt-2"><i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} <span class="font-weight-normal">version {{ $milestone->version }}</span></h2>
        <h6 class="mb-2">{{ $milestone->codename }}{!! $milestone->name !== '' ? ' &middot; '.$milestone->name : '' !!}</h6>
        <div class="nav-scroll">
            <nav class="nav">
                <a class="nav-link" href="{{ route('showMilestone', ['id' => $milestone->id]) }}">
                    Overview
                </a>
                @foreach ($platforms as $platform)
                    <a class="nav-link {{ $platform_id == $platform->platform ? 'active' : '' }}" href="{{ route('platformMilestone', ['id' => $milestone->id, 'platform' => getPlatformClass($platform->platform)]) }}">
                        {{ getPlatformById($platform->platform) }}
                    </a>
                @endforeach
                <div class="flex-grow-1"></div>
                <a class="nav-link" href="{{ route('editMilestone', ['id' => $milestone->id]) }}">
                    <i class="far fa-fw fa-pencil"></i>
                </a>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 previous-milestone">
        @if ($previous)
            <a href="{{ route('showMilestone', ['id' => $previous->id]) }}" class="milestone-navigation" style="background-color: #{{ $previous->color }}">
                <i class="far fa-fw fa-arrow-left"></i>
                <i class="fab fa-fw fa-windows"></i>
                <span class="font-weight-bold">{{ $previous->osname }}</span>
                <span class="d-none d-sm-inline d-lg-none"><br /></span> version {{ $previous->version }}
            </a>
        @endif
    </div>
    <div class="col-12 col-sm-6 next-milestone">
        @if ($next)
            <a href="{{ route('showMilestone', ['id' => $next->id]) }}" class="milestone-navigation" style="background-color: #{{ $next->color }}">
                <i class="fab fa-fw fa-windows"></i>
                <span class="font-weight-bold">{{ $next->osname }}</span>
                <i class="far fa-fw fa-arrow-right d-none d-sm-inline d-lg-none"></i>
                <span class="d-none d-sm-inline d-lg-none"><br /></span> version {{ $next->version }}
                <i class="far fa-fw fa-arrow-right d-inline d-sm-none d-lg-inline"></i>
            </a>
        @endif
    </div>
</div>
<div class="row mt-3">
    <div class="col-lg-9 col-md-8 col-12">
        @if ($changelog)
            <div class="changelog">
                <div class="changelog-content">
                    {!! $parsedown->text($changelog->changelog) !!}
                </div>
            </div>
        @else
            @if (Auth::user() && Auth::user()->hasAnyRole(['Admin']))
                <h4>No changelog yet, create one...</h4>
                <a href="{{ route('createLog', ['milestone' => $milestone->id, 'platform' => $platform_id]) }}" class="btn btn-primary"><i class="far fa-fw fa-pencil"></i> Write a changelog</a>
            @else
                <h4>No changelog yet</h4>
            @endif
        @endif
    </div>
    <div class="col-lg-3 col-md-4 col-12">
        <div class="timeline">
            @foreach ($timeline as $build => $rings)
                <div class="timeline-row">
                    <div class="row">
                        <div class="col-12">
                            <p class="h5 mb-0">{{ $build }}</p>
                            @php
                                $first = false;
                            @endphp
                            @foreach ($rings as $ring => $release)
                                @if ($first)
                                    <i class="far fa-angle-right mr-1"></i>
                                @endif
                                <span class="label mr-1 {{ getRingClassById($ring) }}">{{ $release }}</span>
                                @if (!$first)
                                    @php
                                        $first = true;
                                    @endphp
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
