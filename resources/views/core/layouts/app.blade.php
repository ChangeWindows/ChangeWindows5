<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>@yield('title') &middot; ChangeWindows</title>

        <script src="{{ asset('js/bootstrap.bundle.min.js?v5.2.0') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/admin.css?v'.config('app.viv')) }}" rel="stylesheet">
        <link href="{{ asset('css/easymde.min.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('img/logo.png?v'.config('app.viv')) }}">
    </head>
    <body>
        <header class="bg-top">
            <div class="container">
                <div class="header-bar d-flex flex-row align-items-center py-4">
                    <h1 class="m-0 flex-grow-1 fw-bolder">ChangeWindows</h1>

                    <div class="core-bar d-flex flex-row align-items-center">
                        <a class="core-bar-action d-none d-sm-flex" href="{{ route('timeline') }}">
                            <i class="far fa-fw fa-home"></i>
                        </a>
                        <a class="core-bar-action d-none d-sm-flex" href="http://changewindows.org/stats/index.php">
                            <i class="far fa-fw fa-chart-pie"></i>
                        </a>
                        <a class="core-bar-action d-none d-sm-flex" href="{{ route('admin.search') }}">
                            <i class="far fa-fw fa-search"></i>
                        </a>
                        <div class="dropdown">
                            <a class="core-bar-action core-bar-action-account dropdown-toggle" href="#" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p>{{ Auth::user()->name }}</p>
                                <img class="rounded-circle" src="{{ Auth::user()->avatar }}" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item d-block d-sm-none" href="{{ route('timeline') }}"><i class="far fa-fw fa-home"></i> Home</a>
                                <a class="dropdown-item d-block d-sm-none" href="http://changewindows.org/stats/index.php"><i class="far fa-fw fa-chart-pie"></i> Stats</a>
                                <a class="dropdown-item d-block d-sm-none" href="{{ route('admin.search') }}"><i class="far fa-fw fa-search"></i> Search</a>
                                <a class="dropdown-item" href="{{ route('front.profile') }}"><i class="far fa-fw fa-user-cog"></i> Profile</a>
                                <x-logout class="dropdown-item"><i class="far fa-fw fa-sign-out"></i> Sign out</x-logout>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="far fa-fw fa-bars"></i>
                    </button>

                    <form class="d-flex shadow rounded order-1 order-lg-2" action="{{ route('admin.search.find') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input class="form-control border-0" type="search" name="search" placeholder="Search..." aria-label="Search..." accesskey="s">
                            <button class="btn btn-primary" type="submit"><i class="far fa-fw fa-search"></i></button>
                        </div>
                    </form>
                    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            @canany (['show_milestones', 'show_flights', 'show_logs'])
                                <li class="nav-item dropdown {{ request()->routeIs('admin.milestones*') || request()->routeIs('admin.flights*') || request()->routeIs('admin.changelogs*') || request()->routeIs('admin.platforms*') || request()->routeIs('admin.channels*') ? 'active' : '' }}">
                                    <a class="nav-link dropdown-toggle" href="#" id="websiteDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Content <i class="far fa-angle-down ms-1"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="websiteDropdown">
                                        @can('show_milestones')<a class="dropdown-item {{ request()->routeIs('admin.milestones*') ? 'active' : '' }}" href="{{ route('admin.milestones') }}"><i class="far fa-fw fa-map-signs"></i> Milestones</a>@endcan
                                        @can('show_flights')<a class="dropdown-item {{ request()->routeIs('admin.flights*') ? 'active' : '' }}" href="{{ route('admin.flights') }}"><i class="far fa-fw fa-plane"></i> Flights</a>@endcan
                                        @can('show_logs')<a class="dropdown-item {{ request()->routeIs('admin.changelogs*') ? 'active' : '' }}" href="{{ route('admin.changelogs') }}"><i class="far fa-fw fa-align-left"></i> Changelogs</a>@endcan
                                        @can('show_platforms')<a class="dropdown-item {{ request()->routeIs('admin.platforms*') ? 'active' : '' }}" href="{{ route('admin.platforms') }}"><i class="far fa-fw fa-phone-laptop"></i> Platforms</a>@endcan
                                        @can('show_channels')<a class="dropdown-item {{ request()->routeIs('admin.channels*') ? 'active' : '' }}" href="{{ route('admin.channels') }}"><i class="far fa-fw fa-code-branch"></i> Channels</a>@endcan
                                    </div>
                                </li>
                            @endcanany
                            @canany (['show_users', 'show_roles', 'show_abilities'])
                                <li class="nav-item dropdown {{ request()->routeIs('admin.accounts*') || request()->routeIs('admin.members*') || request()->routeIs('admin.accounts*') || request()->routeIs('admin.roles*') || request()->routeIs('admin.abilities*') ? 'active' : '' }}">
                                    <a class="nav-link dropdown-toggle" href="#" id="websiteDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Users <i class="far fa-angle-down ms-1"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="websiteDropdown">
                                        @can('show_users')<a class="dropdown-item {{ request()->routeIs('admin.accounts*') ? 'active' : '' }}" href="{{ route('admin.accounts') }}"><i class="far fa-fw fa-user-friends"></i> Accounts</a>@endcan
                                        <div class="dropdown-divider"></div>
                                        @can('show_roles')<a class="dropdown-item {{ request()->routeIs('admin.roles*') ? 'active' : '' }}" href="{{ route('admin.roles') }}"><i class="far fa-fw fa-user-tag"></i> Roles</a>@endcan
                                        @can('show_abilities')<a class="dropdown-item {{ request()->routeIs('admin.abilities*') ? 'active' : '' }}" href="{{ route('admin.abilities') }}"><i class="far fa-fw fa-tags"></i> Permissions</a>@endcan
                                    </div>
                                </li>
                            @endcanany
                            @canany (['view_settings'])
                                <li class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('admin.settings') }}">Settings</a>
                                </li>
                            @endcanany
                            <li class="nav-item {{ request()->routeIs('admin.about') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.about') }}">About</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
            <div class="content">
                @yield('content')
            </div>
            <footer>
                <span class="text-guide">ChangeWindows</span> {{ config('app.viv') }} &copy; 2014-2021
            </footer>
        </div>
        @yield('scripts')
        <script>
            let scrollpos = window.scrollY
            const header = document.querySelector(".page-bar")
            const header_height = 166

            const add_class_on_scroll = () => header.classList.add('flowing')
            const remove_class_on_scroll = () => header.classList.remove('flowing')

            window.addEventListener('scroll', function() {
              scrollpos = window.scrollY;

              if (scrollpos >= header_height) { add_class_on_scroll() }
              else { remove_class_on_scroll() }
            })
        </script>
        <script src="{{ asset('js/brands.min.js') }}" defer></script>
        <script src="{{ asset('js/regular.min.js') }}" defer></script>
        <script src="{{ asset('js/fontawesome.min.js') }}" defer></script>
        <script src="{{ asset('js/alpine.js') }}"></script>
        <script src="{{ asset('js/easymde.min.js') }}"></script>
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
    </body>
</html>
