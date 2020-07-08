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
            <input type="checkbox" id="pop" @click="updateFilterGender('Pop')" data-genre="Pop">
            <label for="pop"><span>Pop</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="rap_hip_jop" @click="updateFilterGender('Rap & Hip-Hop')" data-genre="Rap & Hip-Hop">
            <label for="rap_hip_jop"><span>Rap & Hip-Hop</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="edm" @click="updateFilterGender('EDM')" data-genre="EDM">
            <label for="edm"><span>EDM</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="rock_metal" @click="updateFilterGender('Rock & Metal')" data-genre="Rock & Metal">
            <label for="rock_metal"><span>Rock & Metal</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="jazz_blues" @click="updateFilterGender('Jazz & Blues')" data-genre="Jazz & Blues">
            <label for="jazz_blues"><span>Jazz & Blues</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="classical" @click="updateFilterGender('Classical')" data-genre="Classical">
            <label for="classical"><span>Classical</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="funk" @click="updateFilterGender('Funk')" data-genre="Funk">
            <label for="funk"><span>Funk</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="world" @click="updateFilterGender('World')" data-genre="World">
            <label for="world"><span>World</span></label>
        </li>
        <li class="c-sidebar-nav-title">Category</li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="production_engineering" @click="updateFilterCategory('Production & Engineering')" data-category="Production & Engineering">
            <label for="production_engineering"><span>Production & Engineering</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="vlogs" @click="updateFilterCategory('Vlogs')" data-category="Vlogs">
            <label for="vlogs"><span>Vlogs</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="instruments" @click="updateFilterCategory('Instruments')" data-category="Instruments">
            <label for="instruments"><span>Instruments</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="podcasts" @click="updateFilterCategory('Podcasts')" data-category="Podcasts">
            <label for="podcasts"><span>Podcasts</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="audio_clips" @click="updateFilterCategory('Audio Clips')" data-category="Audio Clips">
            <label for="audio_clips"><span>Audio Clips</span></label>
        </li>
        <li class="c-sidebar-nav-item">
            <input type="checkbox" id="performance_and_jams" @click="updateFilterCategory('Performances and Jams')">
            <label for="audio_clips"><span>Performances and Jams</span></label>
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
        <div v-if="auth.username">
            <div v-for="(follow, index) in user.followers" :key="index">
                <li class="c-sidebar-nav-item" v-if="follow.user.username">
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
    import FilterPost from '../../helpers/FilterPost'

    export default {
        props:['user'],
        data(){
            return {
                auth: Auth.state,
                filters: FilterPost.state,
            }
        },
        components: {
            AppFooter
        },
        mounted(){
            Auth.initialize()
            FilterPost.initialize()
            this.setFilters()

        },
        methods:{
            updateFilterGender(genre){
                FilterPost.removeOrAddGenres(genre)
                this.filterPost()
            },
            updateFilterCategory(category){
                FilterPost.removeOrAddCategories(category)
                this.filterPost()
            },
            filterPost(){
                if(location.href == 'http://localhost:8000/' || location.href == 'https://www.noisesharks.com/'){
                    this.$root.$refs.home.filterPost()
                }
            },
            setFilters(){
                var genres = JSON.parse(FilterPost.state.genres)
                var categories = JSON.parse(FilterPost.state.categories)
                if(genres !== null){
                    genres.map(function(o){
                        $('*[data-genre="'+o+'"]').prop('checked', true)
                    })
                }
                if(categories !== null){
                    categories.map(function(o){
                        $('*[data-category="'+o+'"]').prop('checked', true)
                    })
                }
                this.filterPost()
            },
            // getUser(){
            //     axios.post
            // }
        }
    }
</script>
