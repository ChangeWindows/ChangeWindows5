@extends('layouts.viv')
@section('title') About viv @endsection

@php
    $insider_level = null;
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <p class="lead">With ChangeWindows, we want to provide you with a full and as detailed as possible changelog about everything new in Windows.</p>
        <p>With <i>viv</i> we're going to do a few things differently. While ChangeWindows will receive some visual changes, our primary goal is to making our website more accessible, easier to use and easier to navigate. Of course, what you're seeing now is only a <b>very early</b> preview of <i>viv</i> and lots of stuff is still missing, so if you don't want that, feel free to return to <a href="https://changewindows.org">ChangeWindows 4.13</a>. Everything you're looking for is probably there.</p>

        <h2>Patrons</h2>
        <a href="https://www.patreon.com/bePatron?c=1028298" class="btn btn-primary btn-patreon"><i class="fab fa-fw fa-patreon"></i> Become a Patron</a>
        <p>These are our donators, they help us make ChangeWindows a reality. If you want to join them in this, feel free to click the 'Become a Patron' button.</p>
        <h2>Gold</h2>
        <div class="row">
            @foreach ($gold as $patron)
                <div class="col-3">
                    <div class="patron gold">
                        <div class="header">Insider Gold</div>
                        <i class="fal fa-fw fa-user-circle"></i>
                        <div class="name">{{ $patron->name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <h2>Silver</h2>
        <div class="row">
            @foreach ($silver as $patron)
                <div class="col-3">
                    <div class="patron silver">
                        <div class="header">Insider Silver</div>
                        <div class="name">{{ $patron->name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <h2>Bronze</h2>
        <div class="row">
            @foreach ($bronze as $patron)
                <div class="col-3">
                    <div class="patron bronze">
                        <div class="header">Insider Bronze</div>
                        <div class="name">{{ $patron->name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection