@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('updateChangelogs', $changelog->id) }}" class="row">
    {{ method_field('PATCH') }}
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('showChangelogs') }}">Changelogs</a></li>
                <li class="breadcrumb-item"><a href="{{ route('showChangelogs', $changelog->platform) }}">{{ $changelog->device }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('showChangelogs', [$changelog->platform, $changelog->build]) }}">{{ $changelog->build }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('editChangelog', [$changelog->id]) }}">{{ $changelog->delta }}</a></li>
            </ol>
        </nav>
    </div>
    <div class="col-2">
        <a class="btn btn-primary btn-block" href="{{ route('createChangelogs') }}"><i class="fal fa-fw fa-plus"></i> Add changelog</a>
        <div class="list-group mt-3">
            <a href="{{ URL::to('changelog/1') }}" class="list-group-item {{ $changelog->platform == '1' ? 'active' : ''}}">PC</a>
            <a href="{{ URL::to('changelog/2') }}" class="list-group-item {{ $changelog->platform == '2' ? 'active' : ''}}">Mobile</a>
            <a href="{{ URL::to('changelog/3') }}" class="list-group-item {{ $changelog->platform == '3' ? 'active' : ''}}">Xbox</a>
            <a href="{{ URL::to('changelog/4') }}" class="list-group-item {{ $changelog->platform == '4' ? 'active' : ''}}">Server</a>
            <a href="{{ URL::to('changelog/5') }}" class="list-group-item {{ $changelog->platform == '5' ? 'active' : ''}}">Holographic</a>
            <a href="{{ URL::to('changelog/6') }}" class="list-group-item {{ $changelog->platform == '6' ? 'active' : ''}}">IoT</a>
            <a href="{{ URL::to('changelog/7') }}" class="list-group-item {{ $changelog->platform == '7' ? 'active' : ''}}">Team</a>
            <a href="{{ URL::to('changelog/8') }}" class="list-group-item {{ $changelog->platform == '8' ? 'active' : ''}}">ISO</a>
            <a href="{{ URL::to('changelog/9') }}" class="list-group-item {{ $changelog->platform == '9' ? 'active' : ''}}">SDK</a>
        </div>
    </div>
    <div class="col-10">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="platform">Platform</label>
                    <select class="form-control" id="platform" name="platform" aria-describedby="platform" value="{{ $changelog->platform }}">
                        <option value="1">PC</option>
                        <option value="2">Mobile</option>
                        <option value="3">Xbox</option>
                        <option value="4">Server</option>
                        <option value="5">Holographic</option>
                        <option value="6">IoT</option>
                        <option value="7">Team</option>
                        <option value="8">ISO</option>
                        <option value="8">SDK</option>
                    </select>
                </div>
            </div>
            <div class="col-9">
                <div class="form-group">
                    <label for="build_string">String</label>
                    <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string" value="{{ $changelog->build }}.{{ $changelog->delta }}">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="changelog">Changelog</label>
                    <textarea class="form-control text-monospace" id="changelog" name="changelog" aria-describedby="changelog" placeholder="Changelog" rows="30">{{ $changelog->changelog }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-check"></i> Save</button>
            </div>
        </div>
    </div>
</form>
@endsection