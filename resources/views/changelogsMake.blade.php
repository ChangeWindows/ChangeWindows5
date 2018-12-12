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

<form method="POST" action="{{ route('storeChangelogs') }}" class="row row-p-10">
    {{ csrf_field() }}
    <div class="col-12">
        <div class="form-group">
            <label for="build_string">String</label>
            <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="platform">Example select</label>
            <select class="form-control" id="platform" name="platform" aria-describedby="platform">
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
    <div class="col-12">
        <div class="form-group">
            <label for="changelog">Changelog</label>
            <textarea class="form-control" id="changelog" name="changelog" aria-describedby="changelog" placeholder="Changelog" rows="20"></textarea>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-plus"></i> Save</button>
    </div>
</form>
@endsection