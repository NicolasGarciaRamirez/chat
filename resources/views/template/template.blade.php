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
    <main id="app">
        @yield('content')
    </main>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
