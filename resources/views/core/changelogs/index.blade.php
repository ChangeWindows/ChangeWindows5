@extends('core.layouts.app')
@section('title') Changelogs @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Changelogs</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
        <li class="breadcrumb-item active">Changelogs</li>
    </ol>
</div>
<div class="content-box">
    <div class="row">
        @if (session('status'))
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="me-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        @endif
        <div class="col-12">
            @can('create_log')
                <form method="POST" class="card border-0 shadow p-3" action="{{ route('admin.changelogs.store') }}">
                    {{ csrf_field() }}
                    <h3 class="h6">
                        New changelog
                        <button type="submit" class="btn btn-primary float-end btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="milestone">Milestone</label>
                            <select class="form-select" @error('milestone') is-invalid @enderror" id="milestone" name="milestone" required>
                                @foreach ($milestones as $milestone)
                                    <option value="{{ $milestone->id }}" {{ old('milestone', request()->milestone) == $milestone->id ? 'selected' : ''}}>{{ $milestone->osname }} version {{ $milestone->version }}</option>
                                @endforeach
                            </select>
                            @error('milestone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="platform">Platform</label>
                            <select class="form-select @error('platform') is-invalid @enderror" id="platform" name="platform" required>
                                <option value="0" {{ old('platform', request()->platform) == 0 ? 'selected' : ''}}>Generic</option>
                                <option value="1" {{ old('platform', request()->platform) == 1 ? 'selected' : ''}}>PC</option>
                                <option value="2" {{ old('platform', request()->platform) == 2 ? 'selected' : ''}}>Mobile</option>
                                <option value="3" {{ old('platform', request()->platform) == 3 ? 'selected' : ''}}>Xbox</option>
                                <option value="4" {{ old('platform', request()->platform) == 4 ? 'selected' : ''}}>Server</option>
                                <option value="10" {{ old('platform', request()->platform) == 10 ? 'selected' : ''}}>10X</option>
                                <option value="5" {{ old('platform', request()->platform) == 5 ? 'selected' : ''}}>Holographic</option>
                                <option value="6" {{ old('platform', request()->platform) == 6 ? 'selected' : ''}}>IoT</option>
                                <option value="7" {{ old('platform', request()->platform) == 7 ? 'selected' : ''}}>Team</option>
                                <option value="8" {{ old('platform', request()->platform) == 8 ? 'selected' : ''}}>ISO</option>
                                <option value="9" {{ old('platform', request()->platform) == 9 ? 'selected' : ''}}>SDK</option>
                            </select>
                            @error('platform')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="changelog">Changelog</label>
                            <x-easy-mde name="changelog" class="form-control @error('changelog') is-invalid @enderror" placeholder="Changelog">{{ old('changelog') }}</x-easy-mde>
                            @error('changelog')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </form>
            @endcan
        </div>
        <div class="col-12">
            <h3 class="h5 title">Changelogs</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($changelogs as $changelog)
                    @include('core.search._changelog', ['changelog' => $changelog])
                @empty
                    <div class="col-12 text-center my-5">
                        <h6>No changelog available...</h6>
                        <p>Create one to get started</p>
                    </div>
                @endforelse
            </div>
        </div>
        @if ($changelogs->hasPages())
            <div class="col-12 d-flex flex-row justify-content-center">
                {{ $changelogs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
