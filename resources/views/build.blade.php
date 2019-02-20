@extends('layouts.app')
@section('title') Build {{ $meta->build }} @endsection

@section('hero')
<div class="jumbotron tabs build-header">
    <div class="container">
        <h2><i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} <span class="font-weight-normal">version {{ $milestone->version }}</span></h2>
        <h6>{{ $meta->major }}.{{ $meta->minor }}.{{ $meta->build }} &middot; {{ $milestone->codename }}{!! $milestone->name !== '' ? ' &middot; '.$milestone->name : '' !!}</h6>
        <div class="nav-scroll">
            <nav class="nav">
                @foreach ($platforms as $platform)
                    <a class="nav-link {{ $platform->platform == $meta->platform ? 'active' : '' }}" href="{{ route('showRelease', ['build' => $cur_build, 'platform' => getPlatformClass($platform->platform)]) }}">
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
    <div class="col-lg-8">
        <div class="changelog">
            @foreach ($notes as $delta => $info)
                <h2 class="date-heading text-accent">{{ $meta->major }}.{{ $meta->minor }}.{{ $meta->build }}.{{ $delta }}</h2>
                <div class="date-box">
                    @php
                        $first = false;
                    @endphp
                    @foreach ($info['rings'] as $ring => $release)
                        @if ($first)
                            <i class="fal fa-fw fa-angle-right"></i>
                        @endif
                        <span class="label {{ getRingClassById($ring) }}">{{ $release->date->format('j M \'y') }}</span>
                        @if (!$first)
                            @php
                                $first = true;
                            @endphp
                        @endif
                    @endforeach
                </div>

                @if (array_key_exists('changelog', $info))
                    @if ($info['created'] > $info['new'])
                        <div class="alert alert-warning text-center">
                            <h4 class="alert-heading"><i class="fal fa-fw fa-exclamation-triangle"></i> This changelog is about a recently release build</h4>
                            This is a draft and will be updated regularly over the next couple of hours.
                        </div>
                    @endif
                    {!! $parsedown->text($info['changelog']) !!}
                @else
                    @if (Auth::user() && Auth::user()->hasAnyRole(['Admin']))
                        <h4>No changelog yet, create one...</h4>
                        <a href="{{ route('createChangelog', ['string' => $meta->build.'.'.$delta, 'platform' => getPlatformClass($meta->platform)]) }}" class="btn btn-sm btn-primary">{{ getPlatformById($meta->platform) }}</a>
                        <a href="{{ route('createChangelog', ['string' => $meta->build.'.'.$delta, 'platform' => 'generic']) }}" class="btn btn-sm btn-light">Generic</a>
                    @else
                        <h4>No changelog yet</h4>
                    @endif
                    @auth
                        @if (Auth::user()->hasAnyRole(['Admin']))
                        @endif
                    @endauth
                @endif
            @endforeach
        </div>
    </div>
    <div class="col-lg-4">
        <div class="timeline">
            @foreach ($timeline as $date => $builds)
                <div class="date-heading">{{ $date }}</div>
                <div></div>
                @foreach ($builds as $build => $deltas)
                    @foreach ($deltas as $delta => $platforms)
                        @foreach ($platforms as $platform => $rings)
                            @foreach ($rings as $ring)
                                <div class="timeline-row">
                                    <a class="row" href="{{ route('showRelease', $build, $platform) }}">
                                        <div class="col-6 build"><img src="{{ asset('img/platform/'.getPlatformImage($platform)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform) }}" />{{ $build }}.{{ $delta }}</div>
                                        <div class="col-6 ring">
                                            <span class="label {{ $ring->class }}">{{ $ring->flight }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('modals')

@endsection