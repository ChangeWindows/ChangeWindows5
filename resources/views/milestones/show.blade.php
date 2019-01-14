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
    <div class="col">
    
    </div>
</div>
@endsection