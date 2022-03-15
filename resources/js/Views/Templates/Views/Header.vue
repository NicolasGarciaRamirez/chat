<template>
    <ul class="c-header-nav main-header__action-user" >
        <div class="public-post" v-if="view_search__movil">
            <div class="full-page pt-4" style="height: calc(100vh - 36px) !important;">
                <search :only_view="view_search__movil" />
            </div>
        </div>
        <search :only_view="false" v-else />
        <li class="c-header-nav-item mr-2" v-if="view_buttons && !view_post__movil">
            <a class="text-decoration-none become-contributor" href="/Register">
                Become a Noiseshark
            </a>
        </li>
        <li class="c-header-nav-item cta-login" v-if="!auth.token && !view_post__movil">
            <a class="cta-login__link d-md-down-none" href="/Register">Signup</a>
            <a class="cta-login__link" @click="showModalLogin">Login</a>
        </li>
        <li :class="`c-header-nav-item dropdown notification-by-user ${newNotify ? 'new-notification' : ''} d-none d-lg-block `" v-if="auth.token && !view_post__movil" >  <!--new-notification-->
            <div>
                <a class="c-header-nav-link " href="#" role="button" id="dropdownMenuNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    <div class="border-0 notification-by-user__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 24">
                            <path d="M19.93,20.24l-1.72-2.86A8.52,8.52,0,0,1,17,13V10.5a7,7,0,1,0-14,0V13a8.5,8.5,0,0,1-1.2,4.37L.07,20.24a.52.52,0,0,0,0,.5A.52.52,0,0,0,.5,21h19a.5.5,0,0,0,.44-.26A.52.52,0,0,0,19.93,20.24ZM1.38,20l1.27-2.1A9.58,9.58,0,0,0,4,13V10.5a6,6,0,0,1,12,0V13a9.58,9.58,0,0,0,1.35,4.89L18.62,20Z"/>
                            <path d="M10,0A2,2,0,0,0,8,2V4a.5.5,0,0,0,.5.5A.5.5,0,0,0,9,4V2a1,1,0,1,1,2,0V4a.51.51,0,0,0,1,0V2A2,2,0,0,0,10,0Z"/>
                            <path d="M12.17,20.25a.5.5,0,0,0-.69-.18.5.5,0,0,0-.18.68,1.5,1.5,0,1,1-2.6,0,.49.49,0,0,0-.18-.68.5.5,0,0,0-.69.18A2.46,2.46,0,0,0,7.5,21.5a2.5,2.5,0,0,0,5,0A2.46,2.46,0,0,0,12.17,20.25Z"/>
                            <path d="M17.81,18.11c.4.13-.07-.15-.2-.28a1.29,1.29,0,0,0-.35-.24,3.26,3.26,0,0,0-.08-1.37c-.14-.61-.34-1.2-.49-1.8A2.93,2.93,0,0,0,16,13.09a9.54,9.54,0,0,0,.37-1.9A6.45,6.45,0,0,0,11,4.13,10.34,10.34,0,0,0,11.28,2,1.2,1.2,0,0,0,8.89,2a10.34,10.34,0,0,1-.32,1.9l0,.21a6.84,6.84,0,0,0-1.88.59c-2.59,1.24-4.22,6.14-2.74,9A3.17,3.17,0,0,0,3.43,16a1.53,1.53,0,0,0-.51.29c-.24.2-.35.68-.44.85a3.37,3.37,0,0,1-1,.88,1.21,1.21,0,0,0,.61,2.23A21.3,21.3,0,0,0,6,20.13a19.73,19.73,0,0,1,2.85-.26l0,.22a2.58,2.58,0,0,0-.32.18,1.22,1.22,0,0,0-.24,1.88,2,2,0,0,0,1.29.79,1.19,1.19,0,0,0,1.21-.44,1.42,1.42,0,0,0,.74-1.44c0-.22-.09-.45-.15-.68.19,0,.37-.08.55-.12A19,19,0,0,1,15.44,20a2.28,2.28,0,0,0,.59-.11l.2,0a2.4,2.4,0,0,0,.93.55C18.63,20.93,19.26,18.61,17.81,18.11Z"/>
                        </svg>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right action-user__content" aria-labelledby="dropdownMenuNotification">
                    <notifications></notifications>
                </div>
            </div>
        </li>
        <li class="c-header-nav-item dropdown action-user" v-if="auth.token && !view_post__movil" >
            <a class="c-header-nav-link action-user__avatar" href="#" role="button" id="dropdownMenuHeader" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @click="saveExplanation('menu')">
                <div class="c-avatar">
                    <div class="lds-ripple" style="top: 50%; right: 100%;" v-if="!explanation.menu" @click="saveExplanation('menu')">
                        <div></div>
                        <div></div>
                    </div>
                    <img :src="`${auth.avatar}`" alt="Photo Profile" class="c-avatar-img" @click="saveExplanation('menu')"> <!--  rounded-pill -->
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right action-user__content" aria-labelledby="dropdownMenuHeader" >
                <div v-on:click="windowReload(`/${auth.username}/Channel/Activity`)">
                    <a href="#" class="dropdown-item" >
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M21.1,4.9h-7.5l2.8-2.8c0.3-0.3,0.3-0.7,0-0.9c-0.3-0.3-0.7-0.3-0.9,0L12,4.6L8.6,1.2c-0.3-0.3-0.7-0.3-0.9,0 c-0.3,0.3-0.3,0.7,0,0.9l2.8,2.8H2.9C1.9,4.9,1,5.8,1,6.8v12.9c0,1.1,0.9,1.9,1.9,1.9h1.9v0.6c0,0.4,0.3,0.6,0.6,0.6 s0.6-0.3,0.6-0.6v-0.6h11.6v0.6c0,0.4,0.3,0.6,0.6,0.6s0.6-0.3,0.6-0.6v-0.6h2c1.1,0,1.9-0.9,1.9-1.9V6.8C23,5.8,22.1,4.9,21.1,4.9 z M17.8,18.5c0,0.4-0.3,0.6-0.6,0.6H4.2c-0.4,0-0.6-0.3-0.6-0.6V8.1c0-0.4,0.3-0.6,0.6-0.6h12.9c0.4,0,0.6,0.3,0.6,0.6V18.5z M20.4,17.2c0,0.4-0.3,0.6-0.6,0.6s-0.6-0.3-0.6-0.6v-2.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6V17.2z M19.7,12.6 c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,12.4,20.1,12.6,19.7,12.6z M19.7,10.1c-0.4,0-0.6-0.3-0.6-0.6 c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,9.8,20.1,10.1,19.7,10.1z"/> <path d="M4.9,8.8h11.6v9.1H4.9V8.8z"/> </svg>
                        Channel
                    </a>
                </div>

                <a class="dropdown-item" @click="windowReload(`/${auth.username}/Profile`)">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M12,1c3.2,0,5.8,2.8,5.2,6.1c-0.3,2.1-2.1,3.7-4.3,4.2c-3.4,0.6-6.2-1.9-6.2-5.1C6.7,3.4,8.9,1,11.9,1H12z"/> <path d="M12,13.7c-5,0-9,3.7-9.5,8.5c0,0.5,0.3,0.8,0.8,0.8c3.1,0,14.5,0,17.5,0c0.4,0,0.7-0.3,0.7-0.7 C21,17.6,17,13.9,12,13.7z"/> </svg>
                    Profile
                </a>
                <a class="dropdown-item" v-on:click.prevent="showModalRelathions('Followers')">
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M23,9.4C22.9,9.2,22.7,9,22.5,9l-6.8-1.1l-3.1-6.5C12.5,1.2,12.3,1,12,1c-0.2,0-0.5,0.1-0.6,0.4l-3,6.4 L1.6,8.9C1.3,9,1.1,9.1,1,9.4c0,0.2,0,0.5,0.2,0.6l4.9,5.1L5,22.3c0,0.2,0.1,0.5,0.3,0.6C5.4,23,5.5,23,5.7,23 c0.1,0,0.2,0,0.3-0.1l6.1-3.4l6.1,3.4c0.2,0.1,0.5,0.1,0.7,0c0.2-0.1,0.3-0.4,0.3-0.6L18,15.1l4.9-5.1C23,9.9,23,9.6,23,9.4z"/> </svg>
                    Relationships
                </a>

                <!-- <div class="dropdown-divider"></div> -->

                <div class="dropdown-header py-1">
                    <strong>Contributors only</strong>
                </div>
                <a class="dropdown-item" @click="windowReload(`/User/Settings/${auth.username}/#supportEarnings`)">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M14.6,16.7l-0.3,0.2c-1,0.4-2.1,0.6-3.2,0.6c-0.3,0-0.6,0-0.9,0c0,0.5-0.1,1.1-0.3,1.6 c0.4,0.1,0.8,0.1,1.2,0.1c0.9,0,1.8-0.1,2.7-0.5c0.6-0.3,0.8-0.5,0.8-0.7V16.7z"/> <path d="M11.1,5.8c-1.1,0-2.2-0.2-3.2-0.6L7.6,4.9v1.2c0,0.2,0.3,0.5,0.8,0.7c0.9,0.3,1.8,0.5,2.7,0.5 s1.8-0.1,2.7-0.5c0.6-0.2,0.8-0.5,0.8-0.7V4.9l-0.3,0.2C13.3,5.6,12.2,5.8,11.1,5.8z"/> <path d="M11.1,8.7c-1.1,0-2.2-0.2-3.2-0.6L7.6,7.9v1.2c0,0.2,0.3,0.5,0.8,0.7c0.9,0.3,1.8,0.5,2.7,0.5 s1.8-0.1,2.7-0.5c0.6-0.2,0.8-0.5,0.8-0.7V7.9l-0.3,0.2C13.3,8.5,12.2,8.7,11.1,8.7z"/> <path d="M14.3,11c-1,0.4-2.1,0.6-3.2,0.6S8.9,11.4,7.9,11l-0.3-0.2v1.2c0,0.2,0.3,0.5,0.8,0.7 c0.9,0.3,1.8,0.5,2.7,0.5s1.8-0.1,2.7-0.5c0.6-0.3,0.8-0.5,0.8-0.7v-1.2L14.3,11z"/> <path d="M11.1,16.2c0.9,0,1.8-0.1,2.7-0.5c0.6-0.2,0.8-0.5,0.8-0.7v-1.2L14.3,14c-1,0.4-2.1,0.6-3.2,0.6 c-0.6,0-1.2-0.1-1.9-0.2c0.4,0.5,0.6,1.1,0.8,1.7C10.4,16.1,10.8,16.2,11.1,16.2z"/> <path d="M22.7,19.7c-1,0.4-2.1,0.6-3.2,0.6s-2.2-0.2-3.2-0.6L16,19.6v1.2c0,0.2,0.3,0.5,0.8,0.7 c0.8,0.3,1.8,0.5,2.7,0.5c0.9,0,1.8-0.1,2.7-0.5c0.6-0.2,0.8-0.5,0.8-0.7v-1.2L22.7,19.7z"/> <path d="M22.7,16.7c-1,0.4-2.1,0.6-3.2,0.6s-2.2-0.2-3.2-0.6c-0.1,0-0.2-0.1-0.3-0.2v1.1c0,0.2,0.3,0.5,0.8,0.7 c0.9,0.3,1.8,0.5,2.7,0.5c0.9,0,1.8-0.1,2.7-0.5c0.6-0.3,0.8-0.5,0.8-0.7v-1.1C22.9,16.6,22.8,16.7,22.7,16.7z"/> <path d="M22.7,13.8c-1,0.4-2.1,0.6-3.2,0.6s-2.2-0.2-3.2-0.6L16,13.7v1.2c0,0.2,0.3,0.5,0.8,0.7 c0.8,0.3,1.8,0.5,2.7,0.5c0.9,0,1.8-0.1,2.7-0.5c0.6-0.2,0.8-0.5,0.8-0.7v-1.2L22.7,13.8z"/> <path d="M8.4,3.9c0.9,0.3,1.8,0.5,2.7,0.5s1.8-0.1,2.7-0.5c0.6-0.3,0.8-0.5,0.8-0.7c0-0.2-0.2-0.5-0.8-0.7 C13,2.2,12,2,11.1,2S9.3,2.1,8.4,2.5C7.9,2.7,7.6,3,7.6,3.2C7.6,3.4,7.9,3.6,8.4,3.9z"/> <path d="M16.8,12.6c0.9,0.3,1.8,0.5,2.7,0.5c0.9,0,1.8-0.1,2.7-0.5c0.6-0.3,0.8-0.5,0.8-0.7c0-0.2-0.3-0.4-0.8-0.7 c-0.9-0.3-1.8-0.5-2.7-0.5c-0.9,0-1.8,0.1-2.7,0.5c-0.6,0.3-0.8,0.5-0.8,0.7C16,12.1,16.2,12.4,16.8,12.6z"/> <path d="M8.9,17.3c0-2.2-1.8-4.1-3.9-4.1s-4,1.8-4,4c0,2.2,1.8,4.1,3.9,4.1l0,0C7.1,21.4,8.9,19.6,8.9,17.3z M5.5,19.6v0.5h-1v-0.5c-0.5-0.2-0.9-0.6-1-1.2v-0.2l0.8-0.5L4.4,18c0.2,0.5,0.3,0.7,0.6,0.7c0.1,0,0.3,0,0.3-0.1 c0.1-0.1,0.1-0.2,0.1-0.3c0-0.2-0.1-0.3-0.6-0.5c-0.3-0.1-0.5-0.3-0.7-0.5c-0.3-0.2-0.4-0.5-0.4-0.9c0-0.5,0.3-1,0.8-1.1v-0.5h0.9 v0.5C5.7,15.4,6,15.7,6.1,16l0.1,0.2l-0.8,0.5l-0.1-0.2c-0.1-0.3-0.3-0.3-0.4-0.3s-0.2,0.1-0.2,0.2l0,0c0,0.1,0,0.2,0.1,0.3l0,0 l0.2,0l0.3,0.1c0.2,0.1,0.4,0.2,0.5,0.3c0.3,0.2,0.5,0.6,0.5,1l0,0c0,0.4-0.1,0.7-0.4,0.9C5.8,19.4,5.7,19.5,5.5,19.6z"/> </svg>
                    Earnings
                </a>
                <a class="dropdown-item" v-on:click.prevent="showModalRelathions('Supports')">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M17.1,2c-1.2,0-2.3,0.4-3.3,1.1c-0.9,0.7-1.5,1.6-1.9,2.4c-0.4-0.7-1-1.6-1.9-2.4C9,2.4,7.9,2,6.7,2 C3.5,2,1,4.8,1,8.5c0,4,3.1,6.8,7.8,10.9c0.8,0.7,1.7,1.5,2.7,2.4c0.1,0.1,0.3,0.2,0.5,0.2s0.3-0.1,0.5-0.2 c0.9-0.8,1.9-1.6,2.7-2.4c4.7-4.1,7.8-6.9,7.8-10.9C22.8,4.8,20.3,2,17.1,2z"/> </svg>
                    Supporters
                </a>
                <a class="dropdown-item" v-on:click.prevent="showModalRelathions('Rewards')">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M14.6,12.6V23h5.2c1.1,0,2-0.9,2-1.9v-8.4h-7.2V12.6z"/> <path d="M2.3,12.6V21c0,1.1,0.9,1.9,1.9,1.9h5.2V12.6H2.3z"/> <path d="M21.1,6.2h-2.6c0.4-0.5,0.7-1.2,0.7-1.9c0-1.8-1.4-3.2-3.2-3.2c-2.4-0.1-3,1.5-4,4C11,2.6,10.4,1,8.1,1 C6.4,1,4.9,2.4,4.9,4.2c0,0.7,0.3,1.4,0.7,1.9H2.9C1.9,6.2,1,7,1,8.1v1.3c0,1.1,0.9,1.9,1.9,1.9h6.5V6.2H8.1 C7,6.2,6.2,5.3,6.2,4.3s0.9-1.9,1.9-1.9c1.3,0,1.7,0.8,2.7,3.3C10.9,5.8,11,6,11,6.2h-0.3c0,9.6,0,7.2,0,16.8h2.6 c0-15.1,0-12.7,0-16.8H13c0-0.2,0.1-0.4,0.2-0.6c1-2.5,1.4-3.3,2.7-3.3c1.1,0,1.9,0.9,1.9,1.9s-0.9,1.9-1.9,1.9h-1.3v5.2h6.5 c1.1,0,1.9-0.9,1.9-1.9V8.1C23,7,22.1,6.2,21.1,6.2z"/> </svg>
                    Rewarders
                </a>
                <a class="dropdown-item" v-on:click.prevent="showModalRelathions('Credit')">
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M12,7.5c-4.8,0-8.5,5.2-8.5,9.7c0,5.2,4.9,5.8,8.5,5.8s8.5-0.6,8.5-5.8C20.5,12.7,16.8,7.5,12,7.5z M12.7,18.4C12.7,18.4,12.7,18.4,12.7,18.4l0,0.8c0,0.4-0.3,0.6-0.7,0.6s-0.7-0.3-0.7-0.6v-0.8c-0.4-0.1-0.8-0.4-1.2-0.8 c-0.2-0.3-0.2-0.7,0.1-0.9c0.3-0.2,0.7-0.2,0.9,0.1c1.3,1.5,2.2-0.8,0.8-0.8c-1.1,0-2-0.9-2-1.9c0-0.8,0.4-1.5,1.3-1.8v-0.8 c0-0.4,0.3-0.6,0.7-0.6c0.4,0,0.7,0.3,0.7,0.6v0.8c0.3,0.1,0.7,0.3,1,0.6c0.3,0.2,0.3,0.7,0,0.9c-0.3,0.3-0.7,0.3-0.9,0 c-1.2-1.1-2,1-0.7,1c1.1,0,2,0.9,2,1.9C14,17.4,13.4,18.1,12.7,18.4z"/> <path d="M15.7,1.5c-2.4-0.7-5-0.7-7.5,0C7.9,1.6,7.7,2.1,7.9,2.5l1,1.7c1.7-0.7,4.3-0.8,6.2,0l1-1.7 C16.3,2.1,16.1,1.6,15.7,1.5z"/> <path d="M15,5.6c-1.2-0.8-4.8-0.9-6.1,0C8.4,6,8.1,6.6,8.1,7.2c1.3-0.7,2.7-1,3.9-1c1.4,0,2.7,0.4,3.9,1 C15.9,6.6,15.6,6,15,5.6z"/> </svg>
                    Credit
                </a>
                <a class="dropdown-item" v-on:click.prevent="showModalRelathions('Get More Credit!')">
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.5,10.8c-0.6-0.5-1.4-0.4-1.9,0.2l-3,3.1h0c-0.2-0.6-0.7-1-1.3-1h-5c-0.6-0.3-1.4-0.4-2.1-0.4 c-2.1,0-3.9,1-4.8,2.9l4,3.9l0,0l0.7-0.7c0.3-0.3,0.8-0.5,1.2-0.5h5.9c0.9,0,1.8-0.4,2.5-1l4-4.7C23.2,12.1,23.1,11.2,22.5,10.8z" /> <path d="M8.1,20.9L6,23l-5-5L3.1,16c0.3-0.3,0.9-0.3,1.2,0l3.7,3.7C8.4,20,8.4,20.6,8.1,20.9z"/> <path d="M8.9,5.8c0,2.7,2.2,4.8,4.9,4.8s4.9-2.2,4.9-4.8S16.4,1,13.7,1S8.9,3.2,8.9,5.8z M17.7,5.8 c0,2.2-1.8,3.9-4,3.9s-4-1.8-4-3.9c0-2.2,1.8-3.9,4-3.9S17.7,3.6,17.7,5.8z"/> <path d="M13.7,1.4c-2.4,0-4.4,2-4.4,4.4c0,2.4,2,4.4,4.4,4.4s4.4-2,4.4-4.4C18.1,3.4,16.1,1.4,13.7,1.4z M14.1,7.9 v0.5c0,0.3-0.2,0.5-0.5,0.4c-0.2,0-0.4-0.2-0.4-0.4V7.9c-0.3-0.1-0.6-0.3-0.8-0.6c-0.2-0.2-0.1-0.5,0.1-0.7 c0.2-0.1,0.4-0.1,0.6,0.1c0.2,0.2,0.4,0.3,0.6,0.3c0.3,0,0.5-0.2,0.4-0.5c0-0.2-0.2-0.4-0.4-0.4c-0.7,0-1.3-0.6-1.3-1.3 c0-0.6,0.4-1.1,0.9-1.2V3.2c0-0.2,0.2-0.4,0.4-0.4c0.3,0,0.5,0.2,0.5,0.4v0.5c0.2,0.1,0.4,0.2,0.6,0.4c0.2,0.2,0.2,0.5,0,0.7 c-0.2,0.1-0.4,0.1-0.6,0c-0.2-0.1-0.3-0.2-0.5-0.2c-0.3,0-0.5,0.2-0.4,0.5c0,0.2,0.2,0.4,0.4,0.4c0.7,0,1.3,0.6,1.3,1.3 C14.9,7.3,14.6,7.8,14.1,7.9z"/> </svg>
                    Get More Credit!
                    <div class="lds-ripple" style="width: 25px; height: 0; transform: scale(.4) translate(5px, -37px)" v-if="!explanation.credit">
                        <div></div>
                        <div></div>
                    </div>
                </a>
                <a class="dropdown-item" v-on:click.prevent="showModalRelathions('My Marketing')">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M6.5,16.7L6.5,16.7c-0.3,0-0.6-0.1-0.9-0.2l-2,3.4c-0.2,0.3-0.1,0.7,0.2,0.9l1.9,1.1C6,22.1,6.4,22,6.6,21.7 l2.9-5L6.5,16.7z"/> <path d="M17.4,2.1l-5.8,3.6v10.4l5.8,3.5c0.4,0.3,1-0.1,1-0.6V2.7C18.4,2.1,17.8,1.8,17.4,2.1L17.4,2.1z"/> <path d="M3.1,13.1V8.7c0-0.3,0-0.5,0.1-0.7h-1C1.5,7.9,1,8.5,1,9.2v3.4c0,0.7,0.5,1.2,1.2,1.2h0.9 C3.1,13.6,3.1,13.4,3.1,13.1z"/> <path d="M10.3,15.4H6.6c-1.2-0.1-2.2-1.1-2.2-2.3V8.7c0-1.2,1-2.2,2.2-2.1h3.7L10.3,15.4z"/> <path d="M21.2,16.3c-0.2,0-0.3-0.1-0.5-0.2l-1.3-1.3c-0.3-0.3-0.3-0.7,0-0.9c0.3-0.3,0.7-0.3,0.9,0l1.3,1.3 c0.3,0.3,0.3,0.7,0,0.9C21.6,16.2,21.4,16.3,21.2,16.3L21.2,16.3z"/> <path d="M19.9,8.4c-0.2,0-0.3-0.1-0.5-0.2c-0.3-0.3-0.3-0.7,0-0.9L20.7,6c0.3-0.3,0.7-0.3,0.9,0 c0.3,0.3,0.3,0.7,0,0.9l-1.3,1.3C20.3,8.3,20.1,8.4,19.9,8.4L19.9,8.4z"/> <path d="M22.4,11.7h-1.8c-0.4,0-0.6-0.3-0.6-0.7c0-0.4,0.3-0.7,0.6-0.7h1.8c0.4,0,0.6,0.3,0.6,0.7 C23,11.4,22.7,11.7,22.4,11.7z"/> </svg>
                    My Marketing
                </a>

                <!-- <div class="dropdown-divider"></div> -->

                <div class="dropdown-header py-1">
                    <strong>Settings</strong>
                </div>

                <a class="dropdown-item" @click="$root.redirectAccountSettings()">
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M16.1,3.2c0-0.5,0.4-0.9,0.8-0.9V1H9.5C8.4,1,7.5,2,7.5,3.1c0,0,0,0,0,0v5.7h8.6V3.2z"/> <path d="M18.2,1.4v2.2c-0.5,0-0.8,0.4-0.8,0.9V5H19V3.2C19,2.5,18.7,1.8,18.2,1.4z"/> <path d="M17.3,6.4v3.7H6.3V6.4C5.5,6.7,5,7.4,5,8.2v12.9C5,22.1,5.8,23,6.9,23l0,0h9.9c1,0,1.9-0.9,1.9-1.9l0,0 V8.2C18.6,7.4,18.1,6.7,17.3,6.4z M9.4,20.4h-2v-1.3h2V20.4z M9.4,17.8h-2v-1.3h2V17.8z M9.4,15.3h-2V14h2V15.3z M12.8,20.4h-2 v-1.3h2V20.4z M12.8,17.8h-2v-1.3h2V17.8z M12.8,15.3h-2V14h2V15.3z M16.1,20.4h-2v-1.3h2V20.4z M16.1,17.8h-2v-1.3h2V17.8z M16.1,15.3h-2V14h2V15.3z M16.1,12.7H7.5v-1.3h8.6V12.7z"/> </svg>
                    Payments
                </a>
                <a class="dropdown-item"  @click="windowReload(`/User/Settings/${auth.username}`)">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M23,12.1c0-0.8-0.6-1.7-1.3-1.9C21,9.9,20.3,9.3,20,8.8c-0.2-0.5-0.2-1.4,0.2-2.1c0.3-0.7,0.1-1.7-0.4-2.3 c-0.6-0.6-1.6-0.8-2.3-0.4c-0.7,0.3-1.6,0.4-2.1,0.2C14.8,3.7,14.2,3,14,2.3C13.7,1.6,12.8,1,12,1s-1.7,0.6-2,1.3S9.2,3.7,8.7,4 C8.2,4.2,7.2,4.1,6.5,3.8S4.8,3.6,4.2,4.2S3.4,5.8,3.8,6.6S4.2,8.3,4,8.8c-0.3,0.5-1,1.1-1.7,1.4S1,11.3,1,12.1s0.6,1.7,1.3,2 C3,14.3,3.7,14.9,4,15.4c0.2,0.5,0.2,1.4-0.2,2.1c-0.3,0.7-0.1,1.7,0.4,2.3c0.6,0.6,1.6,0.8,2.3,0.4s1.6-0.4,2.1-0.2 c0.5,0.2,1.1,0.9,1.4,1.6s1.1,1.3,2,1.3c0.8,0,1.7-0.6,2-1.3c0.3-0.7,0.9-1.4,1.4-1.6s1.4-0.2,2.1,0.2c0.7,0.3,1.7,0.1,2.3-0.4 c0.6-0.6,0.8-1.6,0.4-2.3c-0.3-0.7-0.4-1.6-0.2-2.1c0.2-0.5,0.9-1.1,1.6-1.4C22.4,13.8,23,12.9,23,12.1z M12,16.1c-2.2,0-4-1.8-4-4 s1.8-4,4-4s4,1.8,4,4S14.2,16.1,12,16.1z"/> </svg>
                    Account Settings
                </a>

                <!--<public-post-movil></public-post-movil>-->

                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" v-on:click.prevent="logout()">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M17.8,6.6c-0.4-0.4-1.1-0.4-1.5,0c-0.4,0.4-0.4,1,0,1.4l3.2,3H6.4c-0.6,0-1.1,0.4-1.1,1s0.5,1,1.1,1h13.1 l-3.2,3c-0.4,0.4-0.4,1,0,1.4c0.2,0.2,0.5,0.3,0.7,0.3c0.2,0,0.5-0.1,0.7-0.3l4.9-4.7c0.4-0.4,0.4-1,0-1.4L17.8,6.6z"/> <path d="M11.3,23c0.6,0,1.1-0.4,1.1-1s-0.5-1-1.1-1H3.1V3h8.2c0.6,0,1.1-0.4,1.1-1s-0.5-1-1.1-1H2.1C1.4,1,1,1.4,1,2 v20c0,0.6,0.5,1,1.1,1H11.3z"/> </svg>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</template>

