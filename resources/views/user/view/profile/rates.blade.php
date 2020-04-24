@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.view.profile.header')
        <div class="navigation-header my-5 mx-3 d-flex">
            <h3>
                <a href="/View/Channel/Activity" class="c-fourth font-weight-bold pt-2 mr-3">Channel</a>
            </h3>
            <h3>
                <a href="/View/Profile/Members" class="text-white font-weight-bold active">Profile</a>
            </h3>
        </div>
        <div class="navigation-body">
            <a href="/View/Profile/Releases" class="font-weight-bold mr-3 text-white">Releases</a>
            <a href="/View/Profile/Members" class="text-white font-weight-bold mr-3">Members</a>
            <a href="/View/Profile/WorkHistory" class="text-white font-weight-bold mr-3">Work History</a>
            <a href="/View/Profile/Genres" class="text-white font-weight-bold mr-3">Genres</a>
            <a href="/View/Profile/Services" class="text-white font-weight-bold mr-3">Services</a>
            <a href="/View/Profile/Rates" class="font-weight-bold active c-fifth mr-3">Rates</a>
        </div>
        <profile-rates />
    </div>
@endsection