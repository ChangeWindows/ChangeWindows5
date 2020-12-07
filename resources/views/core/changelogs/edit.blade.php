@extends('core.layouts.app')
@section('title') {{ getPlatformById($log->platform) }} version {{ $log->milestone->version }} @endsection

@section('content')
<div class="page-bar">
    <div class="d-flex flex-md-row flex-column align-items-end">
        <h1 class="h4 d-none d-md-inline-block m-0">{{ getPlatformById($log->platform) }} version {{ $log->milestone->version }}</h1>
        <ol class="breadcrumb pt-2 pt-md-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.changelogs') }}">Changelogs</a></li>
            <li class="breadcrumb-item active">{{ getPlatformById($log->platform) }} version {{ $log->milestone->version }}</li>
        </ol>
    </div>
</div>
<div class="content-box">
    @if (session('status'))
        <div class="row mb-3">
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="me-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.changelogs.update', $log) }}">
        <fieldset class="row" @cannot('edit_log') disabled @endcannot>
            <div class="col-12">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="card border-0 shadow p-3">
                    <h3 class="h6">
                        General
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="far fa-save"></i> Save</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="milestone">Milestone</label>
                            <select class="form-select @error('milestone') is-invalid @enderror" id="milestone" name="milestone" required>
                                @foreach ($milestones as $milestone)
                                    <option value="{{ $milestone->id }}" {{ old('milestone', $log->milestone) == $milestone->id ? 'selected' : ''}}>{{ $milestone->osname }} version {{ $milestone->version }}</option>
                                @endforeach
                            </select>
                            @error('milestone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="platform">Platform</label>
                            <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                                <option value="0" {{ old('platform', $log->platform) == 0 ? 'selected' : ''}}>Generic</option>
                                <option value="1" {{ old('platform', $log->platform) == 1 ? 'selected' : ''}}>PC</option>
                                <option value="2" {{ old('platform', $log->platform) == 2 ? 'selected' : ''}}>Mobile</option>
                                <option value="3" {{ old('platform', $log->platform) == 3 ? 'selected' : ''}}>Xbox</option>
                                <option value="4" {{ old('platform', $log->platform) == 4 ? 'selected' : ''}}>Server</option>
                                <option value="10" {{ old('platform', $log->platform) == 10 ? 'selected' : ''}}>10X</option>
                                <option value="5" {{ old('platform', $log->platform) == 5 ? 'selected' : ''}}>Holographic</option>
                                <option value="6" {{ old('platform', $log->platform) == 6 ? 'selected' : ''}}>IoT</option>
                                <option value="7" {{ old('platform', $log->platform) == 7 ? 'selected' : ''}}>Team</option>
                                <option value="8" {{ old('platform', $log->platform) == 8 ? 'selected' : ''}}>ISO</option>
                                <option value="9" {{ old('platform', $log->platform) == 9 ? 'selected' : ''}}>SDK</option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="changelog">Changelog</label>
                            <x-easy-mde name="changelog" class="form-control @error('changelog') is-invalid @enderror" placeholder="Changelog">{{ old('changelog', $log->changelog) }}</x-easy-mde>
                            @error('changelog')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    @can('delete_log')
        <div class="row">
            <div class="col-12">
                <h3 class="h5 title text-danger">Danger zone</h3>
            </div>
            <div class="col-12">
                <form method="POST" class="card border-0 shadow p-3 d-block" action="{{ route('admin.changelogs.delete', $log) }}">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <h3 class="h6">Delete changelog</h3>
                    <button type="submit" class="btn btn-danger btn-sm mt-2"><i class="far fa-fw fa-trash-alt"></i> Delete changelog</button>
                    <small class="form-text">Deletes all data related to the changelog. This action is irreversable.</small>
                </form>
            </div>
        </div>
    @endcan
</div>
@endsection
