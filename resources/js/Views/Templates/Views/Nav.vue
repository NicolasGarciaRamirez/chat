<template>
    <ul class="c-sidebar-nav px-3">
        <li class="c-sidebar-nav-title pb-0 m-0 pt-1">Filter Stream</li>
        <li class="c-sidebar-nav-title p-0 m-0">
            <img src="/images/sharks-menu.svg" alt="">
        </li>
        <li class="c-sidebar-nav-title">Genre</li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="pop" @click="updateFilterGender('Pop')" data-genre="Pop">
                <label for="pop"><span>Pop</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="rap_hip_jop" @click="updateFilterGender('Rap & Hip-Hop')" data-genre="Rap & Hip-Hop">
                <label for="rap_hip_jop"><span>Rap & Hip-Hop</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="edm" @click="updateFilterGender('EDM')" data-genre="EDM">
                <label for="edm"><span>EDM</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="rock_metal" @click="updateFilterGender('Rock & Metal')" data-genre="Rock & Metal">
                <label for="rock_metal"><span>Rock & Metal</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="jazz_blues" @click="updateFilterGender('Jazz & Blues')" data-genre="Jazz & Blues">
                <label for="jazz_blues"><span>Jazz & Blues</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="classical" @click="updateFilterGender('Classical')" data-genre="Classical">
                <label for="classical"><span>Classical</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="funk" @click="updateFilterGender('Funk')" data-genre="Funk">
                <label for="funk"><span>Funk</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="world" @click="updateFilterGender('World')" data-genre="World">
                <label for="world"><span>World</span></label>
            </div>
        </li>
<!--        <li class="c-sidebar-nav-item">-->
<!--            <div class="filter-nav">-->
<!--                <input type="checkbox" id="latin" @click="updateFilterGender('Latin')" data-genre="Latin">-->
<!--                <label for="latin"><span>Latin</span></label>-->
<!--            </div>-->
<!--        </li>-->
        <li class="c-sidebar-nav-title">Topic</li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="performance_and_jams" @click="updateFilterCategory('Performances and Jams')">
                <label for="performance_and_jams"><span>Performances and Jams</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="production_engineering" @click="updateFilterCategory('Production & Engineering')" data-category="Production & Engineering">
                <label for="production_engineering"><span>Production & Engineering</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="vlogs" @click="updateFilterCategory('Vlogs')" data-category="Vlogs">
                <label for="vlogs"><span>Vlogs</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="instruments" @click="updateFilterCategory('Instruments')" data-category="Instruments">
                <label for="instruments"><span>Instruments</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="podcasts" @click="updateFilterCategory('Podcasts')" data-category="Podcasts">
                <label for="podcasts"><span>Podcasts</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item">
            <div class="filter-nav">
                <input type="checkbox" id="audio_clips" @click="updateFilterCategory('Audio Clips')" data-category="Audio Clips">
                <label for="audio_clips"><span>Audio Clips</span></label>
            </div>
        </li>
        <li class="c-sidebar-nav-item p-0">
            <div class="divider"></div>
        </li>
        <li class="c-sidebar-nav-title m-0 pb-0 pr-1">
            <div class="filter-nav">
                Following <img src="/images/icons/star-white.svg" width="20px" class="float-right">
            </div>
        </li>
        <li class="c-sidebar-nav-title mt-0 pt-0 pr-1">
            <img src="/images/sharks-menu.svg" alt="">
        </li>
        <div v-if="auth.username || location">
            <div v-for="(follow, index) in array" :key="index">
                <li class="c-sidebar-nav-item" v-if="follow.following.username">
                    <div class="filter-nav">
                        <a :href="`/${follow.following.username}/Channel/Activity`" class="no-underline text-white font-weight-bold">{{ follow.following.artistic_name}} <img src="/images/icons/check.svg" alt="" class="icon-check ml-1" v-if="follow.following.verification_date"></a>
                        <!--                    <span class="float-sm-right c-fifth dot">•</span>-->
                    </div>
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
    import Auth from "../../../helpers/Auth";
    import FilterPost from "../../../helpers/FilterPost";
    import Followers from "../../../helpers/Followers";
    export default {
        props:['following'],
        data(){
            return {
                auth: Auth.state,
                filters: FilterPost.state,
                location: false,
                followings: null
            }
        },
        components: {
            AppFooter
        },
        computed:{
            array(){
                if(this.followings === null) {
                    return this.following
                }else{
                    return this.followings
                }
            }
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
        }
    }
</script>
