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
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/favicon-152x152.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
        <link rel="stylesheet" href="{{ mix('/css/app.css')  }}">
    </head>
    <body>
        <header class="main-header">
            <div class="information">
                <h5 class="text-center font-weight-bold">THE LAUNCH YOU DON’T WANT TO MISS</h5>
                <h5 class="text-center font-weight-bold">60 DAYS : 24 HRS : 60 MINS : 60 SEC</h5>
            </div>
            <img src="/images/logo-border-black.svg" alt="logo" class="logo">
        </header>
        <main id="app">
            <section class="header-info">
                <p class="titul pt-3 font-weight-bold my-lg-5">THE SOCIAL PLATFORM FOR MUSICIANS & MUSIC CONTENT CREATORS</p>
                <div class="row">
                    <div class="col-sm-12 col-md-4 text-center information mb-3 my-lg-5">
                        <img src="/images/piggy_banks.svg" alt="piggy_banks">
                        <p class="c-fourth m-0 font-weight-bold mt-lg-4">FINANCIALLY SUPPORT</p>
                        <p class="text-white m-0">CONTENT CREATORS & MUSICIANS</p>
                    </div>
                    <div class="col-sm-12 col-md-4 text-center information mb-3 my-lg-5">
                        <img src="/images/live_stream.svg" alt="piggy_banks">
                        <p class="c-fourth m-0 font-weight-bold mt-lg-4">POST & LIVE STREAM</p>
                        <p class="text-white m-0">YOUR CONTENT & MUSIC</p>
                    </div>
                    <div class="col-sm-12 col-md-4 text-center information mb-3 my-lg-5">
                        <img src="/images/piggy_banks.svg" alt="piggy_banks">
                        <p class="c-fourth m-0 font-weight-bold mt-lg-4">SOCIALISE & INTERACT</p>
                        <p class="text-white m-0">WITH OTHER MUSICIANS & CONTENT CREATORS <br> OF THE SAME INTEREST</p>
                    </div>
                </div>

                <form action="{{ route('pre_launch') }}" class="form form-inline position-relative d-flex justify-content-center my-3 my-lg-5">
                    <div class="form-group mb-2">
                        <input type="email" class="form-control" placeholder="Type Email..." required>
                    </div>
                    <button type="submit" class="btn text-white font-weight-bold">Join Waiting List > </button>
                </form>
            </section>
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
            <section class="sneek-peak">
                <p class="titul text-center my-5">SNEEK PEAK</p>
                @include('_carrousel')
            </section>
            <section class="enjoy-music">
                <div class="titul my-5">
                    <p class="m-0 text-center">IF YOU ENJOY MUSIC</p>
                    <p class="m-0 text-center font-up font-weight-bold">DON'T LEAVE YOURSELF BEHIND!</p>
                </div>
                <div class="text-center my-5">
                    <button type="submit" class="btn font-weight-bold">Join Waiting List > </button>
                </div>
            </section>
        </main>
        <footer class="footer">
            <div class="information">
                <img src="/images/logo-white.svg" alt="">
                <ul>
                    <li>Term</li>
                    <li>Privacy</li>
                    <li>Help</li>
                    <li>Contact</li>
                    <li>About</li>
                </ul>
            </div>
            <div class="social-media">
                <div class="icons">
                    <img src="/images/facebook.svg" alt="facebook">
                    <img src="/images/twitter.svg" alt="twitter">
                    <img src="/images/instagram.svg" alt="instagram">
                </div>
                <p class="text-right">© 2019 Noisesharks ® Registered in England and Wales No. 10670071</p>
            </div>
        </footer>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
