@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col">
        <h2>Milestones</h2>
        @foreach ($milestones as $milestone)
            <h4><i class="fab fa-fw fa-windows"></i> {{ $milestone->osname }} version {{ $milestone->version }}</h4>
        @endforeach
    </div>
</div>
@endsection