<script>
    import Search from "../../Search/Views/Search";
    import Auth from "../../../helpers/Auth";
    import Followers from "../../../helpers/Followers";
    import PublicPostMovil from "../../Home/post/PublicPostMovil";
    import Explanation from "../../../helpers/Explanation";
    import Notifications from '../../Notifications/Index';

	export default {
		props: ["user","view_button"],
		components: {
			PublicPostMovil,
			Search,
            Notifications
		},
		data() {
		    return {
				auth: Auth.state,
				location: false,
				view_buttons: false,
				view_post__movil: false,
				view_search__movil: false,
			};
		},
        computed:{
            explanation() {
                Explanation.get(this.auth.username)
                Explanation.initialize()
                return Explanation.data ? Explanation.data : {filter:false,credit:false,menu:false}
            },
            newNotify(){
                let user = JSON.parse(this.user)
                return _.each(user.notifications, (notification)=>{
                    return notification.read_at == null
                })

            }
        },
        mounted() {
			if (window.location.href !== "/" && window.location.href !== "/Register") this.location = true;
			Auth.initialize();
			this.view_buttons = this.view_button;
		},
		methods:{
            async windowReload(url){
                if(!this.explanation.menu){
                    await this.saveExplanation('menu')
                }
                setTimeout(window.location.replace(url),100)
            },
            async saveExplanation(data){
                let explanation = {
                    filter: Explanation.data.filter,
                    menu: Explanation.data.menu ? Explanation.data.menu : data === 'menu',
                    credit: Explanation.data.credit ? Explanation.data.credit : data === 'credit'
                }
                Explanation.set(explanation , Auth.state.username)
            },
			async showModalRelathions(type) {
				await Auth.setSession();

				if (type === "Following" || type === "Followers") {
					this.$root.$refs.modalRelathion.type_table = type;
					$("#ModalRelathions").modal("show");
				} else if ( (this.$root.$refs.modalRelathion.user.subscription_type === "CONTRIBUTOR" && type === "Supports") || type === "Rewards" ) {
					this.$root.$refs.modalRelathion.type_table = type;
					$("#ModalRelathions").modal("show");
				} else if(type == 'My Marketing'){
                    $("#myMarketing").modal("show");
                }else if(type == 'Get More Credit!'){
                    await this.saveExplanation('credit')
					$("#getMoreCredit").modal("show");
				}else if(type == 'Credit'){
					$("#myCredit").modal("show");
				} else {
					swal({
					text: "you have to be a contributor",
					className: "swal-alert",
					dangerMode: true,
					});
					$(".swal-footer").addClass("text-center");
				}
			},
			showModalLogin() {
				$("#ModalLogin").modal("show");
			},
			showModalContributor() {
				$("#ModalContributor").modal("show");
			},
			async logout() {
				await axios.get("/logout").then((res) => {
					Auth.remove();
					Followers.remove();
					Explanation.remove()
					window.location.replace("/");
				});
			},
		},
	};
</script>

<style lang="scss">
	.action-user .action-user__content.show{
		max-height: min-content;
	}
</style>
