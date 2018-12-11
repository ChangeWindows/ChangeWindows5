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
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/light.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/brands.min.css') }}" rel="stylesheet">
        
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
        <nav class="nav">
            <div class="nav-container">
                <a href="{{ route('timeline') }}" class="nav-brand">
                    <img src="{{ asset('img/logo_black.png') }}" />
                    <span class="title"><span class="font-light font-uppercase">Change</span><span class="font-bold font-uppercase">Windows</span> <span class="font-light">viv</span></span>
                </a>

                <a class="link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('timeline') }}"><span class="inner"><i class="fal fa-fw fa-calendar-alt"></i> Timeline</span></a>
                <!--
                <a class="link" href="/milestones"><span class="inner"><i class="fal fa-fw fa-map-signs"></i> Milestones</span></a>
                <a class="link" href="/rings"><span class="inner"><i class="fal fa-fw fa-bullseye"></i> Rings</span></a>
                -->
                <a class="link" href="https://medium.com/changewindows"><span class="inner"><i class="fab fa-fw fa-medium-m"></i> Blog</span></a>
                <a class="link {{ Request::is('viv') ? 'active' : '' }}" href="{{ route('viv') }}"><span class="inner"><i class="fal fa-fw fa-alicorn"></i> About viv</span></a>
                @auth
                    @if (Auth::user()->hasAnyRole(['Admin']))
                        <hr />
                        <a class="link {{ Request::is('changelog') ? 'active' : '' }}" href="{{ route('showChangelogs') }}"><span class="inner"><i class="fal fa-fw fa-align-left"></i> Changelogs</span></a>
                    @endif
                @endauth

                <div class="nav-bottom">
                    @auth
                        <a class="link" href="{{ route('profile') }}"><span class="inner"><i class="fal fa-fw fa-user-circle"></i> {{ Auth::user()->name }}</span></a>
                        <a class="link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="inner"><i class="fal fa-fw fa-sign-out"></i> Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="link" href="{{ route('login') }}"><span class="inner"><i class="fal fa-fw fa-sign-in"></i> Login</span></a>

                        @if (Route::has('register'))
                            <a class="link" href="{{ route('register') }}"><span class="inner"><i class="fal fa-fw fa-user-plus"></i> Register</span></a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <div class="app" id="app">
            @yield('hero')
            <main class="container-fluid">
                @yield('content')
            </main>
        </div>
        @yield('modals')
    </body>
</html>
