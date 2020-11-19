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
                <a class="nav-link" href="{{ route('admin.milestones.edit', $milestone) }}">
                    <i class="far fa-fw fa-pencil"></i>
                </a>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-3">
    <div class="col-lg-9 col-md-8 col-12">
        @if ($changelog)
            <div class="changelog">
                <div class="changelog-content">
                    {!! $parsedown->text($changelog->changelog) !!}
                </div>
            </div>
        @else
            @can('create_log')
                <h4>No changelog yet, create one...</h4>
                <a href="{{ route('admin.changelogs', ['milestone' => $milestone->id, 'platform' => $platform_id]) }}" class="btn btn-primary"><i class="far fa-fw fa-pencil"></i> Write a changelog</a>
            @else
                <h4>No changelog available just yet</h4>
                <p>This means that this is or a very recent milestone or we just didn't yet get around writing it. Stay tuned, we're working on it.</p>
            @endcan
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
