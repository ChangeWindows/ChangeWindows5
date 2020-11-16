@extends('core.layouts.app')
@section('title') {{ $release->build }}.{{ $release->delta }} @endsection

@section('content')
<div class="page-bar">
    <div class="d-flex flex-md-row flex-column align-items-end">
        <h1 class="h4 d-none d-md-inline-block m-0">{{ $release->build }}.{{ $release->delta }}</h1>
        <ol class="breadcrumb pt-2 pt-md-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.flights') }}">Flights</a></li>
            <li class="breadcrumb-item active">{{ $release->build }}.{{ $release->delta }}</li>
        </ol>
    </div>
</div>
<div class="content-box">
    @if (session('status'))
        <div class="row mb-3">
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="mr-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.flights.update', $release) }}">
        <fieldset class="row" @cannot('edit_flight') disabled @endcannot>
            <div class="col-12">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        General
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="build_string">String</label>
                            <input type="text" class="form-control @error('build_string') is-invalid @enderror" name="build_string" id="build_string" required placeholder="String" value="{{ old('build_string', $release->major.'.'.$release->minor.'.'.$release->build.'.'.$release->delta) }}">
                            @error('build_string')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" required placeholder="Date" value="{{ old('date', $release->date->format('Y-m-d')) }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="milestone">Milestone</label>
                            <select class="form-select @error('milestone') is-invalid @enderror" id="milestone" name="milestone" required>
                                @foreach ($milestones as $milestone)
                                    <option value="{{ $milestone->id }}" {{ old('milestone', $release->milestone) == $milestone->id ? 'selected' : ''}}>{{ $milestone->osname }} version {{ $milestone->version }}</option>
                                @endforeach
                            </select>
                            @error('milestone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="platform">Platform</label>
                            <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                                <option value="0" {{ old('platform', $release->platform) == 0 ? 'selected' : ''}}>Generic</option>
                                <option value="1" {{ old('platform', $release->platform) == 1 ? 'selected' : ''}}>PC</option>
                                <option value="2" {{ old('platform', $release->platform) == 2 ? 'selected' : ''}}>Mobile</option>
                                <option value="3" {{ old('platform', $release->platform) == 3 ? 'selected' : ''}}>Xbox</option>
                                <option value="4" {{ old('platform', $release->platform) == 4 ? 'selected' : ''}}>Server</option>
                                <option value="10" {{ old('platform', $release->platform) == 10 ? 'selected' : ''}}>10X</option>
                                <option value="5" {{ old('platform', $release->platform) == 5 ? 'selected' : ''}}>Holographic</option>
                                <option value="6" {{ old('platform', $release->platform) == 6 ? 'selected' : ''}}>IoT</option>
                                <option value="7" {{ old('platform', $release->platform) == 7 ? 'selected' : ''}}>Team</option>
                                <option value="8" {{ old('platform', $release->platform) == 8 ? 'selected' : ''}}>ISO</option>
                                <option value="9" {{ old('platform', $release->platform) == 9 ? 'selected' : ''}}>SDK</option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="ring">Ring</label>
                            <select class="form-select @error('ring') is-invalid @enderror" id="ring" name="ring" required>
                                <option value="0" {{ old('ring', $release->ring) == 0 ? 'selected' : ''}}>vNext</option>
                                <option value="1" {{ old('ring', $release->ring) == 1 ? 'selected' : ''}}>Fast Ring Skip Ahead</option>
                                <option value="2" {{ old('ring', $release->ring) == 2 ? 'selected' : ''}}>Fast Ring Active/Alpha</option>
                                <option value="3" {{ old('ring', $release->ring) == 3 ? 'selected' : ''}}>Slow Ring/Beta/Preview/Dev</option>
                                <option value="4" {{ old('ring', $release->ring) == 4 ? 'selected' : ''}}>Delta</option>
                                <option value="5" {{ old('ring', $release->ring) == 5 ? 'selected' : ''}}>Release Preview Ring/Omega Ring</option>
                                <option value="6" {{ old('ring', $release->ring) == 6 ? 'selected' : ''}}>Semi-Annual Channel Targeted/Release</option>
                                <option value="7" {{ old('ring', $release->ring) == 7 ? 'selected' : ''}}>Semi-Annual Channel Broad</option>
                                <option value="8" {{ old('ring', $release->ring) == 8 ? 'selected' : ''}}>Long-Term Servicing Channel</option>
                            </select>
                            @error('ring')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    @can('delete_flight')
        <div class="row">
            <div class="col-12">
                <h3 class="h5 title text-danger">Danger zone</h3>
            </div>
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3 d-block" action="{{ route('admin.flights.delete', $release) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <h3 class="h6">Delete flight</h3>
                    <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="far fa-fw fa-trash-alt"></i> Delete flight</button>
                    <small class="form-text">Deletes all data related to the flight. This action is irreversable.</small>
                </form>
            </div>
        </div>
    @endcan
</div>
@endsection
