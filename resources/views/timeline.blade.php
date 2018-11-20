@extends('layouts.app')

@section('hero')
<a class="hero" href="{{ route('viv') }}">
    <span class="text">
        <span class="h2">viv Preview</span>
        <span class="h5">The ChangeWindows 5 Preview is here, let us walk you through it</span>
    </span>
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="timeline">
            @foreach ($releases as $release)
                <div class="timeline-row">
                    <a class="row" href="#">
                        <div class="col-6 col-md-4 build"><img src="{{ asset('img/platform/'.$release->platform_img) }}" class="img-platform img-jump" alt="{{ $release->device }}" />{{ $release->build }}.{{ $release->delta }}</div>
                        <div class="col-6 col-md-8 ring">{{ $release->flight }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-5">
        @foreach ($flights as $key => $platform)
            <p class="h3">{{ $key }}</p>
            <div class="row min-gutter">
                @foreach ($platform as $flight)
                    <div class="col-4">
                        <div class="tile {{ $flight->class }}">
                            <span class="ring">{{ $flight->flight }}</span>
                            <span class="build">{{ $flight->build }}.{{ $flight->delta }}</span>
                            <span class="date">{{ $flight->format }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

{{ $releases->links() }}
@endsection