@extends('template.template')

@section('content')
    <div class="profile">
        <div>
            @include("user._header-profile", $user)
        </div>
        <channel-playlist :user="{{ $user }}" />
    </div>
@endsection