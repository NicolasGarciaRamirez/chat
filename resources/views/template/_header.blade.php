<header class="c-header c-header-light c-header-fixed main-header ">
    <button class="c-header-toggler c-class-toggler d-menu d-lg-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true" style="transform: translateY(7.5px);height: 2.8rem;">
        <i class="cil-hamburger-menu"></i>
    </button>
    <a class="c-header-brand d-flex flex-row align-items-end d-lg-none" href="/">
        <img src="/images/logo-white.svg" class="img-logo" alt="Logo">
        <img src="/images/BETA.svg" class="mx-1 img-version">
    </a>
    <ul class="c-header-nav d-lg-down-none">
        <li class="c-header-nav-item px-1"><a class="c-header-nav-link mx-2 {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="/" id="stream">Stream</a></li>
        <li class="c-header-nav-item px-1"><a class="c-header-nav-link {{ Route::currentRouteName() == 'profile.index' || Route::currentRouteName() == 'profile.edit' || Route::currentRouteName() == 'profile.channel.edit' ? 'active' : ''}}" href="{{ \Auth::check() ? '/'.\Auth::user()->username.'/Profile' : 'login' }}" id="profile"> Profile</a></li>
    </ul>
    <app-header />
</header>

