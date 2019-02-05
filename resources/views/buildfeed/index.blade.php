@extends('layouts.buildfeed')
@section('title') BuildFeed @endsection

@section('content')
<div class="row buildfeed">
    @foreach ($builds as $build)
        <div class="col-6 col-lg-4 col-xl-3">
            <a href="{{ route('showBuildfeed', ['id' => $build->id]) }}" class="bf">
                <span class="bf-header">{{ $build->major }}.{{ $build->minor }}.{{ $build->build }}.{{ $build->revision }}</span>
                <span class="bf-body">
                    <i class="fal fa-fw fa-clock"></i> {{ $build->buildtime }}
                    <br />
                    <i class="fal fa-fw fa-flask"></i> {{ $build->lab }}
                </span>
            </a>
        </div>
    @endforeach
    <div class="col-12">{{ $builds->links() }}</div>
</div>
@endsection