@extends('layouts.app')

@section('hero')
<div class="about-header">
    <img src="{{ asset('img/logo_white.png') }}" class="img-responsive viv-logo" />
    <h1><span class="font-uppercase font-light">Change</span><span class="font-uppercase font-bold">Windows</span> <span class="font-light">viv</span></h1>
    <h5>Changing Windows one build at a time</h5>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-9">
        <h1 class="title m-b-md">Welcome to <span class="font-uppercase font-light">Change</span><span class="font-uppercase font-bold">Windows</span> <span class="font-light">viv</span></h1>
        <p class="lead">With ChangeWindows, we want to provide you with a full and as detailed as possible changelog about everything new in Windows.</p>
        <p>With <i>viv</i> we're going to do a few things differently. ChangeWindows will receive a new look with our primary goal set to making our website more accessible, easier to use and easier to navigate. Of course, what you're seeing now is only a <b>very early</b> preview of <i>viv</i>, so if you don't want that, feel free to return to <a href="https://changewindows.org">ChangeWindows 4.12</a>. Everything you're looking for is probably there.</p>
        <h2>Patrons</h2>
        <a href="https://www.patreon.com/bePatron?c=1028298" class="btn btn-primary btn-patreon"><i class="fab fa-fw fa-patreon"></i> Become a Patron</a>
        <p>These are our donators, they help us make ChangeWindows a holographic. If you want to join them in this, feel free to click the 'Become a Patron' button.</p>
        <h4>ChangeWindows Insider</h4>

        <h4>Contributor +</h4>

    </div>
    <div class="col-3">
        <h4><span class="font-uppercase font-light">Change</span><span class="font-uppercase font-bold">Windows</span> <span class="font-light">viv</span> Preview</h4>
        <p>ChangeWindows 5.0-alpha.1</p>

        <h4>Disclaimer</h4>
        <p>ChangeWindows and studio384 are not related to Microsoft in any way. All trademarks mentioned are the property of their respective owners. We do not guarantee the correctness of the information on this site.</p>
    </div>
</div>
@endsection