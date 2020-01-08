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
    <div class="col-12 my-3">
        <nav class="nav" id="milestonePlatform" role="tablist">
            <a class="nav-link @if ($changelog) active @endif" id="changelog-tab" data-toggle="tab" href="#changelog" role="tab" aria-controls="changelog" aria-selected="true"><i class="far fa-fw fa-align-left"></i> Changelog</a>
            <a class="nav-link @if (!$changelog) active @endif" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false"><i class="far fa-fw fa-plane"></i> Flights</a>
            <a class="nav-link @if (!$changelog) active @endif" id="dev-tab" data-toggle="tab" href="#dev" role="tab" aria-controls="dev" aria-selected="false"><i class="far fa-fw fa-flask"></i> Lab</a>
        </nav>
    </div>
    <div class="col-12">
        <div class="tab-content" id="milestonePlatformContent">
            <div class="tab-pane fade @if ($changelog) show active @endif" id="changelog" role="tabpanel" aria-labelledby="changelog-tab">
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
            <div class="tab-pane fade @if (!$changelog) show active @endif" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                <div class="timeline">
                    @foreach ($timeline as $build => $rings)
                        <div class="timeline-row">
                            <a class="row" href="{{ route('showRelease', ['build' => explode('.', $build)[0], 'platform' => getPlatformClass($platform_id)]) }}">
                                <div class="col-4 col-sm-3 col-md-2 build"><span class="pr-1">{!! getPlatformIcon($platform_id) !!}</span> {{ $build }}</div>
                                <div class="col-8 col-sm-9 col-md-10 d-lg-none">
                                    @php
                                        $first = false;
                                    @endphp
                                    @foreach ($rings as $ring => $release)
                                        @if ($first)
                                            <i class="far fa-fw fa-angle-right"></i>
                                        @endif
                                        <span class="label {{ getRingClassById($ring) }}">{{ $release }}</span>
                                        @if (!$first)
                                            @php
                                                $first = true;
                                            @endphp
                                        @endif
                                    @endforeach
                                </div>
                                @if (in_array($platform_id, [1, 3]))
                                <div class="{{ array_key_exists('1', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label skip">{{ array_key_exists('1', $rings) ? $rings['1'] : '' }}</span>
                                </div>
                                @endif
                                @if (in_array($platform_id, [1, 2, 3, 5]))
                                <div class="{{ array_key_exists('2', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label fast">{{ array_key_exists('2', $rings) ? $rings['2'] : '' }}</span>
                                </div>
                                @endif
                                @if (in_array($platform_id, [1, 2, 3, 4, 5, 6, 7]))
                                <div class="{{ array_key_exists('3', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label slow">{{ array_key_exists('3', $rings) ? $rings['3'] : '' }}</span>
                                </div>
                                @endif
                                @if (in_array($platform_id, [3]))
                                <div class="{{ array_key_exists('4', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label preview">{{ array_key_exists('4', $rings) ? $rings['4'] : '' }}</span>
                                </div>
                                @endif
                                @if (in_array($platform_id, [1, 2, 3]))
                                <div class="{{ array_key_exists('5', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label release">{{ array_key_exists('5', $rings) ? $rings['5'] : '' }}</span>
                                </div>
                                @endif
                                <div class="{{ array_key_exists('6', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label targeted">{{ array_key_exists('6', $rings) ? $rings['6'] : '' }}</span>
                                </div>
                                @if (in_array($platform_id, [1, 2, 5, 6, 7]))
                                <div class="{{ array_key_exists('7', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label broad">{{ array_key_exists('7', $rings) ? $rings['7'] : '' }}</span>
                                </div>
                                @endif
                                @if (in_array($platform_id, [1, 4, 5]))
                                <div class="{{ array_key_exists('8', $rings) ? 'col-4 d-none d-lg-block' : 'd-none d-lg-block' }} col-lg ring">
                                    <span class="label ltsc">{{ array_key_exists('8', $rings) ? $rings['8'] : '' }}</span>
                                </div>
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="tab-pane fade" id="dev" role="tabpanel" aria-labelledby="dev-tab">
                <div class="row">
                    <div class="col-6">
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
                    <div class="col-6">
                        <div class="timeline">
                            @foreach ($timeline as $build => $rings)
                                <div class="timeline-row">
                                    <a class="row" href="{{ route('showRelease', ['build' => explode('.', $build)[0], 'platform' => getPlatformClass($platform_id)]) }}">
                                        <div class="col-4 col-sm-3 build"><span class="pr-1">{!! getPlatformIcon($platform_id) !!}</span> {{ $build }}</div>
                                        <div class="col-8 col-sm-9">
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
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
