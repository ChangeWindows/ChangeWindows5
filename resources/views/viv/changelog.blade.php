@extends('layouts.viv')
@section('title') ChangeWindows Changelog @endsection

@section('content')
<h2>What's new</h2>
<section class="release-notes">
    <h3>5.0.0 <small>9 March 2019</small></h3>
    <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
    <p>Various preparations on the Git repository for the official launch</p>
    <p>Updated menu structure for the launch</p>
    <p>Minor typography updates for headings</p>
    <h4><i class="fal fa-fw fa-band-aid"></i> Fixed</h4>
    <p>Fixes a bug that resulted in a HTTP/500 crash when adding a new flight</p>
</section>
<section class="release-notes">
    <h3>5.0-beta.2 <small>3 March 2019</small></h3>
    <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
    <p>When adding a flight, the date will be set to today by default <span class="badge badge-warning">Admin</span></p>
    <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
    <p>Tweeting when a new changelog is published has been temporarly disabled</p>
    <p>Improved design consistency</p>
    <p>Various code cleanup and consistency improvements</p>
    <h4><i class="fal fa-fw fa-band-aid"></i> Fixed</h4>
    <p>Fixes an issue where hovering over an active list group would make the text unreadable</p>
</section>
<section class="release-notes">
    <h3>5.0-beta.1 <small>26 February 2019</small></h3>
    <h4><i class="fal fa-fw fa-plus"></i> New</h4>
    <p>Build details now show quick navigation to the previous and next build in the sidebar</p>
    <p>The milestone of any given build can now quickly be accessed from the sidebar</p>
    <p>An RSS feed is now available to track all flights on ChangeWindows</p>
    <p>Sending out tweets after adding a flight is now optional <span class="badge badge-warning">Admin</span></p>
    <p>An "All" filter has been added to the changelog overview <span class="badge badge-warning">Admin</span></p>
    <p>Adds a Markdown editor for editing changelogs and vNext logs <span class="badge badge-warning">Admin</span></p>
    <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
    <p>Tweets for flights and changelogs will now link directly to the relevant delta</p>
    <p>Tweets about Xbox will now include Xbox-related hashtags</p>
    <p>The Dark theme has been redesigned and now has a lighter header and darker content area</p>
    <p>Tweets will now include shorter ring names and use platform-specific names</p>
    <p>Updated about page with links to our apps in the Microsoft Store</p>
    <p>Revamped design for HTTP error pages</p>
    <p>Various fixes, enhancements and small modifications to our design</p>
    <p>Revamps the changelog management overview UI <span class="badge badge-warning">Admin</span></p>
    <h4><i class="fal fa-fw fa-server"></i> System</h4>
    <p>Updates a large set of dependencies</p>
    <p>Changelogs will now show the "This is a recent log" warning when they are less then a day old automatically</p>
    <p>We now use the Font Awesome SVG framework instead of webfonts</p>
    <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
    <p>Introduces our updated logo, branding and accent color</p>
    <p>Introduces new platform iconography for our timelines</p>
    <p>Revamped design for our Patron highlights</p>
    <h4><i class="fal fa-fw fa-band-aid"></i> Fixed</h4>
    <p>Fixes a typo that showed the vNext changelogs in the browser tabs as "vNExt"</p>
    <p>Fixes a bug where tweets for published changelogs would not correctly link to the right platform</p>
    <p>Fixes an alignment issue with highlights where the images wouldn't be centered properly</p>
