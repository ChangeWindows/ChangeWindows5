@extends('layouts.app')
@section('title') Edit &middot; {{ $patreon->name }} @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Patreons</h2>
    </div>
</div>
@endsection

@section('content')
<form method="POST" action="{{ route('updatePatreon', $patreon->id) }}" class="row">
    {{ method_field('PATCH') }}
    <div class="col-12">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Name" value="{{ $patreon->name }}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" aria-describedby="amount" placeholder="Amount" value="{{ $patreon->amount }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" value="{{ $patreon->email }}">
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-check"></i> Save</button>
            </div>
        </div>
    </div>
</form>
@endsection