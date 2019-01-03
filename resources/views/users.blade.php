@extends('layouts.app')

@section('hero')
@endsection

@section('content')
<div class="row px-n10">
    <div class="col-lg-12">
        @foreach ($users as $user)
            <div class="row">
                <div class="col col-md-2">{{ $user->name }}</div>
                <div class="col col-md-5">{{ $user->email }}</div>
                <div class="col col-md-2">
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </div>
                <div class="col col-md-3">{{ $user->created_at }}</div>
            </div>
        @endforeach
        {{ $users->links() }}
    </div>
</div>
@endsection

@section('modals')
@endsection