<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ChangeWindows</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636363;
                font-family: 'Segoe UI';
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .light {
                font-weight: 300;
                text-transform: uppercase;
            }

            .bold {
                font-weight: 700;
                text-transform: uppercase;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <span class="light">Change</span><span class="bold">Windows</span> viv
                </div>

                <div class="links">
                    <a href="https://changewindows.org">ChangeWindows</a>
                    <a href="https://twitter.com/changewindows">Twitter</a>
                    <a href="https://changewindows.medium.com">Blog</a>
                    <a href="https://github.com/changewindows/viv">GitHub</a>
                    <a href="https://github.com/changewindows/viv/releases">5.0</a>
                </div>
            </div>
        </div>
    </body>
</html>
