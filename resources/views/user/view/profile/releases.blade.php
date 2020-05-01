@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.view.profile.header', $user)
        <div class="navigation-header my-5 mx-3 d-flex">
            <h3>
                <a href="/View/Channel/Activity/{{ $user->id }}" class="c-fourth font-weight-bold pt-2 mr-3">Channel</a>
            </h3>
            <h3>
                <a href="/View/Profile/Releases/{{ $user->id }}" class="text-white font-weight-bold active">Profile</a>
            </h3><br>
        </div>
        @include('user.view.profile._about', $user)
        <div class="navigation-body">
            <a href="/View/Profile/Releases/{{ $user->id }}" class="font-weight-bold mr-3 active c-fifth">Releases</a>
            <a href="/View/Profile/Members/{{ $user->id }}" class="text-white font-weight-bold mr-3">Members</a>
            <a href="/View/Profile/WorkHistory/{{ $user->id }}" class="text-white font-weight-bold mr-3">Work History</a>
            <a href="/View/Profile/Genres/{{ $user->id }}" class="text-white font-weight-bold mr-3">Genres</a>
            <a href="/View/Profile/Services/{{ $user->id }}" class="text-white font-weight-bold mr-3">Services</a>
            <a href="/View/Profile/Rates/{{ $user->id }}" class="text-white font-weight-bold">Rates</a>
        </div>
        <profile-releases v-bind:user="{{ $user }}" />
    </div>
@endsection