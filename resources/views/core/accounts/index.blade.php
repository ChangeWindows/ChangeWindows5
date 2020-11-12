@extends('core.layouts.app')
@section('title') Accounts @endsection

@section('content')
<div class="page-bar d-flex flex-md-row flex-column align-items-baseline p-3">
    <h1 class="h4 d-none d-md-inline-block m-0">Accounts</h1>
    <ol class="breadcrumb pt-2 pt-md-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="far fa-fw fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.accounts') }}">Users</a></li>
        <li class="breadcrumb-item active">Accounts</li>
    </ol>
</div>
<div class="content-box">
    <div class="row">
        @if (session('status'))
            <div class="col-12">
                <div class='alert alert-success d-flex flex-row m-0'>
                    <div class="mr-2"><p class="m-0"><i class="far fa-fw fa-check"></i></p></div>
                    <p class="m-0">{!! session('status') !!}</p>
                </div>
            </div>
        @endif
        <div class="col-12">
            <h3 class="h5 title">Accounts</h3>
        </div>
        <div class="col-12 card-set">
            <div class="row">
                @forelse ($users as $user)
                    @include('core.search._account', ['account' => $user])
                @empty
                    <div class="col-12 text-center my-5">
                        <h6>No accounts available...</h6>
                        <p>If you see this, something went wrong.</p>
                    </div>
                @endforelse
            </div>
        </div>
        @if ($users->hasPages())
            <div class="col-12 d-flex flex-row justify-content-center">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