</section>
<section class="release-notes">
    <h3>5.0-alpha.4 <small>14 February 2019</small></h3>
    <h4><i class="fal fa-fw fa-plus"></i> New</h4>
    <p>You can now select the platform you want to show on the timeline</p>
    <p>URLs now use the name of platforms instead of an id</p>
    <p>Filters have been added to BuildFeed to filter by lab, family and source</p>
    <p>You can now click on some details on BuildFeed detail pages to search for them</p>
    <p>Patrons are now listed on our About page</p>
    <p>Flights without a changelog will now show buttons to create them <span class="badge badge-warning">Admin</span></p>
    <p>Milestones can now be removed from the front end <span class="badge badge-warning">Admin</span></p>
    <p>ChangeWindows can now tweet to <a href="https://twitter.com/changewindows">@ChangeWindows</a> when creating a flight, changelog or milestone <span class="badge badge-warning">Admin</span></p>
    <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
    <p>The "About" section has been expanded with Terms of Service and a Privacy statement</p>
    <p>We now show page-specific titles in your tabs</p>
    <p>The tab navigation is now responsive and will scroll sideways on smaller screens</p>
    <h4><i class="fal fa-fw fa-server"></i> System</h4>
    <p>Various improvements in the usage of Blade</p>
    <p>Improvements to support Windows 10 20H1 builds</p>
    <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
    <p>The White-theme has a slightly darker header</p>
    <h4><i class="fal fa-fw fa-trash-alt"></i> Removed</h4>
    <p>Removes support for non-Windows 10 releases</p>
    <h4><i class="fal fa-fw fa-band-aid"></i> Fixed</h4>
    <p>We fixed the spelling mistake in the BuildFeed promotional highlight image</p>
</section>
<section class="release-notes">
    <h3>5.0-alpha.3 <small>1 February 2019</small></h3>
    <h4><i class="fal fa-fw fa-plus"></i> New</h4>
    <p>The Rings page is now available</p>
    <p>My Windows is now available in the timeline sidebar when visiting ChangeWindows with Edge or our app</p>
    <p>The vNext changelog are back and have been added to the timeline sidebar</p>
    <p>The new Light and Black themes have been added <span class="badge badge-info">Insiders</span></p>
    <h4><i class="fal fa-fw fa-wrench"></i> Improved</h4>
    <p>The milestone pages now feature an improved responsive design</p>
    <p>Various improvements to our management tools, including flight editing and more <span class="badge badge-warning">Admin</span></p>
    <h4><i class="fal fa-fw fa-server"></i> System</h4>
    <p>Further file clean-up and other code improvements</p>
    <h4><i class="fal fa-fw fa-exchange"></i> Changed</h4>
    <p>Modernized look for tiles on the timeline sidebar and rings page</p>
    <p>Management tools have been lifted out of the UI into their own dropdown in the navbar</p>
    <p>Light has been restored as the default theme</p>
    <p>Updated radio and checkbox controls to use a custom design</p>
    <h4><i class="fal fa-fw fa-band-aid"></i> Fixed</h4>
    <p>Non-Insiders are no longer blocked from visiting the milestone platform details</p>
    <p>Fixes Holographic not showing the Fast Ring in the platform overview for a milestone</p>
    <p>The left and right border of timeline items are no longer not clickable</p>
    <p>When editing a changelog, the editor will now remember the platform instead of requiring it to be set again</p>
    <h4><i class="fal fa-fw fa-bug"></i> Known issues</h4>
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
    <h4><i class="fal fa-fw fa-band-aid"></i> Fixed</h4>
    <p>When in the profile, the profile menu will now be correctly marked as active</p>
    <p>Modals will no longer appear below the navbar</p>
    <p>The timeline sidebar no longer shows updates from older milestones as the current build</p>
    <p>Hero images now no longer appear to have no rounded corners at the bottom</p>
    <p>Removed instances where "Holographic" was incorrectly referred to as "Mixed Reality"</p>
    <h4><i class="fal fa-fw fa-bug"></i> Known issues</h4>
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
    <h4><i class="fal fa-fw fa-bug"></i> Known issues</h4>
    <p>Tiles on the timeline show a hover effect but aren't yet clickable</p>
    <p>Patrons are currently not listed on About</p>
    <p>ChangeWindows 4 URLs are not compatible with viv</p>
</section>
@endsection