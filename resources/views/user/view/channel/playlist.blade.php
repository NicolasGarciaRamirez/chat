@extends('template.template')

@section('content')
<div class="view-profile">
    @include('user.view.profile._header', $user)
    <div class="navigation-header my-5 mx-3 d-flex">
        <h3>
            <a href="/View/Channel/Activity/{{ $user->user_name }}" class="text-white font-weight-bold pt-2 mr-3 active">Channel</a>
        </h3>
        <h3>
            <a href="/View/Profile/Releases/{{ $user->user_name }}" class="c-fourth font-weight-bold">Profile</a>
        </h3>
    </div>
    <div class="navigation-body">
        <a href="/View/Channel/Activity/{{ $user->user_name }}" class="text-white font-weight-bold mr-3">Activity</a>
        <a href="/View/Channel/Playlist/{{ $user->user_name }}" class="font-weight-bold active c-fifth">Playlist</a>

    </div>
    <div class="container-fluid">
        <profile-playlist :user="{{ $user }}" />
    </div>
</div>
@endsection
