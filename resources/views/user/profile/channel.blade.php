@extends('user.profile.template.template')

@section('content')
    <div class="profile">
        @include("user.head-profile", $user)
        <channel-activity :user="{{ $user }}" />
    </div>
@endsection
