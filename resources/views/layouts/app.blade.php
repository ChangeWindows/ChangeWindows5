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
        
        <script>
            if ( typeof Windows !== 'undefined' ) {
                var titleBar = Windows.UI.ViewManagement.ApplicationView.getForCurrentView().titleBar;

                titleBar.backgroundColor = {a: 255, r: 232, g: 232, b: 232};
                titleBar.inactiveBackgroundColor = {a: 255, r: 232, g: 232, b: 232};
                titleBar.buttonBackgroundColor = {a: 255, r: 232, g: 232, b: 232};
                titleBar.buttonInactiveBackgroundColor  = {a: 255, r: 232, g: 232, b: 232};
                titleBar.buttonHoverBackgroundColor = {a: 255, r: 219, g: 219, b: 219};
                titleBar.buttonPressedBackgroundColor = {a: 255, r: 203, g: 203, b: 203};
            }
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('timeline') }}">
                <img src="{{ asset('img/logo_black.png') }}" />
                <span class="title"><span class="font-light font-uppercase">Change</span><span class="font-bold font-uppercase">Windows</span> <span class="font-light">viv</span></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('timeline') }}"><i class="fal fa-fw fa-calendar-alt"></i> Timeline</a>
                    </li>
                    <!--
                        <li class="nav-item">
                            <a class="nav-link" href="/milestones"><i class="fal fa-fw fa-map-signs"></i> Milestones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/rings"><i class="fal fa-fw fa-bullseye"></i> Rings</a>
                        </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="https://medium.com/changewindows"><i class="fab fa-fw fa-medium-m"></i> Blog</a>
                    </li>
                    <li class="nav-item {{ Request::is('viv') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('viv') }}"><i class="fal fa-fw fa-alicorn"></i> About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @auth
                                <i class="fal fa-fw fa-user-circle"></i> {{ Auth::user()->name }}
                            @else
                                <i class="fal fa-fw fa-sign-in"></i> Login
                            @endauth
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @auth
                                <a class="dropdown-item" href="{{ route('profile') }}"><i class="fal fa-fw fa-user-circle"></i> {{ Auth::user()->name }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fal fa-fw fa-sign-out"></i> Log out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @else
                                
                                <a class="dropdown-item" href="{{ route('register') }}"><i class="fal fa-fw fa-user-plus"></i> Register</a>
                                <a class="dropdown-item" href="{{ route('login') }}"><i class="fal fa-fw fa-sign-in"></i> Login</a>
                            @endauth
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="https://github.com/ChangeWindows/Viv/issues/new"><i class="fab fa-fw fa-github"></i> Give Feedback</a>
                            @auth
                                @if (Auth::user()->hasAnyRole(['Admin']))
                                    <div class="dropdown-divider"></div>
                                    <h6 class="dropdown-header">Manage</h6>
                                    <a class="dropdown-item" href="{{ route('showFlights') }}"><i class="fal fa-fw fa-plane"></i> Flights</a>
                                    <a class="dropdown-item" href="{{ route('showChangelogs') }}"><i class="fal fa-fw fa-align-left"></i> Changelogs</a>
                                    <a class="dropdown-item" href="{{ route('showChangelogs') }}"><i class="fal fa-fw fa-users"></i> Users</a>
                                @endif
                            @endauth
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container" id="app">
            @yield('hero')
            <main class="container-fluid">
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
