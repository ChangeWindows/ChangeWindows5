@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2>Users</h2>
    </div>
</div>
@endsection

@section('content')
<div class="row px-n10">
    <div class="col-lg-12">
        <div class="row">
            @foreach ($users as $user)
                <div class="col-lg-4 col-sm-6 col-12 user-box">
                    <div class="user">
                        <div class="row">
                            <div class="col-2 text-center"><i class="fal fa-fw fa-user-circle"></i></div>
                            <div class="col-10">
                                <p class="h2">{{ $user->name }}</p>
                                <p class="h6">{{ $user->created_at }}</p>
                                <p class="h6">{{ $user->email }}</p>
                                <p class="h6">
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-12">
                                <div class="options">
                                    <div class="btn-group">
                                        <form method="POST" action="{{ URL::to('users/'.$user->id.'/promote') }}">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-outline-primary" {{ $user->roles[0]->id === 1 ? 'disabled' : '' }}><i class="fal fa-fw fa-arrow-up"></i> Promote</button>
                                        </form>
                                        <form method="POST" action="{{ URL::to('users/'.$user->id.'/demote') }}">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-outline-primary" {{ $user->roles[0]->id === 3 ? 'disabled' : '' }}><i class="fal fa-fw fa-arrow-down"></i> Demote</button>
                                        </form>
                                        <form method="POST" action="{{ URL::to('users/'.$user->id) }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-outline-danger"><i class="fal fa-fw fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $users->links() }}
    </div>
</div>
@endsection

@section('modals')
@endsection