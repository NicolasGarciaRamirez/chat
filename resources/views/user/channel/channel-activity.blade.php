@extends('template.template')

@section('metas')
    <meta property="og:url"                content="https://www.noisesharks.com/{{$user->username}}/Channel/Profile" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{$user->channel_information ? $user->artistic_name : ''}}" />
    <meta property="og:description"        content="{{$user->channel_information ? $user->channel_information->why_support : ''}}" />
    <meta property="og:image"              content="https://www.noisesharks.com{{$user->cover}}" />
@endsection

@section('content')
    <div class="profile">
        <div>
            @include("user._header-profile", $user)
        </div>
        <channel-activity :user="{{ $user }}" ref="channelActivity"/>
    </div>
@endsection
