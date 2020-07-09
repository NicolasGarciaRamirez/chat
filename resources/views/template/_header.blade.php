<header class="c-header c-header-light c-header-fixed main-header position-absolute">
    <button class="c-header-toggler c-class-toggler mr-1  d-menu" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true" style="transform: translateY(9px);">
        <i class="cil-hamburger-menu"></i>
    </button>
    <a class="c-header-brand mr-3" href="/">
        <img src="/images/logo-white.svg" width="118" height="56" alt="Logo">
    </a>
    <ul class="c-header-nav d-lg-down-none ml-5">
        <li class="c-header-nav-item px-1"><a class="c-header-nav-link mx-2 {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="/" id="stream">Stream</a></li>
        <li class="c-header-nav-item px-1"><a class="c-header-nav-link {{ Route::currentRouteName() == 'profile' || Route::currentRouteName() == 'profile.edit.user.settings' ||  Route::currentRouteName() == 'profile.edit' ||  Route::currentRouteName() == 'profile.get' || Route::currentRouteName() == 'profile.channel.activity' ||  Route::currentRouteName() == 'profile.channel.edit' ||  Route::currentRouteName() == 'profile.releases' ||  Route::currentRouteName() == 'profile.members' ||  Route::currentRouteName() == 'profile.work.history' ||  Route::currentRouteName() == 'profile.genres'|| Route::currentRouteName() == 'profile.services' || Route::currentRouteName() == 'profile.social_media' ? 'active' : '' }}" href="{{ \Auth::check() ? '/'.\Auth::user()->username.'/Profile' : 'login' }}" id="profile"> Profile</a></li>
    </ul>
    <app-header />
</header>

