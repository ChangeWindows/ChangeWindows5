@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Hello {{ Auth::user()->name }}</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-8">
        <h2>Settings</h2>
        <form method="POST" action="{{ route('updateProfile', Auth::user()->id) }}" class="row">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme-default" value="0" {{ Auth::user()->theme === 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="theme-default">Default</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme-light" value="1" {{ Auth::user()->theme === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="theme-light">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="theme" id="theme-dark" value="2" {{ Auth::user()->theme === 2 ? 'checked' : '' }}>
                    <label class="form-check-label" for="theme-dark">Dark</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="fal fa-fw fa-save"></i> Save</button>
            </div>
        </form>
        @if (Auth::user()->hasAnyRole(['Admin', 'Insider']))
            <h2>Insider features</h2>
            <div class="list-group">
                <div class="list-group-item list-group-item-success">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><i class="fal fa-fw fa-check"></i> Milestones beta</h5>
                    </div>
                    <p class="mb-1">The milestones page gives an overview off all builds within a milestone.</p>
                    <small>You can't turn this feature of right now.</small>
                </div>
            </div>
        @endif
    </div>
    <div class="col-4">
        <h2>Details</h2>
        <p>
            <b>Name</b>: {{ Auth::user()->name }}<br />
            <b>Email</b>: {{ Auth::user()->email }}<br />
            <b>Role</b>: {{ Auth::user()->getRoles()->name }}
        </p>
    </div>
</div>
@endsection