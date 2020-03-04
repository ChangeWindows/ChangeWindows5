@extends('layouts.buildfeed')
@section('title') BuildFeed @endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="text-center">
            <div class="btn-group mb-2">
                <button type="button" class="btn btn-light btn-filter dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="filter-title">Lab:</span> {{ $request->lab ? $request->lab : 'All' }}
                </button>
                <div class="dropdown-menu dropdown-small">
                    <a class="dropdown-item" href="{{ route('buildfeed', ['lab' => null]) }}">All</a>
                    @foreach ($labs as $lab)
                        @if ($lab->lab != '')
                            <a class="dropdown-item" href="{{ route('buildfeed', ['lab' => $lab->lab, 'family' => $request->family, 'sourcetype' => $request->sourcetype]) }}">{{ $lab->lab }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="btn-group mb-2">
                <button type="button" class="btn btn-light btn-filter dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="filter-title">Family:</span> {!! $request->family ? getFamily($request->family) : 'All' !!}
                </button>
                <div class="dropdown-menu dropdown-small">
                    <a class="dropdown-item" href="{{ route('buildfeed', ['family' => null]) }}">All</a>
                    @foreach ($families as $family)
                        @if ($family->family != '')
                            <a class="dropdown-item" href="{{ route('buildfeed', ['lab' => $request->lab, 'family' => $family->family, 'sourcetype' => $request->sourcetype]) }}">{!! getFamily($family->family) !!}</a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="btn-group mb-2">
                <button type="button" class="btn btn-light btn-filter dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="filter-title">Source:</span> {!! $request->sourcetype ? getSource($request->sourcetype) : 'All' !!}
                </button>
                <div class="dropdown-menu dropdown-small">
                    <a class="dropdown-item" href="{{ route('buildfeed', ['sourcetype' => null]) }}">All</a>
                    @for ($i = 0; $i <= 8; $i++)
                        <a class="dropdown-item" href="{{ route('buildfeed', ['lab' => $request->lab, 'family' => $request->family, 'sourcetype' => $i]) }}">{!! getSource($i) !!}</a>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row buildfeed">
    @if (!$builds->isEmpty())
        @foreach ($builds as $build)
            <div class="col-6 col-lg-4 col-xl-3">
                <a href="{{ route('showBuildfeed', ['id' => $build->id]) }}" class="bf">
                    <span class="bf-header">{{ $build->major }}.{{ $build->minor }}.{{ $build->build }}.{{ $build->revision }}</span>
                    <span class="bf-body">
                        <i class="far fa-fw fa-clock"></i> {{ $build->buildtime }}
                        <br />
                        <i class="far fa-fw fa-flask"></i> {{ $build->lab }}
                    </span>
                </a>
            </div>
        @endforeach
    @else
        <div class="col">
            <div class="no-results text-center">
                <h3>No results have been found.</h3>
                <p class="lead">Your current selection has no builds. Try to change the lab, family and/or source.</p>
            </div>
        </div>
    @endif
    <div class="col-12">{{ $builds->links() }}</div>
</div>
@endsection
