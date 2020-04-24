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
            </h3><br>
        </div>
        <p class="text-white p-3">
            I am a Singer Songwriter focused on acoustic Guitar, but i don't limit myself. Most of my songs were recorded just using my acoustic guitar. 
            As i started off i was more into Fingerstyle and Blues. Now i pursue a concept i like to name replugged.
            The idea is: the recorded songs must be able to get performed live by one person with guitar, without losing any vital sound!
            There are only a few exceptions to this concept, like Goodbye, has got a piano arrangement live.
        </p>
        <div class="navigation-body">
            <a href="/View/Profile/Releases" class="font-weight-bold mr-3 active c-fifth">Releases</a>
            <a href="/View/Profile/Members" class="text-white font-weight-bold mr-3">Members</a>
            <a href="/View/Profile/WorkHistory" class="text-white font-weight-bold mr-3">Work History</a>
            <a href="/View/Profile/Genres" class="text-white font-weight-bold mr-3">Genres</a>
            <a href="/View/Profile/Services" class="text-white font-weight-bold mr-3">Services</a>
            <a href="/View/Profile/Rates" class="text-white font-weight-bold">Rates</a>
        </div>
        <profile-releases />
    </div>
@endsection