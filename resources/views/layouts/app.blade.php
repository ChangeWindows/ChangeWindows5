@php
    if (!Auth::check() || Auth::user()->theme == 0) {
        $theme = 'white';
        $header = 234;
    } else if (Auth::user()->theme == 1) {
        $theme = 'light';
        $header = 210;
    } else if (Auth::user()->theme == 2) {
        $theme = 'dark';
        $header = 29;
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
        @include('feed::links')

        <script src="{{ asset('js/jquery.min.js?v5.2.0') }}"></script>
        <script src="{{ asset('js/app.js?v5.2.0') }}" defer></script>
        <link href="{{ asset('css/app.css?v5.2.0') }}" rel="stylesheet">
        <script src="{{ asset('js/brands.min.js?v5.2.0') }}" defer></script>
        <script src="{{ asset('js/regular.min.js?v5.2.0') }}" defer></script>
        <script src="{{ asset('js/fontawesome.min.js?v5.2.0') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

        <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        </script>

        <link rel="shortcut icon" href="{{{ asset('img/logo.png') }}}">

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
    <body class="{{ $theme }} d-flex flex-column">
        <nav class="navbar navbar-expand bg-cw fixed-top">
            <div class="container">
                <a class="navbar-brand {{ Request::is('/') || Request::is('build/*') ? 'active' : '' }}" href="{{ route('timeline') }}">
                    <img src="{{ asset('img/logo.png') }}" />
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ Request::is('milestones*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('milestones') }}">Milestones</a>
                        </li>
                        <li class="nav-item {{ Request::is('rings*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('rings') }}">Rings</a>
                        </li>
                        <li class="nav-item dropdown {{ Request::is('buildfeed*') || Request::is('viv*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                More <i class="far fa-fw fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="https://medium.com/changewindows" target="_blank"><i class="fab fa-fw fa-medium-m"></i> Blog</a>
                                <a class="dropdown-item" href="{{ route('viv') }}"><i class="far fa-fw fa-alicorn"></i> About</a>
                                <a class="dropdown-item" href="{{ route('buildfeed') }}"><i class="far fa-fw fa-rss"></i> BuildFeed</a>
                                <div class="dropdown-divider"></div>
                                <h6 class="dropdown-header">RSS</h6>
                                <a class="dropdown-item" href="/feed"><i class="far fa-fw fa-rss-square"></i> Flight feed</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="https://github.com/ChangeWindows/Viv/"><i class="fab fa-fw fa-github"></i> GitHub</a>
                                <a class="dropdown-item" href="https://twitter.com/changewindows"><i class="fab fa-fw fa-twitter"></i> @ChangeWindows</a>
                                <a class="dropdown-item" href="https://patreon.com/changewindows"><i class="fab fa-fw fa-patreon"></i> Patreon</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item dropdown {{ Request::is('profile') || Request::is('register') || Request::is('login') || Request::is('password*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-fw fa-user-circle"></i><span class="d-none d-md-inline"> {{ Auth::user()->name }}<span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->hasAnyRole(['Admin']))
                                        @yield('toolset')
                                        <a class="dropdown-item" href="{{ route('showFlights') }}"><i class="far fa-fw fa-plane"></i> Flights</a>
                                        <a class="dropdown-item" href="{{ route('showLogs') }}"><i class="far fa-fw fa-align-left"></i> Changelogs</a>
                                        <a class="dropdown-item" href="{{ route('showUsers') }}"><i class="far fa-fw fa-users"></i> Users</a>
                                        <a class="dropdown-item" href="{{ route('showPatreon') }}"><i class="fab fa-fw fa-patreon"></i> Patrons</a>
                                        <div class="dropdown-divider"></div>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="far fa-fw fa-cog"></i> Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="far fa-fw fa-sign-out"></i> Log out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item nav-login {{ Request::is('register') || Request::is('login') || Request::is('password*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('login') }}"><i class="far fa-fw fa-sign-in"></i><span class="d-none d-sm-inline"><span></a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class="navbg"></div>
        <div class="flex-fill flex-grow-1">
            @yield('hero')
            <div class="container" id="app">
                <main class="content">
                    @yield('content')
                </main>
            </div>
        </div>
        <footer class="bg-light">
            <div class="container">
                <div class="content">
                    <div class="row mt-4 mb-4">
                        <div class="col-6">
                            <span class="h4 mb-2"><span class="font-weight-bold">ChangeWindows</span></span>
                            <p class="mb-0">{{ config('app.viv') }} &middot; 2014-2020 &copy; <a href="https://studio384.be">.384</a></p>
                        </div>
                        <div class="col-6 text-right">
                            <a href="https://studio384.be" class="h4 f-gilroy font-weight-bold">.<span class="luna">384</span></a>
                        </div>
                        <div class="col-12 text-right">
                            <span class="m-0">
                                <a href="https://patreon.com/changewindows"><i class="fab fa-fw fa-patreon"></i></a>
                                <a href="https://github.com/changewindows"><i class="fab fa-fw fa-github"></i></a>
                                <a href="https://medium.com/changewindows"><i class="fab fa-fw fa-medium"></i></a>
                                <a href="https://twitter.com/changewindows"><i class="fab fa-fw fa-twitter"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
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

        @yield('scripts')
    </body>
</html>
