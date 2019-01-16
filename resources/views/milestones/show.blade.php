@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2><i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} {{ $milestone->name }}<small>version {{ $milestone->version }}</small></h2>
        <p class="lead">{{ $milestone->description }}</p>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    @if ($previous)
        <div class="col-6">
            <a href="{{ URL::to('milestones/'.$previous->id) }}">
                <i class="fab fa-fw fa-windows"></i> {{ $previous->osname }} {{ $previous->name }}
            </a>
        </div>
    @endif
    @if ($next)
        <div class="col-6">
            <a href="{{ URL::to('milestones/'.$next->id) }}">
                <i class="fab fa-fw fa-windows"></i> {{ $next->osname }} {{ $next->name }}
            </a>
        </div>
    @endif
</div>
@endsection