<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content= "width=device-width, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>🎹🦈Noisesharks</title>
    {{--    metas para que se personalicen los links del perfil --}}
    @yield('metas')
    <meta name="description" content="Where music content creators and streamers financially support, interact, and discover each other!" />
    <meta name="theme-color" content="#0d0d0d">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/favicon-152x152.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="{{ mix('/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-177279278-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-177279278-1');
</script>
</head>
<body class="c-app">
    <div hidden>
        @include('template._icons')
    </div>
    @php
        isset($is_login_view) ? $is_login_view = true : $is_login_view = false;
        if(Session::get('message_same_email')){
            $message = Session::get('message_same_email');
            $is_login_view = false;
        }else{
            $message = null;
        }
    @endphp
    <div id="app" class="w-100">
        @include('template._nav')
        <div class="c-wrapper">
            @include('template._header')
            <div class="c-body">
                @include('Payments.alert')
                <main class="c-main pt-0">
                    @yield('content')
                    <login is_login_view="{{ $is_login_view }}" message="{{ $message }}"></login>
                </main>
            </div>
        </div>
        <div class="d-flex d-lg-none fixed-bottom" style="z-index: 999;">
            @include('template._navFooter')
        </div>
        <section>
            <modal-contributor />
        </section>

        @if(\Auth::check())
            <section>
                <modal-relathions ref="modalRelathion"/>
            </section>
            <section>
                <modal-stripe ref="modalStripe" state="account_connect_initial" />
            </section>
            <section>
                <modal-marketing ref="modalMyMarketing"></modal-marketing>
            </section>
            <section>
                <modal-get-more-credit :user="{{ $user }}" ref="ModalGetMoreCredit"> </modal-get-more-credit>
                <modal-credit-first-post ref="CreditFirstPost"/>
            </section>
            <section>
                <modal-credit ref="ModalGetMyCredit" :user="{{\Auth::check() ? \Auth::user() : ''}}"> </modal-credit>
            </section>
            <section>
                <modal-comming-soon></modal-comming-soon>
            </section>
        @endif
        <section>
            <modal-for-music />
        </section>
        <section>
            <modal-merch />
        </section>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
{{--    <script src=`https://www.google.com/recaptcha/api.js?render={{env('GOOGLE_CAPTCHA_PUBLIC')}}`></script>--}}
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ mix('/js/scrollAutoPlay/jquery.visible.js') }}" ></script>
    <script src="{{ mix('/js/scrollAutoPlay/scrolltoplay.js') }}" ></script>
    @yield('js')

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
