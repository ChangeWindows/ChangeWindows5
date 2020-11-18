@extends('layouts.app')
@section('title') Milestones @endsection

@section('toolset')
@can('create_milestone')
<a class="dropdown-item" href="{{ route('admin.milestones') }}"><i class="far fa-fw fa-plus"></i> New milestone</a>
<div class="dropdown-divider"></div>
@endcan
@endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Milestones</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="row">
            @foreach ($milestones as $milestone)
                <div class="col-lg-4 col-md-6 col-12">
                    <a class="milestone" href="{{ route('showMilestone', ['id' => $milestone->id]) }}" style="background: #{{ $milestone->color }}">
                        <h4 class="text-center">
                            <i class="fab fa-fw fa-windows font-weight-normal"></i> <span class="font-weight-bold">{{ $milestone->osname }}</span>
                        </h4>
                        <h3 class="text-center font-weight-normal">
                            version {{ $milestone->version }}
                        </h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection