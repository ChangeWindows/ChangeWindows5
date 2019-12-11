@extends('layouts.app')
@section('title') Edit &middot; {{ $changelog->build }}.{{ $changelog->delta }} @endsection

@section('scripts')
<script>
var simplemde = new SimpleMDE({ element: document.getElementById("changelog") });
</script>
@endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>
            Changelogs
            <small>
                <a href="{{ route('showChangelogs') }}">Changelogs</a>
                <i class="far fa-fw fa-angle-right"></i>
                <a href="{{ route('showChangelogs', $changelog->platform) }}">{{ getPlatformById($changelog->platform) }}</a>
                <i class="far fa-fw fa-angle-right"></i>
                <a href="{{ route('showChangelogs', [$changelog->platform, $changelog->build]) }}">{{ $changelog->build }}</a>
                <i class="far fa-fw fa-angle-right"></i>
                <a href="{{ route('editChangelog', [$changelog->id]) }}">{{ $changelog->delta }}</a>
            </small>
        </h2>
    </div>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('updateChangelogs', $changelog->id) }}" class="row">
    {{ method_field('PATCH') }}
    <div class="col-2">
        <a class="btn btn-primary btn-block" href="{{ route('createChangelog') }}"><i class="far fa-fw fa-plus"></i> Add changelog</a>
        <div class="list-group list-group-platforms mt-3">
            <a href="{{ route('showChangelogs') }}" class="list-group-item {{ $changelog->platform == null ? 'active' : ''}}">All</a>
            <a href="{{ route('showChangelogs', ['platform' => 0]) }}" class="list-group-item {{ $changelog->platform == '0' ? 'active' : ''}}">Generic</a>
            <a href="{{ route('showChangelogs', ['platform' => 1]) }}" class="list-group-item {{ $changelog->platform == '1' ? 'active' : ''}}">PC</a>
            <a href="{{ route('showChangelogs', ['platform' => 2]) }}" class="list-group-item {{ $changelog->platform == '2' ? 'active' : ''}}">Mobile</a>
            <a href="{{ route('showChangelogs', ['platform' => 3]) }}" class="list-group-item {{ $changelog->platform == '3' ? 'active' : ''}}">Xbox</a>
            <a href="{{ route('showChangelogs', ['platform' => 4]) }}" class="list-group-item {{ $changelog->platform == '4' ? 'active' : ''}}">Server</a>
            <a href="{{ route('showChangelogs', ['platform' => 5]) }}" class="list-group-item {{ $changelog->platform == '5' ? 'active' : ''}}">Holographic</a>
            <a href="{{ route('showChangelogs', ['platform' => 6]) }}" class="list-group-item {{ $changelog->platform == '6' ? 'active' : ''}}">IoT</a>
            <a href="{{ route('showChangelogs', ['platform' => 7]) }}" class="list-group-item {{ $changelog->platform == '7' ? 'active' : ''}}">Team</a>
            <a href="{{ route('showChangelogs', ['platform' => 8]) }}" class="list-group-item {{ $changelog->platform == '8' ? 'active' : ''}}">ISO</a>
            <a href="{{ route('showChangelogs', ['platform' => 9]) }}" class="list-group-item {{ $changelog->platform == '9' ? 'active' : ''}}">SDK</a>
        </div>
    </div>
    <div class="col-10">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <select class="form-control" id="platform" name="platform" aria-describedby="platform">
                        <option value="0" {{ $changelog->platform == 0 ? 'selected' : ''}}>Generic</option>
                        <option value="1" {{ $changelog->platform == 1 ? 'selected' : ''}}>PC</option>
                        <option value="2" {{ $changelog->platform == 2 ? 'selected' : ''}}>Mobile</option>
                        <option value="3" {{ $changelog->platform == 3 ? 'selected' : ''}}>Xbox</option>
                        <option value="4" {{ $changelog->platform == 4 ? 'selected' : ''}}>Server</option>
                        <option value="5" {{ $changelog->platform == 5 ? 'selected' : ''}}>Holographic</option>
                        <option value="6" {{ $changelog->platform == 6 ? 'selected' : ''}}>IoT</option>
                        <option value="7" {{ $changelog->platform == 7 ? 'selected' : ''}}>Team</option>
                        <option value="8" {{ $changelog->platform == 8 ? 'selected' : ''}}>ISO</option>
                        <option value="9" {{ $changelog->platform == 9 ? 'selected' : ''}}>SDK</option>
                    </select>
                </div>
            </div>
            <div class="col-7">
                <div class="form-group">
                    <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string" value="{{ $changelog->build }}.{{ $changelog->delta }}">
                </div>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block"><i class="far fa-fw fa-check"></i> Save</button>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control text-monospace" id="changelog" name="changelog" aria-describedby="changelog" placeholder="Changelog" rows="30">{{ $changelog->changelog }}</textarea>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
