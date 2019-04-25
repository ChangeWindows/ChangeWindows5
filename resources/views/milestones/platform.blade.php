@extends('layouts.app')
@section('title') {{ $milestone->codename }} &middot; Milestones @endsection

@section('toolset')
<a class="dropdown-item" href="{{ route('editMilestone', ['id' => $milestone->id]) }}"><i class="fal fa-fw fa-pencil"></i> Edit milestone</a>
<form method="POST" action="{{ route('destroyMilestone', ['id' => $milestone->id]) }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <button type="submit" class="dropdown-item"><i class="fal fa-fw fa-trash-alt"></i> Delete milestone</button>
</form>
<div class="dropdown-divider"></div>
@endsection

@section('hero')
<div class="jumbotron tabs build-header">
    <div class="container">
        <h2><i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} <span class="font-weight-normal">version {{ $milestone->version }}</span></h2>
        <h6>{{ $milestone->codename }}{!! $milestone->name !== '' ? ' &middot; '.$milestone->name : '' !!}</h6>
        <p class="lead">{{ $milestone->description }}</p>
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
                <i class="fal fa-fw fa-angle-double-left"></i>
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
                <i class="fal fa-fw fa-angle-double-right d-none d-sm-inline d-lg-none"></i>
                <span class="d-none d-sm-inline d-lg-none"><br /></span> version {{ $next->version }}
                <i class="fal fa-fw fa-angle-double-right d-inline d-sm-none d-lg-inline"></i>
            </a>
        @endif
    </div>
    <div class="spacing-10"></div>
    <div class="col">
        <div class="timeline">
            @foreach ($timeline as $build => $rings)
                <div class="timeline-row">
                    <a class="row" href="{{ route('showBuild', ['milestone' => $milestone->id, 'build' => explode('.', $build)[0], 'platform' => getPlatformClass($platform_id)]) }}">
                        <div class="col-4 col-sm-3 col-md-2 build"><img src="{{ asset('img/platform/'.getPlatformImage($platform_id)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform_id) }}" />{{ $build }}</div>
                        <div class="col-8 col-sm-9 col-md-10 d-lg-none">
                            @php
                                $first = false;
                            @endphp
                            @foreach ($rings as $ring => $release)
                                @if ($first)
                                    <i class="fal fa-fw fa-angle-right"></i>
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
</div>
@endsection