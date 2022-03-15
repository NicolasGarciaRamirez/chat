@extends('template.template')

@section('metas')
    <meta property="og:url"                content="https://www.noisesharks.com/{{$user->username}}/Profile" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{$user->profile_information ? $user->profile_information->title : ''}}" />
    <meta property="og:description"        content="{{$user->profile_information ? $user->profile_information->about_you : ''}}" />
    <meta property="og:image"              content="https://www.noisesharks.com{{$user->cover}}" />
@endsection

@section('content')
    <div class="view-profile">
        @include('user.profile._header', $user)
        <profile-index :user="{{ $user }}" />
    </div>
@endsection
