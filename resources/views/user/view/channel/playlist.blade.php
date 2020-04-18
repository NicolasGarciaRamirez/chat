@extends('template.template')

@section('content')
<div class="view-profile">
    @include('user.view.profile.header')
    <div class="navigation-header my-5 mx-3 d-flex">
        <h3>
            <a href="/Profile/View/Channel/Activity" class="text-white font-weight-bold pt-2 mr-3 active">Channel</a>
        </h3>
        <h3>
            <a href="/Profile/View/Profile/Releases" class="c-fourth font-weight-bold">Profile</a>
        </h3>
    </div>
    <div class="navigation-body">
        <a href="/Profile/View/Channel/Activity" class="text-white font-weight-bold mr-3">Activity</a>
        <a href="/Profile/View/Channel/Playlist" class="font-weight-bold active c-fifth">Playlist</a>
       
    </div>
    <div class="container-fluid">
        <profile-playlist />
    </div>
</div>    
@endsection