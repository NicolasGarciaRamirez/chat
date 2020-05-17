<div class="img-container">
    <img src="/images/{{ $user->cover }}" alt="ImagePortada" class="img-portada img-fluid">
    <img src="/images/{{ $user->avatar }}" alt="ImagePortada" class="img-profile rounded-circle">
</div>
<div class="head-container align-items-center">
    <div class="text-right d-flex justify-content-end align-items-center order-lg-2 functions pb-2">
        <img src="/images/chat.svg" alt="chat" class="icon mr-3">
        <img src="/images/icons/post-up.svg" alt="post-up" class="icon mr-3">
        <a href="#" class="btn bg-black rounded-pill mr-2 text-white">FOLLOW<img class="icon ml-2" src="/images/icons/star.svg"></a>
        <i class="fas fa-ellipsis-h c-third fa-2x"></i>
    </div>
    <div>
        <h2>{{ $user->personal_information->full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon"></h2>
        <div class="d-flex">
            <a href="#" class="btn bg-danger text-white mr-3">{{ $user->personal_information->title }}</a>
        </div>
    </div>
</div>
<div class="navigation-header my-5 mx-3 d-flex">
    <h3>
        <a href="/View/Channel/Activity/{{ $user->username }}" class="c-fourth font-weight-bold pt-2 mr-3">Channel</a>
    </h3>
    <h3>
        <a href="/View/Profile/Members/{{ $user->username }}" class="text-white font-weight-bold active">Profile</a>
    </h3>
</div>
<div class="d-flex flex-row">
    <p class="text-white p-3">
        {{ $user->personal_information->about_you }}
    </p>
</div>
<div class="navigation-body">
    <a href="/View/Profile/Releases/{{ $user->username }}" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'view.profile.releases' ? 'active' : '' }}">Releases</a>
    <a href="/View/Profile/Members/{{ $user->username }}" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'view.profile.members' ? 'active' : '' }}">Members</a>
    <a href="/View/Profile/WorkHistory/{{ $user->username }}" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'view.profile.work.history' ? 'active' : '' }}">Work History</a>
    <a href="/View/Profile/Genres/{{ $user->username }}" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'view.profile.genres' ? 'active' : '' }}">Genres</a>
    <a href="/View/Profile/Services/{{ $user->username }}" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'view.profile.services' ? 'active' : '' }}">Services</a>
    <a href="/View/Profile/Rates/{{ $user->username }}" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'view.profile.rates' ? 'active' : '' }}">Rates</a>
</div>
