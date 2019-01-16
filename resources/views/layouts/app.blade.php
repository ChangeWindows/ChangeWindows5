<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>ChangeWindows</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="shortcut icon" href="{{{ asset('img/favicon.png') }}}">

        <meta name="format-detection" content="telephone=no">
        
        <script>
            if ( typeof Windows !== 'undefined' ) {
                let titleBar = Windows.UI.ViewManagement.ApplicationView.getForCurrentView().titleBar;
                let tbc = {{ Auth::check() && Auth::user()->theme <= 1 ? 235 : 40 }}

                titleBar.backgroundColor = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.inactiveBackgroundColor = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.buttonBackgroundColor = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.buttonInactiveBackgroundColor  = {a: 255, r: tbc, g: tbc, b: tbc};
                titleBar.buttonHoverBackgroundColor = {a: 255, r: tbc + 10, g: tbc + 10, b: tbc + 10};
                titleBar.buttonPressedBackgroundColor = {a: 255, r: tbc - 10, g: tbc - 10, b: tbc - 10};
            }
        </script>
    </head>
    <body class="{{ Auth::check() && Auth::user()->theme <= 1 ? 'light' : 'dark' }}">
        <nav class="navbar navbar-expand bg-cw fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('timeline') }}">
                    <img src="{{ Auth::check() && Auth::user()->theme <= 1 ? asset('img/logo_black.png') : asset('img/logo_white.png') }}" />
                    <span class="title"><span class="font-light">viv</span></span>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::is('/') || Request::is('build/*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('timeline') }}"><i class="fal fa-fw fa-calendar-alt"></i> Timeline</a>
                        </li>
                        @auth
                            @if (Auth::user()->hasAnyRole(['Admin', 'Insider']))
                                <li class="nav-item {{ Request::is('milestones*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('milestones') }}"><i class="fal fa-fw fa-map-signs"></i> Milestones</a>
                                </li>
                            @endif
                        @endauth
                        <!--
                            <li class="nav-item">
                                <a class="nav-link" href="/rings"><i class="fal fa-fw fa-bullseye"></i> Rings</a>
                            </li>
                        -->
                        <li class="nav-item d-none d-sm-inline-block">
                            <a class="nav-link" href="https://medium.com/changewindows"><i class="fab fa-fw fa-medium-m"></i> Blog</a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block {{ Request::is('viv') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('viv') }}"><i class="fal fa-fw fa-alicorn"></i> About</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown {{ Request::is('profile*') || Request::is('buildfeed*') ? 'active' : '' }}">
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
                                <h6 class="dropdown-header">More</h6>
                                <a class="dropdown-item" href="{{ route('buildfeed') }}"><i class="fal fa-fw fa-rss"></i> BuildFeed data</a>
                                <div class="dropdown-divider d-block d-sm-none"></div>
                                <a class="dropdown-item d-block d-sm-none" href="https://medium.com/changewindows"><i class="fab fa-fw fa-medium-m"></i> Blog</a>
                                <a class="dropdown-item d-block d-sm-none" href="{{ route('viv') }}"><i class="fal fa-fw fa-alicorn"></i> About</a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">Preview</h6>
                                <a class="dropdown-item" href="https://github.com/ChangeWindows/Viv/issues/new?assignees=&labels=bug&template=bug_report.md&title="><i class="fal fa-fw fa-bug"></i> Report a bug</a>
                                <a class="dropdown-item" href="https://github.com/ChangeWindows/Viv/issues/new?assignees=&labels=&template=feature_request.md&title="><i class="fal fa-fw fa-box-heart"></i> Request a feature</a>
                                @auth
                                    @if (Auth::user()->hasAnyRole(['Admin']))
                                        <div class="dropdown-divider"></div>
                                        <h6 class="dropdown-header">Manage</h6>
                                        <a class="dropdown-item" href="{{ route('showFlights') }}"><i class="fal fa-fw fa-plane"></i> Flights</a>
                                        <a class="dropdown-item" href="{{ route('showChangelogs') }}"><i class="fal fa-fw fa-align-left"></i> Changelogs</a>
                                        <a class="dropdown-item" href="{{ route('showUsers') }}"><i class="fal fa-fw fa-users"></i> Users</a>
                                    @endif
                                @endauth
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
