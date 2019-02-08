@php
    if (!Auth::check() || Auth::user()->theme == 0) {
        $theme = 'white';
        $header = 234;
    } else if (Auth::user()->theme == 1) {
        $theme = 'light';
        $header = 210;
    } else if (Auth::user()->theme == 2) {
        $theme = 'dark';
        $header = 47;
    } else if (Auth::user()->theme == 3) {
        $theme = 'black';
        $header = 21;
    }
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') &middot; ChangeWindows</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">

        <meta name="format-detection" content="telephone=no">
        
        <script>
            if ( typeof Windows !== 'undefined' ) {
                let titleBar = Windows.UI.ViewManagement.ApplicationView.getForCurrentView().titleBar;
                let tbc = {{ $header }};

                titleBar.backgroundColor = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.inactiveBackgroundColor = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.buttonBackgroundColor = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.buttonInactiveBackgroundColor  = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.buttonHoverBackgroundColor = {a: 255, r: tbc + 10, g: tbc + 10, b: tbc + 10};
                titleBar.buttonPressedBackgroundColor = {a: 255, r: tbc - 10, g: tbc - 10, b: tbc - 10};
            }
        </script>
    </head>
    <body class="{{ $theme }}">
        <nav class="navbar navbar-expand bg-cw fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('timeline') }}">
                    <img src="{{ Auth::check() && Auth::user()->theme >= 2 ? asset('img/logo_white.png') : asset('img/logo_black.png') }}" />
                    <span class="title"><span class="font-light">viv</span></span>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::is('/') || Request::is('build/*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('timeline') }}">Timeline</a>
                        </li>
                        <li class="nav-item {{ Request::is('milestones*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('milestones') }}">Milestones</a>
                        </li>
                        <li class="nav-item {{ Request::is('rings*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('rings') }}">Rings</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a class="nav-link" href="https://medium.com/changewindows" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block {{ Request::is('viv*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('viv') }}">About</a>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('buildfeed*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                More <i class="fal fa-fw fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('buildfeed') }}"><i class="fal fa-fw fa-rss"></i> BuildFeed data</a>
                                <div class="dropdown-divider d-block d-sm-none"></div>
                                <a class="dropdown-item d-block d-sm-none" href="https://medium.com/changewindows" target="_blank"><i class="fab fa-fw fa-medium-m"></i> Blog</a>
                                <a class="dropdown-item d-block d-sm-none" href="{{ route('viv') }}"><i class="fal fa-fw fa-alicorn"></i> About</a>
                                <div class="dropdown-divider d-block"></div>
                                <a class="dropdown-item" href="https://twitter.com/changewindows"><i class="fab fa-fw fa-twitter"></i> @ChangeWindows</a>
                                <a class="dropdown-item" href="https://patreon.com/changewindows"><i class="fab fa-fw fa-patreon"></i> Patreon</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            @if (Auth::user()->hasAnyRole(['Admin']))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fal fa-fw fa-tachometer d-inline"></i><span class="d-none d-sm-inline"> Manage<span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @yield('toolset')
                                        <a class="dropdown-item" href="{{ route('showFlights') }}"><i class="fal fa-fw fa-plane"></i> Flights</a>
                                        <a class="dropdown-item" href="{{ route('showChangelogs') }}"><i class="fal fa-fw fa-align-left"></i> Changelogs</a>
                                        <a class="dropdown-item" href="{{ route('showUsers') }}"><i class="fal fa-fw fa-users"></i> Users</a>
                                        <a class="dropdown-item" href="{{ route('showPatreon') }}"><i class="fab fa-fw fa-patreon"></i> Patrons</a>
                                    </div>
                                </li>
                            @endif
                        @endauth
                        <li class="nav-item dropdown {{ Request::is('profile') || Request::is('register') || Request::is('login') || Request::is('password*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @auth
                                    <i class="fal fa-fw fa-user-circle d-inline"></i><span class="d-none d-sm-inline"> {{ Auth::user()->name }}<span>
                                @else
                                    <i class="fal fa-fw fa-sign-in d-inline"></i><span class="d-none d-sm-inline"> Login<span>
                                @endauth
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @auth
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="fal fa-fw fa-cog"></i> Settings</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('register') }}"><i class="fal fa-fw fa-user-plus"></i> Register</a>
                                    <a class="dropdown-item" href="{{ route('login') }}"><i class="fal fa-fw fa-sign-in"></i> Login</a>
                                @endauth
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">Preview</h6>
                                <a class="dropdown-item" href="https://github.com/ChangeWindows/Viv/issues/new?assignees=&labels=bug&template=bug_report.md&title="><i class="fal fa-fw fa-bug"></i> Report a bug</a>
                                <a class="dropdown-item" href="https://github.com/ChangeWindows/Viv/issues/new?assignees=&labels=&template=feature_request.md&title="><i class="fal fa-fw fa-box-heart"></i> Request a feature</a>
                                @auth
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-fw fa-sign-out"></i> Log out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="navbg"></div>
        @yield('hero')
        <div class="container" id="app">
            <main class="content">
                @yield('content')
            </main>
        </div>
        <footer class="text-center">
            <hr />
            <span class="font-uppercase font-light">Change</span><span class="font-uppercase font-bold">Windows</span> <span class="font-light">viv</span> {{ config('app.viv') }} &middot; 2014-2019 &copy; <a href="https://studio384.be">Studio384</a>
        </footer>
        @yield('modals')
		<!-- Matomo -->
		<script type="text/javascript">
			var _paq = _paq || [];
			/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
			_paq.push(['trackPageView']);
			_paq.push(['enableLinkTracking']);
			(function() {
				var u="//changewindows.org/stats/";
				_paq.push(['setTrackerUrl', u+'piwik.php']);
				_paq.push(['setSiteId', '1']);
				var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
				g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
			})();
		</script>
		<!-- End Matomo Code -->
    </body>
</html>
