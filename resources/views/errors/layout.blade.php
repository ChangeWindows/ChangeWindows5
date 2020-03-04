<!doctype html>
<html lang="en">
    <head>
        <title>@yield('title')</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        html {
            line-height: 1.15;
        }

        body {
            margin: 0;
        }

        a {
            background-color: transparent;
            -webkit-text-decoration-skip: objects;
        }

        .btn {
            padding: 12px 20px;
            transition: all .5s;
            border-radius: 3px;
            color: #fff;
            background: #ff4355;
            text-decoration: none;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .btn:hover {
            color: #fff;
            text-decoration: none;
        }

        html {
            box-sizing: border-box;
            font-family: sans-serif;
        }

        p {
            margin: 0;
        }

        .bg-white {
            background-color: #fff;
        }

        .bg-line {
            background-color: #ff4355;
        }

        .bg-no-repeat {
            background-repeat: no-repeat;
        }

        .bg-cover {
            background-size: cover;
        }

        .hidden {
            display: none;
        }

        .flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .font-sans {
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        }

        .font-bold {
            font-weight: 700;
            color: #333;
        }

        .h-1 {
            height: .25rem;
        }

        .leading-normal {
            line-height: 1.5;
        }

        .m-8 {
            margin: 2rem;
        }

        .my-3 {
            margin-top: .75rem;
            margin-bottom: .75rem;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .max-w-sm {
            max-width: 30rem;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .py-3 {
            padding-top: .75rem;
            padding-bottom: .75rem;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .pb-full {
            padding-bottom: 100%;
        }

        .absolute {
            position: absolute;
        }

        .relative {
            position: relative;
        }

        .pin {
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        .text-black {
            color: #22292f;
        }

        .text-grey-darkest {
            color: #3d4852;
        }

        .text-grey-darker {
            color: #606f7b;
        }

        .text-2xl {
            font-size: 1.5rem;
        }

        .text-5xl {
            font-size: 3rem;
        }

        .tracking-wide {
            letter-spacing: .05em;
        }

        .w-16 {
            width: 4rem;
        }

        .w-full {
            width: 100%;
        }

        @media (min-width: 768px) {
            .md\:bg-left {
                background-position: left;
            }

            .md\:bg-right {
                background-position: right;
            }

            .md\:flex {
                display: flex;
            }

            .md\:my-6 {
                margin-top: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .md\:min-h-screen {
                min-height: 100vh;
            }

            .md\:pb-0 {
                padding-bottom: 0;
            }

            .md\:text-3xl {
                font-size: 1.875rem;
            }

            .md\:text-15xl {
                font-size: 9rem;
            }

            .md\:w-1\/2 {
                width: 50%;
            }
        }

        @media (min-width: 992px) {
            .lg\:bg-center {
                background-position: center;
            }
        }
        </style>
    </head>
    <body class="font-sans">
        <div class="md:flex min-h-screen">
            <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
                <div class="max-w-sm m-8">
                    <div class="text-5xl md:text-15xl font-bold">
                        @yield('code', 'Oh no')
                    </div>

                    <div class="w-16 h-1 bg-line my-3 md:my-6"></div>

                    <p class="text-grey-darker text-2xl md:text-3xl mb-8 leading-normal">
                        @yield('message')
                    </p>

                    <a href="{{ route('timeline') }}" class="btn">Timeline</a>
                </div>
            </div>

            <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
                <div style="background-image: url({{ asset('/img/background.png') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
            </div>
        </div>
    </body>
</html>
