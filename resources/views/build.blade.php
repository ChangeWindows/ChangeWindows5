@extends('layouts.app')

@section('hero')
<ul class="nav nav-tabs">
    @foreach ($platforms as $platform)
        <li class="nav-item">
            <a class="nav-link {{ $platform->platform == $cur_platform ? 'active' : '' }}" href="{{ URL::to('build/'.$cur_build.'/'.$platform->platform) }}">
                {{ getPlatformById($platform->platform) }}
            </a>
        </li>
    @endforeach
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        @foreach ($changelogs as $changelog)
            {!! $parsedown->text($changelog->changelog) !!}
        @endforeach
    </div>
    <div class="col-lg-4">
        <div class="timeline">
            @foreach ($timeline as $date => $builds)
                <div class="date-heading">{{ $date }}</div>
                <div></div>
                @foreach ($builds as $build => $deltas)
                    @foreach ($deltas as $delta => $platforms)
                        @foreach ($platforms as $platform => $rings)
                            <div class="timeline-row">
                                <a class="row" href="{{ route('showRelease', $build, $platform) }}">
                                    <div class="col-6 col-md-4 build"><img src="{{ asset('img/platform/'.getPlatformImage($platform)) }}" class="img-platform img-jump" alt="{{ getPlatformById($platform) }}" />{{ $build }}.{{ $delta }}</div>
                                    <div class="col-6 col-md-8 ring">
                                        @foreach ($rings as $ring)
                                            <span class="label {{ $ring->class }}">{{ $ring->flight }}</span>
                                        @endforeach
                                    </div>
                                </a>
                            </div>
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