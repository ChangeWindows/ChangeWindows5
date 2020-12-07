@extends('core.layouts.app')
@section('title') Flights @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Flights</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.milestones') }}">Content</a></li>
        <li class="breadcrumb-item active">Flights</li>
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
            @can('create_flight')
                <form method="POST" class="card border-0 shadow p-3" action="{{ route('admin.flights.store') }}">
                    {{ csrf_field() }}
                    <h3 class="h6">
                        New flight
                        <button type="submit" class="btn btn-primary float-right btn-sm"><i class="far fa-fw fa-plus"></i> Add</button>
                    </h3>
                    <div class="row g-3">
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="build_string">String</label>
                            <input type="text" class="form-control @error('build_string') is-invalid @enderror" name="build_string" id="build_string" value="{{ old('build_string', '10.0.') }}" required placeholder="String">
                            @error('build_string')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required placeholder="Date">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <label class="form-label" for="tweet">Tweet this</label>
                            <div class="form-check"><input type="checkbox" class="form-check-input" id="tweet" name="tweet" value="1" checked="checked"><label class="form-check-label" for="tweet"> Send a tweet on <a href="https://twitter.com/changewindows">@ChangeWindows</a></label></label></div>
                        </div>
                        @foreach($platforms as $platform)
                            <div class="col-md-4 col-sm-6">
                                <label for="ring" class="control-label mb-2">{!! $platform->colored_icon !!} {{ $platform->name }}</label>
                                @foreach($platform->channelPlatforms as $channelPlatform)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="f{{ $platform->id }}{{ $channelPlatform->channel->id }}" name="flight[{{ $platform->id }}][{{ $channelPlatform->channel->id }}]" value="{{ $channelPlatform->channel->id }}" />
                                        <label class="form-check-label" for="f{{ $platform->id }}{{ $channelPlatform->channel->id }}">
                                            <span style="{{ $channelPlatform->channel->text_color }}">{{ $channelPlatform->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </form>
            @endcan
        </div>
        <div class="col-12">
            <h3 class="h5 title">Flights</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($timeline as $date => $builds)
                    <div class="col-12 h6 text-primary mb-3">{{ $date }}</div>
                    @foreach ($builds as $build => $deltas)
                        @foreach ($deltas as $delta => $platforms)
                            @foreach ($platforms as $platform => $rings)
                                @foreach ($rings as $ring)
                                    @include('core.search._flight', ['platform' => $platform, 'ring' => $ring, 'build' => $build, 'delta' => $delta])
                                @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                @empty
                    <div class="col-12 text-center my-5">
                        <h6>No flight available...</h6>
                        <p>Create one to get started</p>
                    </div>
                @endforelse
            </div>
        </div>
        @if ($releases->hasPages())
            <div class="col-12 d-flex flex-row justify-content-center">
                {{ $releases->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
