<div>
    @include('user._header-profile' , $user)
</div>
<div class="navigation-header my-4 mx-3">
    <h3>
        <a href="/{{ $user->username }}/Channel/Activity/" class="c-fourth font-weight-bold pt-2 mr-3">Channel</a>
    </h3>
    <h3>
        <a href="/{{ $user->username }}/Profile" class="text-white font-weight-bold active">About</a>
    </h3>
</div>
@if($user->profile_information)
    @if($user->profile_information->about_you )
        <div class="d-flex flex-row">
            <p class="text-white p-3">
                {{ $user->profile_information ?  $user->profile_information->about_you : ''}}
            </p>
        </div>
    @endif
@endif
