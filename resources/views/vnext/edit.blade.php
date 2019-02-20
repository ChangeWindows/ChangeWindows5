@extends('layouts.app')
@section('title') vNext @endsection

@section('scripts')
<script>
var simplemde = new SimpleMDE({ element: document.getElementById("changelog") });
</script>
@endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>
            vNext
            <small>
                <a href="{{ route('showChangelogs') }}">vNext</a>
                <i class="fal fa-fw fa-angle-right"></i>
                <a href="{{ route('showVNext', $changelog->id) }}">{{ getPlatformById($changelog->id) }}</a>
            </small>
        </h2>
    </div>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('updateVNext', $changelog->id) }}" class="row">
    {{ method_field('PATCH') }}
    <div class="col-12">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-check"></i> Save</button>
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