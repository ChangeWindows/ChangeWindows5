@extends('layouts.app')
@section('title') {{ $flight->build }}.{{$flight->dleta }} &middot; Flights @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Flights</h2>
    </div>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('updateFlight', $flight->id) }}" class="row">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}
    <div class="col-12">
        <h4>
            Flight settings
            <button type="submit" class="btn btn-primary float-right"><i class="far fa-fw fa-check"></i> Save</button>
        </h4>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="build_string">String</label>
            <input type="text" class="form-control" id="build_string" name="build_string" aria-describedby="build_string" placeholder="Build string" value="{{ $flight->major }}.{{ $flight->minor }}.{{ $flight->build }}.{{ $flight->delta }}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="release">Date</label>
            <input type="date" class="form-control" id="release" name="release" aria-describedby="release" placeholder="Date" value={{ $flight->date }}>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="milestone">Milestone</label>
            <select class="form-control" id="milestone" name="milestone" aria-describedby="milestone">
                @foreach ($milestones as $milestone)
                    <option value="{{ $milestone->id }}" {{ $flight->milestone == $milestone->id ? 'selected' : ''}}>{{ $milestone->osname }} version {{ $milestone->version }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="platform">Platform</label>
            <select class="form-control" id="platform" name="platform" aria-describedby="platform">
                <option value="0" {{ $flight->platform == 0 ? 'selected' : ''}}>Generic</option>
                <option value="1" {{ $flight->platform == 1 ? 'selected' : ''}}>PC</option>
                <option value="2" {{ $flight->platform == 2 ? 'selected' : ''}}>Mobile</option>
                <option value="3" {{ $flight->platform == 3 ? 'selected' : ''}}>Xbox</option>
                <option value="4" {{ $flight->platform == 4 ? 'selected' : ''}}>Server</option>
                <option value="10" {{ $flight->platform == 10 ? 'selected' : ''}}>10X</option>
                <option value="5" {{ $flight->platform == 5 ? 'selected' : ''}}>Holographic</option>
                <option value="6" {{ $flight->platform == 6 ? 'selected' : ''}}>IoT</option>
                <option value="7" {{ $flight->platform == 7 ? 'selected' : ''}}>Team</option>
                <option value="8" {{ $flight->platform == 8 ? 'selected' : ''}}>ISO</option>
                <option value="9" {{ $flight->platform == 9 ? 'selected' : ''}}>SDK</option>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="ring">Ring</label>
            <select class="form-control" id="ring" name="ring" aria-describedby="ring">
                <option value="0" {{ $flight->ring == 0 ? 'selected' : ''}}>vNext</option>
                <option value="1" {{ $flight->ring == 1 ? 'selected' : ''}}>Fast Ring Skip Ahead</option>
                <option value="2" {{ $flight->ring == 2 ? 'selected' : ''}}>Fast Ring Active/Alpha</option>
                <option value="3" {{ $flight->ring == 3 ? 'selected' : ''}}>Slow Ring/Beta/Preview</option>
                <option value="4" {{ $flight->ring == 4 ? 'selected' : ''}}>Delta</option>
                <option value="5" {{ $flight->ring == 5 ? 'selected' : ''}}>Release Preview Ring/Omega Ring</option>
                <option value="6" {{ $flight->ring == 6 ? 'selected' : ''}}>Semi-Annual Channel Targeted/Release</option>
                <option value="7" {{ $flight->ring == 7 ? 'selected' : ''}}>Semi-Annual Channel Broad</option>
                <option value="8" {{ $flight->ring == 8 ? 'selected' : ''}}>Long-Term Servicing Channel</option>
            </select>
        </div>
    </div>
</form>
<div class="col-12">
    <h4 class="mt-4">Danger zone</h4>
    <p>Removing a flight is permanent and cannot be undone.</p>
    <form method="POST" action="{{ route('destroyFlight', ['id' => $flight->id]) }}" class="d-inline">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger"><i class="far fa-fw fa-trash-alt"></i> Remove flight</button>
    </form>
</div>
@endsection
