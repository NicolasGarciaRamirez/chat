<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show container-nav " id="sidebar" style="z-index: 1050 !important;">
    <div class="c-sidebar-brand mb-1">
        <a href="/" class="c-sidebar-brand-full">
            <img src="{{ asset('/images/logo-white.svg') }}" alt="Noisesharsk Logo" height="50" class="noisesharks-logo">
            <img src="{{ asset('/images/BETA.svg')}}" class="mx-1 img-version">
		</a>
		<a href="/" class="c-sidebar-brand-minimized">
			<img src="{{ asset('/images/BETA.svg') }}" width="46" height="46" alt="Accedo Logo" />
		</a>
    </div>

    <explanations></explanations>
    @php
        $users_following = collect();
        if(\Auth::check()){
            $users_following = \Auth::user()->load('following.following.profile_information','following.following.personal_information');
        }
    @endphp

    <app-nav :following="{{$users_following}}" ref="AppNav"></app-nav>

    {{-- <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button> --}}
</div>

