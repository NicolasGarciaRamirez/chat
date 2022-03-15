<template>
    <section class="position-relative" v-click-outside="hideSearch">
        <form @submit.prevent="showContentSearch()" class="header-form-search d-none d-lg-block" v-if="!only_view">
            <div class="form-group m-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for posts,  hashtags, etc ..." autocomplete="none" v-model="search_body" @keyup="showContentSearch()">
                    <div class="divider-vertical"></div>
                    <svg class="icon"  viewBox="0 0 24 24"> <g> <path class="st0" d="M22.5,19.9l-5.1-5.1c0.9-1.4,1.4-3,1.4-4.8c0-5-4-9-8.9-9S1,5,1,10s4,9,8.9,9c1.9,0,3.6-0.6,5.1-1.6l5,5.1 c0.3,0.4,0.8,0.5,1.3,0.5c0.5,0,0.9-0.2,1.3-0.5C23.2,21.8,23.2,20.6,22.5,19.9z M9.9,16.1c-3.3,0-6-2.7-6-6.1s2.7-6.1,6-6.1 s6,2.7,6,6.1S13.2,16.1,9.9,16.1z"/> </g> </svg>
                </div>
            </div>
        </form>
        <form @submit.prevent="showContentSearch()" class="header-form-search" v-else>
            <div class="form-group m-0">
                <div class="input-group">
                    <input class="form-control " type="text" placeholder="Search profiles..." autocomplete="none" v-model="search_body" @keyup="showContentSearch()">
                    <div class="divider-vertical"></div>
                    <svg class="icon"  viewBox="0 0 24 24"> <g> <path class="st0" d="M22.5,19.9l-5.1-5.1c0.9-1.4,1.4-3,1.4-4.8c0-5-4-9-8.9-9S1,5,1,10s4,9,8.9,9c1.9,0,3.6-0.6,5.1-1.6l5,5.1 c0.3,0.4,0.8,0.5,1.3,0.5c0.5,0,0.9-0.2,1.3-0.5C23.2,21.8,23.2,20.6,22.5,19.9z M9.9,16.1c-3.3,0-6-2.7-6-6.1s2.7-6.1,6-6.1 s6,2.7,6,6.1S13.2,16.1,9.9,16.1z"/> </g> </svg>
                </div>
            </div>
        </form>
        <div class="d-flex flex-column bg-second border-radius search" v-if="result_search.length  !== 0">
            <a :href="`/${user.username}/Channel/Activity`" class="d-flex flex-row p-2" v-for="(user, index) in result_search" :key="index">
                <div>
                    <img :src="user.avatar" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <span class="font-weight-bold text-white">
                        {{user.artistic_name}}
                        <img src="/images/icons/check.svg" width="14" style="width: 0.75rem;" v-if="user.verification_date">
                        <svg class="icon-check d-none" style="transform: translateY(-2px)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path fill="#FFC34D" d="M4,11.5l1-4.8C5,6.2,5.7,6,6.1,6.5l2.8,3.8c0.4,0.6-0.1,0.7-2,3C4.5,12,3.8,12.3,4,11.5L4,11.5z"/> <path fill="#FFC34D" d="M17.1,13.2c-1.9-2.2-2.5-2.4-2-3l2.8-3.8c0.3-0.4,1-0.3,1.1,0.3l1,4.8C20.2,12.3,19.4,12.1,17.1,13.2z"/> <path fill="#FFEA80" d="M22,8.9l-4.6,3.4l-4.8-8.4c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-4.8,8.4L2,8.9 C1.5,8.5,0.9,9,1,9.6l1.8,6.9l1.2,0.7l-0.8,0.6l0.5,2.1c0.1,0.3,0.3,0.5,0.6,0.5h15.5c0.3,0,0.6-0.2,0.6-0.5l0.5-2.1l-0.5-0.6 l0.8-0.6L23,9.6C23.1,9,22.5,8.5,22,8.9L22,8.9z"/> <path fill="#FFEA80" d="M23,9.6l-1.8,6.9l-0.8,0.6l0.5,0.6l-0.5,2.1c-0.1,0.3-0.3,0.5-0.6,0.5H12V3.6c0.2,0,0.4,0.1,0.6,0.3 l4.8,8.4L22,8.9C22.5,8.5,23.1,9,23,9.6L23,9.6z"/> <path fill="#FF6A4D" d="M14.5,13.6l-1.9-3.2c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-1.9,3.2c-0.1,0.2-0.1,0.5,0,0.7 l1.9,3.2c0.1,0.2,0.3,0.3,0.6,0.3c0.2,0,0.4-0.1,0.6-0.3l1.9-3.2C14.6,14.1,14.6,13.8,14.5,13.6z"/> <path fill="#FF6A4D" d="M14.5,14.3l-1.9,3.2c-0.1,0.2-0.3,0.3-0.6,0.3v-7.7c0.2,0,0.4,0.1,0.6,0.3l1.9,3.2 C14.6,13.8,14.6,14.1,14.5,14.3z"/> <path fill="#FFC34D" d="M7.5,17.2c0,0.4-0.3,0.6-0.6,0.6H3.1l-0.3-1.3h4.1C7.2,16.5,7.5,16.8,7.5,17.2z"/> <path fill="#FFC34D" d="M21.2,16.5l-0.3,1.3h-3.7c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H21.2z"/> </svg>
                    </span>
                    <div class="content-info-search">
                        <span class="title-tag">{{user.profile_information ? user.profile_information.title : 'Profile Title not choosen'}}</span>
                        <span class="contributor-tag" v-if="user.subscription_type === 'CONTRIBUTOR'">CONTRIBUTOR<img src="/images/icons/music-red.svg" class="contributor-icon"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="d-flex flex-column bg-second border-radius text-align-center search c-fourth" v-if="without_results">
            <p>Oopps! No results here! Try again!</p>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import vClickOutside from "v-click-outside";
    export default {
        name: "Search",
        props:['only_view'],
        directives: {
            clickOutside: vClickOutside.directive
        },
        data(){
            return{
                result_search: [],
                search_body: null,
                without_results: false
            }
        },
        methods:{
            hideSearch(){
                this.result_search = []
                this.search_body = null
                this.without_results = false
            },
            async showContentSearch(){
                this.without_results = false

                if(this.search_body.length < 0){
                    this.result_search = []
                    return  false
                }
                var data = {
                    search_body: this.search_body
                }
                await axios.post(`/Search`, data).then(res => {
                    this.result_search = res.data.result
                    if(this.result_search.length === 0) this.without_results = true
                }).catch(err=>{Auth.keepLogged(err.response.status)})
            },
        }
    }
</script>


