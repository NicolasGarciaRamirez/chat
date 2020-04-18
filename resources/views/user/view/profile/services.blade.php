@extends('template.template')

@section('content')
    <div class="view-profile">
        @include('user.view.profile.header')
        <div class="navigation-header my-5 mx-3 d-flex">
            <h3>
                <a href="/Profile/View/Channel/Activity" class="c-fourth font-weight-bold pt-2 mr-3">Channel</a>
            </h3>
            <h3>
                <a href="/Profile/View/Profile/Members" class="text-white font-weight-bold active">Profile</a>
            </h3>
        </div>
        <div class="navigation-body">
            <a href="/Profile/View/Profile/Releases" class="font-weight-bold mr-3 text-white">Releases</a>
            <a href="/Profile/View/Profile/Members" class="text-white font-weight-bold mr-3">Members</a>
            <a href="/Profile/View/Profile/WorkHistory" class="text-white font-weight-bold mr-3">Work History</a>
            <a href="/Profile/View/Profile/Genres" class="text-white font-weight-bold mr-3">Genres</a>
            <a href="/Profile/View/Profile/Services" class="font-weight-bold active c-fifth mr-3">Services</a>
            <a href="/Profile/View/Profile/Rates" class="text-white font-weight-bold">Rates</a>
        </div>
        <profile-services />
    </div>
@endsection