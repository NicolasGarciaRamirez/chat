<template>
    <ul class="c-sidebar-nav ps ps--active-y px-3">
        <li class="c-sidebar-nav-title p-0 m-0 d-md-none text-center">
            <a :href="`/${auth.username}/Profile/WorkHistory`" class="text-white">Profile</a>
        </li>
        <li class="c-sidebar-nav-title pb-0">Filter Stream</li>
        <li class="c-sidebar-nav-title p-0 m-0">
            <img src="/images/sharks-menu.svg" alt="">
        </li>
        <li class="c-sidebar-nav-title">Genre</li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="pop" @click="getFilter('pop')">
            <label for="pop"><span>Pop</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="rap_hip_jop" @click="getFilter('Rap & Hip-Hop')">
            <label for="rap_hip_jop"><span>Rap & Hip-Hop</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="edm" @click="getFilter('EDM')">
            <label for="edm"><span>EDM</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="rock_metal" @click="getFilter('Rock & Metal')">
            <label for="rock_metal"><span>Rock & Metal</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="jazz_blues" @click="getFilter('Jazz & Blues')">
            <label for="jazz_blues"><span>Jazz & Blues</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="classical" @click="getFilter('Classical')">
            <label for="classical"><span>Classical</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="funk" @click="getFilter('Funk')">
            <label for="funk"><span>Funk</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="world" @click="getFilter('World')">
            <label for="world"><span>World</span></label>
        </li>
        <li class="c-sidebar-nav-title">Category</li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="production_engineering" @click="getFilter('Production & Engineering')">
            <label for="production_engineering"><span>Production & Engineering</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="vlogs" @click="getFilter('Vlogs')">
            <label for="vlogs"><span>Vlogs</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="instruments" @click="getFilter('Instruments')">
            <label for="instruments"><span>Instruments</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="podcasts" @click="getFilter('Podcasts')">
            <label for="podcasts"><span>Podcasts</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="audio_clips" @click="getFilter('Audio Clips')">
            <label for="audio_clips"><span>Audio Clips</span></label>
        </li>
        <li class="c-sidebar-nav-item p-0">
            <div class="divider"></div>
        </li>
        <li class="c-sidebar-nav-title m-0 pb-0" v-if="auth.username">
            Following
            <i class="fas fa-star float-sm-right"></i>
        </li>
        <li class="c-sidebar-nav-title mt-0 pt-0" v-if="auth.username">
            <img src="/images/sharks-menu.svg" alt="">
        </li>
        <div v-if="auth.username">
            <div v-for="(follow, index) in user.followers" :key="index">
                <li class="c-sidebar-nav-item">
                    <a :href="`/${follow.user.username}/Channel/Activity`" class="no-underline text-white font-weight-bold">{{ follow.user.profile_information ? follow.user.profile_information.artistic_name : follow.user.personal_information.full_name }}</a>
                    <span class="float-sm-right c-fifth dot">•</span>
                </li>
            </div>
        </div>
        <li class="c-sidebar-nav-item p-0">
            <div class="divider"></div>
        </li>
        <app-footer />
    </ul>
</template>

<script>
    import AppFooter from './footer'
    import Auth from '../../helpers/Auth'
    import Filter from '../../helpers/Filter'

    export default {
        props:['user'],
        data(){
            return {
                auth: Auth.state,
                filter: []
            }
        },
        components: {
            AppFooter
        },
        mounted(){
            Auth.initialize()
            if (this.auth.username) {
                if (!this.user) {
                    this.user = {
                        followers:{
                            user:{}
                        }
                    }
                }
            }
        },
        methods:{
            getFilter(filter){
                this.filter.push(filter)
                this.filtered()
            },
            filtered(){
                // Filter.initialize(this.$parent)
                // var fil = Filter.filter(this.filter)
                console.log(this.$root)                
            }
        }

    }
</script>
