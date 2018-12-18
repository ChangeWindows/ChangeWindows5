@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('storeChangelogs') }}" class="row row-p-10">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('showChangelogs') }}">Changelogs</a></li>
                <li class="breadcrumb-item">New changelog</li>
            </ol>
        </nav>
    </div>
    {{ csrf_field() }}
    <div class="col-3">
        <div class="form-group">
            <label for="platform">Platform</label>
            <select class="form-control" id="platform" name="platform" aria-describedby="platform">
                <option value="0">Generic</option>
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
            <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string">
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