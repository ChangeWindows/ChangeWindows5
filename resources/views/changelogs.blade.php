@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Changelogs</a></li>
                @if ($platform)
                    <li class="breadcrumb-item"><a href="#">{{ $platform }}</a></li>
                @endif
                @if ($build)
                    <li class="breadcrumb-item"><a href="#">{{ $build }}</a></li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="col-3">
        <a class="btn btn-primary btn-block" href="{{ route('createChangelogs') }}"><i class="fal fa-fw fa-plus"></i> Add changelog</a>
        <div class="list-group">
            <a href="{{ URL::to('changelog/1') }}" class="list-group-item {{ $platform == '1' ? 'active' : ''}}">PC</a>
            <a href="{{ URL::to('changelog/2') }}" class="list-group-item {{ $platform == '2' ? 'active' : ''}}">Mobile</a>
            <a href="{{ URL::to('changelog/3') }}" class="list-group-item {{ $platform == '3' ? 'active' : ''}}">Xbox</a>
            <a href="{{ URL::to('changelog/4') }}" class="list-group-item {{ $platform == '4' ? 'active' : ''}}">Server</a>
            <a href="{{ URL::to('changelog/5') }}" class="list-group-item {{ $platform == '5' ? 'active' : ''}}">Holographic</a>
            <a href="{{ URL::to('changelog/6') }}" class="list-group-item {{ $platform == '6' ? 'active' : ''}}">IoT</a>
            <a href="{{ URL::to('changelog/7') }}" class="list-group-item {{ $platform == '7' ? 'active' : ''}}">Team</a>
            <a href="{{ URL::to('changelog/8') }}" class="list-group-item {{ $platform == '8' ? 'active' : ''}}">ISO</a>
            <a href="{{ URL::to('changelog/9') }}" class="list-group-item {{ $platform == '9' ? 'active' : ''}}">SDK</a>
        </div>
    </div>
    <div class="col-9">
        @foreach ($changelogs as $changelog)
            <p>{{ $changelog->build }}.{{ $changelog->delta }} {{ $changelog->platform }}</p>
        @endforeach
        
        {{ $changelogs->links() }}
    </div>
</div>
@endsection