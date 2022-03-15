@extends('template.template')

@section('metas')
    <meta property="og:url"                content="https://www.noisesharks.com/" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="🎹🦈Noisesharks" />
    <meta property="og:description"        content="Where music content creators and streamers financially support, interact, and discover each other!" />
    <meta property="og:image"              content="https://www.noisesharks.com/images/profile/default.png" />
@endsection

@section('content')
    <div class="container home">
        <home :user="{{ \Auth::check() ? \Auth::user()->load('channel_information.tiers', 'payment_methods.biling_information') : '{}'  }}" ref="home"/>
    </div>
@endsection
