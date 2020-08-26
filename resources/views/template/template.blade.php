<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content= "width=device-width, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Noisesharks</title>
    <meta name="theme-color" content="#0d0d0d">
    <meta property="og:title" content="Noisesharks - Search For and Hire Audio Professionals, Musicians, Composers, Songwriters, Tutors, DJs, and Studios">
    <meta name="twitter:title" content="Noisesharks - Search For and Hire Audio Professionals, Musicians, Composers, Songwriters, Tutors, DJs, and Studios">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/favicon-152x152.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body class="c-app">
    @php
        isset($is_login_view) ? $is_login_view = true : $is_login_view = false;
    @endphp
    <div id="app" class="w-100">
        @include('template._nav')
        <div class="c-wrapper">
            <div class="c-body">
                @include('template._header')
                <main class="c-main">
                    @yield('content')
                    <login is_login_view="{{ $is_login_view }}" />
                </main>
                {{-- <div>
                    <modal-contributor-signup />
                </div> --}}

            </div>
        </div>
        <div class="d-flex d-lg-none fixed-bottom" style="z-index: 999;">
            @include('template._navFooter')
        </div>
        <section>
            <modal-contributor />
        </section>
        <section>
            <modal-relathions ref="modalRelathion"/>
        </section>
        <section>
            <modal-for-music />
        </section>
        <section>
            <modal-merch />
        </section>
    </div>
    @yield('js')
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        document.documentElement.addEventListener('touchmove', function (event) {
            event.preventDefault();
        }, false);
    </script>
    <script>
        window.paceOptions = {
            ajax: {
                    trackMethods: ['GET', 'POST', 'DELETE', 'PUT', 'PATCH']
            }
        }
    </script>
    <script src="{{ asset('/js/pace.min.js') }}" charset="utf-8"></script>
    @stack('scripts')
</body>
</html>
