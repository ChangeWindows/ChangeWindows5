@extends('layouts.app')

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
                    <a class="milestone" href="{{ URL::to('milestones/'.$milestone->id) }}">
                        <h4 class="text-center" style="color: #{{ $milestone->color }}">
                            <i class="fab fa-fw fa-windows"></i> <span class="font-weight-bold">{{ $milestone->osname }}</span>
                        </h4>
                        <h3 class="text-center" style="color: #{{ $milestone->color }}">
                            {{ $milestone->name }}
                        </h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection