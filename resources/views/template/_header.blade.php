<header id="headerPrincipal" desktop class="c-header  c-header-fixed c-header-with-subheader main-header p-0 p-lg-2" style="z-index: 1040 !important;">
    @if($_SERVER['REQUEST_URI'] === '/Post/Public/Movile/text'
        || $_SERVER['REQUEST_URI'] === '/Post/Public/Movile/link'
        || $_SERVER['REQUEST_URI'] === '/Post/Public/Movile/image'
        || $_SERVER['REQUEST_URI'] === '/Post/Public/Movile/video'
        || $_SERVER['REQUEST_URI'] === '/Post/Public/Movile/audio'
        || $_SERVER['REQUEST_URI'] === '/Post/Public/Movile/file'
        || $_SERVER['REQUEST_URI'] === '/Post/Public/Movile/docs'
      )
        <app-header-buttons-movile ref="header__buttons" ></app-header-buttons-movile>

    @else
        <app-header__logos ref="header__logos"></app-header__logos>
        <ul class="c-header-nav main-header__content-links">
            <li class="c-header-nav-item">
                <a class="c-header-nav-link  {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="/" id="stream" >
                    Stream
                </a>
            </li>
            <li class="c-header-nav-item ">
                <a class="c-header-nav-link {{ Route::currentRouteName() == 'profile.index' || Route::currentRouteName() == 'profile.edit' || Route::currentRouteName() == 'profile.channel.edit' || Route::currentRouteName() == 'profile.channel.activity' ? 'active' : ''}}" href="{{ \Auth::check() ? '/'.\Auth::user()->username.'/Profile' : '/login' }}" id="profile" >
                    Profile
                </a>
            </li>
        </ul>
        <app-header user="{{ \Auth::check() ? \Auth::user() : 'user: {channel_information}' }}" view_button="{{\Auth::check() && \Auth::user()->subscription_type === 'CONTRIBUTOR'  ? false : true }}" ref="header" />
    @endif
</header>
