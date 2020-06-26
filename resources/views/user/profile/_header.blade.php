<div>
    @include('user._header-profile' , $user)
</div>
<div class="navigation-header my-5 mx-3 d-flex">
    <h3>
        <a href="/{{ $user->username }}/Channel/Activity/" class="c-fourth font-weight-bold pt-2 mr-3">Channel</a>
    </h3>
    <h3>
        <a href="/{{ $user->username }}/Profile/WorkHistory" class="text-white font-weight-bold active">Profile</a>
    </h3>
</div>
<div class="d-flex flex-row">
    <p class="text-white p-3">
        {{ $user->profile_information ?  $user->profile_information->about_you : ''}}
    </p>
</div>
<div class="navigation-body">
    @if ($user->profile_information)
        @if ($user->profile_information->releases->count() > 0)
            <a href="/{{ $user->username }}/Profile/Releases" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'profile.releases' ? 'active' : '' }}">Releases</a>
        @endif
        @if ($user->profile_information->members->count() > 0)
            <a href="/{{ $user->username }}/Profile/Members" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'profile.members' ? 'active' : '' }}">Members</a>
        @endif
        @if ($user->profile_information->genres)
            <a href="/{{ $user->username }}/Profile/Genres" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'profile.genres' ? 'active' : '' }}">Genres</a>
        @endif
        @if ($user->profile_information->services)
            <a href="/{{ $user->username }}/Profile/Services" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'profile.services' ? 'active' : '' }}">Services</a>
        @endif
        @if ($user->profile_information->social_media)
            <a href="/{{ $user->username }}/Profile/Social/Media" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'profile.social_media' ? 'active' : '' }}">Social Media</a>
        @endif
    @endif
    {{-- <a href="/{{ $user->username }}/Profile/WorkHistory" class="font-weight-bold text-white mr-3 {{ Route::currentRouteName() == 'profile.work.history' ? 'active' : '' }}">Work History</a> --}}
</div>
