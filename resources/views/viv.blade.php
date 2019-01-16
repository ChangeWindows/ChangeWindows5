@extends('layouts.app')

@section('hero')
<div class="jumbotron">
    <div class="container">
        <h2><span class="font-uppercase font-light">Change</span><span class="font-uppercase font-bold">Windows</span> <span class="font-light">viv</span></h2>
        <h5>Changing Windows one build at a time</h5>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-md-9">
        <p class="lead">With ChangeWindows, we want to provide you with a full and as detailed as possible changelog about everything new in Windows.</p>
        <p>With <i>viv</i> we're going to do a few things differently. While ChangeWindows will receive some visual changes, our primary goal is to making our website more accessible, easier to use and easier to navigate. Of course, what you're seeing now is only a <b>very early</b> preview of <i>viv</i> and lots of stuff is still missing, so if you don't want that, feel free to return to <a href="https://changewindows.org">ChangeWindows 4.12</a>. Everything you're looking for is probably there.</p>

        <h2>What's new</h2>
        <p>In the weeks ahead, ChangeWindows will regularly change, below you can keep track of these changes as we won't be annoucing all of them on our blog or other outlets.</p>
        <section class="release-notes">
            <h3>5.0-alpha.2 <small>January 2019</small></h3>
            <h4><i class="fal fa-fw fa-plus"></i> New</h4>
            <p>You can now navigate to builds from the sidebar tiles on the timeline</p>
            <p>BuildFeed.net data is now available from the user menu</p>
            <p>Early development for the Milestones feature <span class="badge badge-info">Insider</span></p>
            <p>You can now set the theme the website should follow in your profile</p>
            <p>Our favicon has been restored</p>
            <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
            <p>Updated design for highlights on the timeline page</p>
            <p>Various improvements to our responsive design for smaller screens</p>
            <h4><i class="fal fa-fw fa-server"></i> System</h4>
            <p>Minor restructuring of our files</p>
            <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
            <p>Revamped navigation bar design with transparency and blur</p>
            <h4><i class="fal fa-fw fa-trash-alt"></i> Removed</h4>
            <h4><i class="fal fa-fw fa-bug"></i> Fixed</h4>
            <p>When in the profile, the profile menu will now be correctly marked as active</p>
            <h4><i class="fal fa-fw fa-exclamation-triangle"></i> Known issues</h4>
            <p>Patrons are currently not listed on About</p>
        </section>
        <section class="release-notes">
            <h3>5.0-alpha.1 <small>9 January 2019</small></h3>
            <h4><i class="fal fa-fw fa-plus"></i> New</h4>
            <p>You can now make an account on ChangeWindows</p>
            <p>The timeline now show a pagination at the bottom of the page</p>
            <p>Support for custom titlebars in the ChangeWindows App has been restored</p>
            <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
            <p>Changelogs are now loaded from our database rather than Markdown files</p>
            <h4><i class="fal fa-fw fa-server"></i> System</h4>
            <p>Revamped Laravel-based back-end</p>
            <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
            <p>Settings have been moved from About to Profile</p>
            <p>The main navigation has been reorginized</p>
            <h4><i class="fal fa-fw fa-trash-alt"></i> Removed</h4>
            <p>A number of ChangeWindows 4 features are currently not available but will return</p>
            <p>You can no longer change the grouping in the timeline</p>
            <h4><i class="fal fa-fw fa-bug"></i> Fixed</h4>
            <h4><i class="fal fa-fw fa-exclamation-triangle"></i> Known issues</h4>
            <p>Tiles on the timeline show a hover effect but aren't yet clickable</p>
            <p>Patrons are currently not listed on About</p>
        </section>
    </div>
    <div class="col-12 col-md-3">
        <h4>About</h4>
        <p>ChangeWindows 5.0-alpha.1</p>

        <h4>Patrons</h4>
        <a href="https://www.patreon.com/bePatron?c=1028298" class="btn btn-primary btn-patreon"><i class="fab fa-fw fa-patreon"></i> Become a Patron</a>
        <p>These are our donators, they help us make ChangeWindows a reality. If you want to join them in this, feel free to click the 'Become a Patron' button.</p>
        
        <p>We currently don't show our Patrons here yet, we're still working on that functionality.</p>

        <h4>Disclaimer</h4>
        <p>ChangeWindows and studio384 are not related to Microsoft in any way. All trademarks mentioned are the property of their respective owners. We do not guarantee the correctness of the information on this site.</p>
    </div>
</div>
@endsection