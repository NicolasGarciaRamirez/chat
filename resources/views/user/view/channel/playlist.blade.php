@extends('template.template')

@section('content')
<div class="view-profile">
    <div class="img-container">
        <img src="/images/portada.jpg" alt="ImagePortada" class="img-portada img-fluid">
        <img src="/images/profile.jpg" alt="ImagePortada" class="img-profile rounded-circle">
    </div>
    <div class="head-container align-items-center">
        <div class="text-right d-flex justify-content-end align-items-center order-lg-2 functions pb-2">
            <img src="/images/chat.svg" alt="chat" class="icon mr-3">
            <img src="/images/icons/post-up.svg" alt="post-up" class="icon mr-3">
            <a href="#" class="btn bg-black rounded-pill mr-2 text-white">FOLLOW<img class="icon ml-2" src="/images/icons/star.svg"></a>
            <i class="fas fa-ellipsis-h c-third fa-2x"></i>
        </div>
        <div>
            <h2>Denkmark <img src="/images/icons/check.svg" alt="check-icon" class="check-icon"></h2>
            <div class="d-flex">
                <a href="#" class="btn bg-danger text-white mr-3">BAND</a>
            </div>
        </div>
    </div>
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
        <playlist />
    </div>
</div>    
@endsection