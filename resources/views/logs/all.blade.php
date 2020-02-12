@extends('layouts.app')
@section('title') Changelogs @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>
            Changelogs
            <small>
                <a href="{{ route('showLogs') }}">Changelogs</a>
                @if ($platform)
                    <i class="far fa-fw fa-angle-right"></i>
                    <a href="{{ route('showLogs', $platform) }}">{{ getPlatformById($platform) }}</a>
                @endif
            </small>
        </h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-2">
        <a class="btn btn-primary btn-block" href="{{ route('createLog') }}"><i class="far fa-fw fa-plus"></i> Add changelog</a>
        <div class="list-group list-group-platforms mt-3">
            <a href="{{ route('showLogs') }}" class="list-group-item {{ $platform == null ? 'active' : ''}}">All</a>
            <a href="{{ route('showLogs', ['platform' => 1]) }}" class="list-group-item {{ $platform == '1' ? 'active' : ''}}">PC</a>
            <a href="{{ route('showLogs', ['platform' => 2]) }}" class="list-group-item {{ $platform == '2' ? 'active' : ''}}">Mobile</a>
            <a href="{{ route('showLogs', ['platform' => 3]) }}" class="list-group-item {{ $platform == '3' ? 'active' : ''}}">Xbox</a>
            <a href="{{ route('showLogs', ['platform' => 4]) }}" class="list-group-item {{ $platform == '4' ? 'active' : ''}}">Server</a>
            <a href="{{ route('showLogs', ['platform' => 10]) }}" class="list-group-item {{ $platform == '10' ? 'active' : ''}}">10X</a>
            <a href="{{ route('showLogs', ['platform' => 5]) }}" class="list-group-item {{ $platform == '5' ? 'active' : ''}}">Holographic</a>
            <a href="{{ route('showLogs', ['platform' => 6]) }}" class="list-group-item {{ $platform == '6' ? 'active' : ''}}">IoT</a>
            <a href="{{ route('showLogs', ['platform' => 7]) }}" class="list-group-item {{ $platform == '7' ? 'active' : ''}}">Team</a>
            <a href="{{ route('showLogs', ['platform' => 8]) }}" class="list-group-item {{ $platform == '8' ? 'active' : ''}}">ISO</a>
            <a href="{{ route('showLogs', ['platform' => 9]) }}" class="list-group-item {{ $platform == '9' ? 'active' : ''}}">SDK</a>
        </div>
    </div>
    <div class="col-10">
        <div class="list-group list-group-changelogs">
            @foreach ($changelogs as $changelog)
                <a href="{{ route('editLog', [$changelog->id]) }}" class="list-group-item">
                    <div class="img">{!! getPlatformIcon($changelog->platform) !!}</div>
                    <div class="data">
                        {{ $changelog->milestone->osname }} version {{ $changelog->milestone->version }} &middot; {{ getPlatformById($changelog->platform) }}
                        <br />
                        <small>Updated: {{ Carbon\Carbon::parse($changelog->updated_at)->format('d F Y H:i:s') }}</small>
                    </div>
                </a>
            @endforeach
        </div>

        {{ $changelogs->links() }}
    </div>
</div>
@endsection
