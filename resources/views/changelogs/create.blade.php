@extends('layouts.app')
@section('title') New changelog @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>
            Changelogs
            <small>
                <a href="{{ route('showChangelogs') }}">Changelogs</a>
                <i class="fal fa-fw fa-angle-right"></i>
                <span class="text">New changelog</span>
            </small>
        </h2>
    </div>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('storeChangelogs') }}" class="row row-p-10">
    {{ csrf_field() }}
    <div class="col-3">
        <div class="form-group">
            <label for="platform">Platform</label>
            <select class="form-control" id="platform" name="platform" aria-describedby="platform">
                <option value="0" {{ getPlatformIdByClass(request()->platform) == 0 ? 'selected' : ''}}>Generic</option>
                <option value="1" {{ getPlatformIdByClass(request()->platform) == 1 ? 'selected' : ''}}>PC</option>
                <option value="2" {{ getPlatformIdByClass(request()->platform) == 2 ? 'selected' : ''}}>Mobile</option>
                <option value="3" {{ getPlatformIdByClass(request()->platform) == 3 ? 'selected' : ''}}>Xbox</option>
                <option value="4" {{ getPlatformIdByClass(request()->platform) == 4 ? 'selected' : ''}}>Server</option>
                <option value="5" {{ getPlatformIdByClass(request()->platform) == 5 ? 'selected' : ''}}>Holographic</option>
                <option value="6" {{ getPlatformIdByClass(request()->platform) == 6 ? 'selected' : ''}}>IoT</option>
                <option value="7" {{ getPlatformIdByClass(request()->platform) == 7 ? 'selected' : ''}}>Team</option>
                <option value="8" {{ getPlatformIdByClass(request()->platform) == 8 ? 'selected' : ''}}>ISO</option>
                <option value="9" {{ getPlatformIdByClass(request()->platform) == 9 ? 'selected' : ''}}>SDK</option>
            </select>
        </div>
    </div>
    <div class="col-9">
        <div class="form-group">
            <label for="build_string">String</label>
            <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string" value={{ request()->string }}>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="changelog">Changelog</label>
            <textarea class="form-control text-monospace" id="changelog" name="changelog" aria-describedby="changelog" placeholder="Changelog" rows="30"></textarea>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-plus"></i> Add</button>
    </div>
</form>
@endsection