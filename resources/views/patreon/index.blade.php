@extends('layouts.app')
@section('title') Patrons @endsection

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Patrons</h2>
        <div class="btn-toolbar">
            <a class="btn btn-primary" href="#newPatronModal" data-toggle="modal" data-target="#newPatronModal"><i class="fal fa-fw fa-plus"></i> New Patron</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="list-group list-group-changelogs">
            @foreach ($patreons as $patron)
                <a href="{{ route('editPatreon', [$patron->id]) }}" class="list-group-item">
                    {{ $patron->name }} &middot; ${{ $patron->amount }}
                </a>
            @endforeach
        </div>
        
        {{ $patreons->links() }}
    </div>
</div>
@endsection

@section('modals')
<div class="modal fade" id="newPatronModal" tabindex="-1" role="dialog" aria-labelledby="newPatronModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Patron</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-fw fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('storePatreon') }}" class="row row-p-10">
                    {{ csrf_field() }}
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" aria-describedby="amount" placeholder="Amount">
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fal fa-fw fa-plus"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection