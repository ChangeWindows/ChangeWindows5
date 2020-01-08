@extends('layouts.app')
@section('title') New changelog @endsection

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
                <a href="{{ route('showLogs') }}">Changelogs</a>
                <i class="far fa-fw fa-angle-right"></i>
                <span class="text">New changelog</span>
            </small>
        </h2>
    </div>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('storeLogs') }}" class="row row-p-10">
    {{ csrf_field() }}
    <div class="col-3">
        <div class="form-group">
            <select class="form-control" id="platform" name="platform" aria-describedby="platform">
                <option value="1" {{ request()->platform == 1 ? 'selected' : ''}}>PC</option>
                <option value="2" {{ request()->platform == 2 ? 'selected' : ''}}>Mobile</option>
                <option value="3" {{ request()->platform == 3 ? 'selected' : ''}}>Xbox</option>
                <option value="4" {{ request()->platform == 4 ? 'selected' : ''}}>Server</option>
                <option value="5" {{ request()->platform == 5 ? 'selected' : ''}}>Holographic</option>
                <option value="6" {{ request()->platform == 6 ? 'selected' : ''}}>IoT</option>
                <option value="7" {{ request()->platform == 7 ? 'selected' : ''}}>Team</option>
                <option value="8" {{ request()->platform == 8 ? 'selected' : ''}}>ISO</option>
                <option value="9" {{ request()->platform == 9 ? 'selected' : ''}}>SDK</option>
            </select>
        </div>
    </div>
    <div class="col-8">
        <div class="form-group">
            <select class="form-control" id="milestone" name="milestone" aria-describedby="milestone">
                @foreach ($milestones as $milestone)
                    <option value="{{ $milestone->id }}" {{ request()->milestone == $milestone->id ? 'selected' : ''}}>{{ $milestone->osname }} version {{ $milestone->version }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-1">
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"><i class="far fa-fw fa-plus"></i> Add</button>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <textarea class="form-control text-monospace" id="changelog" name="changelog" aria-describedby="changelog" placeholder="Changelog" rows="30"></textarea>
        </div>
    </div>
</form>
@endsection
