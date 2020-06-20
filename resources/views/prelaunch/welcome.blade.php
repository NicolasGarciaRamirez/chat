<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Noisesharks</title>
    <meta name="theme-color" content="#0d0d0d">
    <meta property="og:title" content="Noisesharks - Search For and Hire Audio Professionals, Musicians, Composers, Songwriters, Tutors, DJs, and Studios">
    <meta name="twitter:title" content="Noisesharks - Search For and Hire Audio Professionals, Musicians, Composers, Songwriters, Tutors, DJs, and Studios">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/prelounch/favicon/favicon-152x152.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/prelounch/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/prelounch/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="{{ mix('/css/prelaunch/prelaunch.css')  }}">
</head>
<body>
<header class="main-header">
    <div class="information">
        <h5 class="text-center font-weight-bold">THE LAUNCH YOU DON’T WANT TO MISS</h5>
        <h5 class="text-center font-weight-bold" id="text-time"></h5>
    </div>
    <img src="/images/prelounch/logo-border-black.svg" alt="logo" class="logo">
</header>
<main id="app">
    <section class="header-info">
        <p class="titul pt-3 font-weight-bold my-lg-5">THE SOCIAL PLATFORM FOR MUSICIANS & MUSIC CONTENT CREATORS</p>
        <div class="row">
            <div class="col-sm-12 col-md-4 text-center information mb-3 my-lg-5">
                <img src="/images/prelounch/financially_support.svg" alt="financially_support">
                <p class="c-fourth m-0 font-weight-bold mt-lg-4">FINANCIALLY SUPPORT</p>
                <p class="text-white m-0">CONTENT CREATORS & MUSICIANS</p>
            </div>
            <div class="col-sm-12 col-md-4 text-center information mb-3 my-lg-5">
                <img src="/images/prelounch/post_live_stream.svg" alt="post_live_stream">
                <p class="c-fourth m-0 font-weight-bold mt-lg-4">POST & LIVE STREAM</p>
                <p class="text-white m-0">YOUR CONTENT & MUSIC</p>
            </div>
            <div class="col-sm-12 col-md-4 text-center information mb-3 my-lg-5">
                <img src="/images/prelounch/socialise_interact.svg" alt="socialise_interact">
                <p class="c-fourth m-0 font-weight-bold mt-lg-4">SOCIALISE & INTERACT</p>
                <p class="text-white m-0">WITH OTHER MUSICIANS & CONTENT CREATORS <br> OF THE SAME INTEREST</p>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('prelaunch') }}" class="form form-inline position-relative d-flex justify-content-center my-3 my-lg-5" method="post">
            @csrf
            <div class="form-group mb-2 mb-md-0">
                <input type="email" name="email" class="form-control" placeholder="Type Email..." required>
            </div>
            <button type="submit" class="btn text-white font-weight-bold ml-md-4">GET ME ON THE WAITING LIST</button>
        </form>
    </section>
    <div class="sound_icon">
        <img src="/images/prelounch/sound_icon.svg" alt="">
    </div>
    <section class="content-creators">
        <p class="titul my-5 font-weight-bold text-center">WHO DO WE MEAN BY <br> MUSIC CONTENT CREATORS?</p>
        <div class="information">
            <p class="ml-1 my-5">MUSIC INDUSTRY YOUTUBERS</p>
            <p class="ml-2 my-5">CREATORS OF MUSIC/PRODUCTION TIPS & LESSONS</p>
            <p class="ml-3 my-5">ONLINE MUSIC TEACHERS WANTING TO GET SUPPORTED BY THEIR STUDENTS</p>
            <p class="ml-4 my-5">BANDS AND ARTISTS WANTING TO GET DIRECT FINANCIAL SUPPORT BY THEIR FANS</p>
            <p class="ml-5 my-5">HOME MUSICIANS THAT WANT TO IMPROVISE AND JAM TO A GENRE SPECIFIC AUDIENCE</p>
        </div>
    </section>
    <div class="sound_icon">
        <img src="/images/prelounch/sound_icon.svg" alt="">
    </div>
    <section class="sneak-peak">
        <p class="titul text-center my-5 font-weight-bold">SNEAK PEEK</p>
        @include('prelaunch._carrousel')
    </section>
    <div class="sound_icon">
        <img src="/images/prelounch/sound_icon.svg" alt="">
    </div>
    <section class="enjoy-music">
        <div class="titul my-5">
            <p class="m-0 text-center">IF YOU ENJOY MUSIC</p>
            <p class="m-0 text-center font-up font-weight-bold">DON'T LEAVE YOURSELF BEHIND!</p>
        </div>
        <div class="text-center my-5">
            <button type="submit" class="btn font-weight-bold">GET ME ON THE WAITING LIST</button>
        </div>
    </section>
</main>
<footer class="footer">
    <div class="information">
        <img src="/images/prelounch/logo-white.svg" alt="">
    </div>
    <div class="social-media">
        <div class="icons">
            <a href="https://www.facebook.com/noisesharks/" target="new">
                <img src="/images/prelounch/facebook.svg" alt="facebook">
            </a>
            <a href="https://twitter.com/noisesharks" target="new">
                <img src="/images/prelounch/twitter.svg" alt="twitter">
            </a>
            <a href="https://www.instagram.com/noisesharks/" target="new">
                <img src="/images/prelounch/instagram.svg" alt="instagram">
            </a>
        </div>
        <p class="text-right mt-md-4">© 2019 Noisesharks ® Registered in England and Wales No. 10670071</p>
    </div>
</footer>
<script src="{{ mix('/js/prelaunch/prelaunch.js') }}"></script>
<script>
    var end = new Date('07/04/2020 12:00 AM');
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('text-time').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('text-time').innerHTML = `${days} DAYS : ${hours} HRS : ${minutes} MINS : ${seconds} SEC`;

    }

    timer = setInterval(showRemaining, 1000);

</script>
</body>
</html>
