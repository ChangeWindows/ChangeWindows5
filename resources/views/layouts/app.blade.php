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
</head>
<body>
    <nav class="nav">
        <div class="nav-container">
            <div class="brand">
                <span class="font-light font-uppercase">Change</span><span class="font-bold font-uppercase">Windows</span> viv
            </div>

            <a class="link" href="/"><span class="inner"><i class="fal fa-fw fa-calendar"></i> Timeline</span></a>
            <a class="link" href="/milestones"><span class="inner"><i class="fal fa-fw fa-map-signs"></i> Milestones</span></a>
            <a class="link" href="/rings"><span class="inner"><i class="fal fa-fw fa-bullseye"></i> Rings</span></a>
            <a class="link" href="/blog"><span class="inner"><i class="fal fa-fw fa-megaphone"></i> Blog</span></a>

            <div class="nav-bottom">
                @auth
                    <a class="link" href="/profile"><span class="inner"><i class="fal fa-fw fa-user-circle"></i> {{ Auth::user()->name }}</span></a>
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

    <div class="app">
        @yield('hero')
        <main class="container-fluid">
            @yield('content')
        </main>
    </div>
</body>
</html>
