@extends('layouts.viv')
@section('title') About ChangeWindows @endsection

@php
    $insider_level = null;
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <img class="about-logo" src="{{ asset('img/logo.png') }}" />
        <p class="lead text-center about-intro">ChangeWindows is your source to find out everything you need to know about the previous, current and next version of Windows, be it for your PC, Xbox, HoloLens, Hub, IoT device, server or perhaps even that phone you still have.</p>
        <p class="text-center mt-3">
            <a href="ms-windows-store://pdp/?productid=9N8V0TQT6NLB" class="btn btn-primary btn-store">
                <span class="brand"><i class="fab fa-microsoft"></i> Get Viv</span>
                <span class="ms-store">from the Microsoft Store</span>
            </a>
            <a href="ms-windows-store://pdp/?productid=9N0SBFV9GR8J" class="btn btn-primary btn-store">
                <span class="brand"><i class="fab fa-microsoft"></i> Get Viv Preview</span>
                <span class="ms-store">from the Microsoft Store</span>
            </a>
        </p>
        <p class="text-center"><a href="https://www.patreon.com/bePatron?c=1028298" class="btn btn-primary btn-patreon"><i class="fab fa-fw fa-patreon"></i> Become a Patron</a></p>
        <p class="lead text-center about-intro">These are our patrons, they help us make ChangeWindows a reality. If you like what we do, feel free to join them.</p>
        <div class="jumbotron insider platinum">
            <h1 class="text-center text-lowercase"><span class="font-weight-light">Platinum</span>Insider</h1>
            <div class="row justify-content-md-center">
                @foreach ($platinum as $patron)
                    <div class="col-3">
                        <div class="patron">
                            <i class="fal fa-fw fa-user-circle"></i>
                            <div class="name">{{ $patron->name }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="jumbotron insider gold">
            <h1 class="text-center text-lowercase"><span class="font-weight-light">Gold</span>Insider</h1>
            <div class="row justify-content-md-center">
                @foreach ($gold as $patron)
                    <div class="col-3">
                        <div class="patron">
                            <i class="fal fa-fw fa-user-circle"></i>
                            <div class="name">{{ $patron->name }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="jumbotron insider silver">
            <h1 class="text-center text-lowercase"><span class="font-weight-light">Silver</span>Insider</h1>
            <div class="row justify-content-md-center">
                @foreach ($silver as $patron)
                    <div class="col-3">
                        <div class="patron">
                            <div class="name">{{ $patron->name }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="jumbotron insider bronze">
            <h1 class="text-center text-lowercase"><span class="font-weight-light">Bronze</span>Insider</h1>
            <div class="row justify-content-md-center">
                @foreach ($bronze as $patron)
                    <div class="col-3">
                        <div class="patron">
                            <div class="name">{{ $patron->name }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection