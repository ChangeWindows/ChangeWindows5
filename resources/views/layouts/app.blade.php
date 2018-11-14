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
</head>
<body>
    <nav class="nav">
        <div class="nav-container">
            <div class="brand">
                <span class="font-light font-uppercase">Change</span><span class="font-bold font-uppercase">Windows</span> viv
            </div>

            <a class="link" href="/"><span class="inner">Timeline</span></a>
            <a class="link" href="/milestones"><span class="inner">Milestones</span></a>
            <a class="link" href="/rings"><span class="inner">Rings</span></a>
            <a class="link" href="/blog"><span class="inner">Blog</span></a>
            <a class="link" href="/profile"><span class="inner">Profile</span></a>
        </div>
    </nav>

    <div class="app">
        <main class="container-fluid">
            @yield('content')
        </main>
    </div>
</body>
</html>
