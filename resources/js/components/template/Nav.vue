<template>
    <ul class="c-sidebar-nav ps ps--active-y px-3">
        <li class="c-sidebar-nav-title p-0 m-0 d-md-none text-center">
            <a href="/Profile/Channel/Activity" class="text-white">Profile</a>
        </li>
        <li class="c-sidebar-nav-title pb-0">Filter Stream</li>
        <li class="c-sidebar-nav-title p-0 m-0">
            <img src="/images/sharks-menu.svg" alt="">
        </li>
        <li class="c-sidebar-nav-title">Genre</li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="pop">
            <label for="pop"><span>Pop</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="rap_hip_jop">
            <label for="rap_hip_jop"><span>Rap & Hip-Jop</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="edm">
            <label for="edm"><span>EDM</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="rock_metal">
            <label for="rock_metal"><span>Rock & Metal</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="jazz_blues">
            <label for="jazz_blues"><span>Jazz & Blues</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="classical">
            <label for="classical"><span>Classical</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="funk">
            <label for="funk"><span>Funk</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="world">
            <label for="world"><span>World</span></label>
        </li>
        <li class="c-sidebar-nav-title">Category</li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="production_engineering">
            <label for="production_engineering"><span>Production & Engineering</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="vlogs">
            <label for="vlogs"><span>Vlogs</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="instruments">
            <label for="instruments"><span>Instruments</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="podcasts">
            <label for="podcasts"><span>Podcasts</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="audio_clips">
            <label for="audio_clips"><span>Audio Clips</span></label>
        </li>
        <li class="c-sidebar-nav-item p-0">
            <div class="divider"></div>
        </li>
        <li class="c-sidebar-nav-title m-0 pb-0">
            Following
            <i class="fas fa-star float-sm-right"></i>
        </li>
        <li class="c-sidebar-nav-title mt-0 pt-0">
            <img src="/images/sharks-menu.svg" alt="">
        </li>
        <li class="c-sidebar-nav-item">
            SoundStorming
            <span class="float-sm-right c-fifth dot">•</span>
        </li>
        <li class="c-sidebar-nav-item p-0">
            <div class="divider"></div>
        </li>
        <app-footer />
    </ul>
</template>

<script>
    import AppFooter from './footer'
    export default {
        components: {
            AppFooter
        }
    }
</script>
