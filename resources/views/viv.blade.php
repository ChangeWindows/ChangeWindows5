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
            <h3>5.0-alpha.3 <small>January/February 2019</small></h3>
            <h4><i class="fal fa-fw fa-plus"></i> New</h4>
            <p>The Rings page is now available for Insiders <span class="badge badge-info">Insiders</span></p>
            <p>My Windows is now available in the timeline sidebar when visiting ChangeWindows with Edge or our app</p>
            <p>The vNext changelog are back and have been added to the timeline sidebar</p>
            <p>The Black theme has been added as a darker version of Dark <span class="badge badge-info">Insiders</span></p>
            <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
            <p>The milestone pages now feature an improved responsive design</p>
            <p>Various improvements to our management tools, including flight editing and more</p>
            <h4><i class="fal fa-fw fa-server"></i> System</h4>
            <p>Further file clean-up and other code improvements</p>
            <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
            <p>Modernized look for tiles on the timeline sidebar and rings page</p>
            <p>Management tools have been lifted out of the UI into their own dropdown in the navbar</p>
            <p>Light has been restored as the default theme</p>
            <p>Updated radio and checkbox controls to use a custom design</p>
            <h4><i class="fal fa-fw fa-bug"></i> Fixed</h4>
            <p>Non-Insiders are no longer blocked from visiting the milestone platform details</p>
            <p>Fixes Holographic not showing the Fast Ring in the platform overview for a milestone</p>
            <p>The left and right border of timeline items are no longer not clickable</p>
            <p>When editing a changelog, the editor will now remember the platform instead of requiring it to be set again</p>
            <h4><i class="fal fa-fw fa-exclamation-triangle"></i> Known issues</h4>
            <p>Patrons are currently not listed on About</p>
            <p>ChangeWindows 4 URLs are not compatible with viv</p>
        </section>
        <section class="release-notes">
            <h3>5.0-alpha.2 <small>21 January 2019</small></h3>
            <h4><i class="fal fa-fw fa-plus"></i> New</h4>
            <p>You can now navigate to builds from the sidebar tiles on the timeline</p>
            <p>BuildFeed.net data is now available from the user menu</p>
            <p>Early development for the Milestones feature</p>
            <p>You can now set the theme the website should follow in your profile</p>
            <p>Our favicon has been restored</p>
            <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
            <p>Updated design for highlights on the timeline page</p>
            <p>Various improvements to our responsive design for smaller screens</p>
            <h4><i class="fal fa-fw fa-server"></i> System</h4>
            <p>Minor restructuring of our files</p>
            <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
            <p>Revamped heading design with transparency and blur (on supported browsers)</p>
            <p>Reversed "Desktop" branding back to "PC" as it should have been</p>
            <h4><i class="fal fa-fw fa-bug"></i> Fixed</h4>
            <p>When in the profile, the profile menu will now be correctly marked as active</p>
            <p>Modals will no longer appear below the navbar</p>
            <p>The timeline sidebar no longer shows updates from older milestones as the current build</p>
            <p>Hero images now no longer appear to have no rounded corners at the bottom</p>
            <p>Removed instances where "Holographic" was incorrectly referred to as "Mixed Reality"</p>
            <h4><i class="fal fa-fw fa-exclamation-triangle"></i> Known issues</h4>
            <p>The left and right border of timeline items are not clickable</p>
            <p>Patrons are currently not listed on About</p>
            <p>ChangeWindows 4 URLs are not compatible with viv</p>
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
            <h4><i class="fal fa-fw fa-exclamation-triangle"></i> Known issues</h4>
            <p>Tiles on the timeline show a hover effect but aren't yet clickable</p>
            <p>Patrons are currently not listed on About</p>
            <p>ChangeWindows 4 URLs are not compatible with viv</p>
        </section>
    </div>
    <div class="col-12 col-md-3">
        <h4>About</h4>
        <p>ChangeWindows 5.0-alpha.2</p>

        <h4>Patrons</h4>
        <a href="https://www.patreon.com/bePatron?c=1028298" class="btn btn-primary btn-patreon"><i class="fab fa-fw fa-patreon"></i> Become a Patron</a>
        <p>These are our donators, they help us make ChangeWindows a reality. If you want to join them in this, feel free to click the 'Become a Patron' button.</p>
        
        <p>We currently don't show our Patrons here yet, we're still working on that functionality.</p>

        <h4>Disclaimer</h4>
        <p>ChangeWindows and studio384 are not related to Microsoft in any way. All trademarks mentioned are the property of their respective owners. We do not guarantee the correctness of the information on this site.</p>
    </div>
</div>
@endsection