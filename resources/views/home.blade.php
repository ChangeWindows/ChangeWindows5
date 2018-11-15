@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!

                @if (Auth::user()->hasRole('Admin'))
                    <p>You are an admin</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
