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
        <div class="alert alert-info mt-4">
            <h5>While we're working on version 6, we'll not be able to display our Patrons here...</h5>
            <p>Developing ChangeWindows takes a while and we're currently working on our first big update since ChangeWindows 5. We call it - and this will surprise you - ChangeWindows 6. However, this means that we didn't have time to update or re-implement some features and showing our Patrons here was one of them.</p>
            <p class="m-0">Stick with us, tho, it will be back before version 6 is done.</p>
        </div>
    </div>
</div>
@endsection
