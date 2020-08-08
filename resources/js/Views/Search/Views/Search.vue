<template>
    <section class="position-relative" v-click-outside="hideSearch">
        <form @submit.prevent="showContentSearch()" class="header-form-search d-none d-lg-block" v-if="!only_view">
            <div class="form-group m-0">
                <div class="input-group">
                    <input class="form-control pl-4" type="text" placeholder="Search for posts, hashtags, etc..." autocomplete="none" v-model="search_body" @keyup="showContentSearch()">
                    <div class="divider-vertical"></div>
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="17px" height="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve">
                        <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594
                        C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488
                        l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719
                        s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>
                    </svg>
                </div>
            </div>
        </form>
        <form @submit.prevent="showContentSearch()" class="header-form-search" v-else>
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control pl-4 ml-3" type="text" placeholder="Search for posts, hashtags, etc..." autocomplete="none" v-model="search_body" @keyup="showContentSearch()">
                    <div class="divider-vertical"></div>
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="17px" height="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve">
                        <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594
                        C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488
                        l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719
                        s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>
                    </svg>
                </div>
            </div>
        </form>
        <div class="d-flex flex-column bg-primary search" v-if="result_search.length  !== 0">
            <a :href="`/${user.username}/Profile`" class="d-flex flex-row bg-primary p-2" v-for="(user, index) in result_search" :key="index">
                <div>
                    <img :src="user.avatar" class="rounded-circle img-profile-search">
                </div>
                <div class="d-flex flex-column ml-2">
                    <span class="font-weight-bold text-white">{{user.artistic_name}}</span>
                    <div class="content-info-search">
                        <span class="bg-fifth text-white p-1 font-weight-bold mr-2">{{user.profile_information.title}}</span>
                        <span class="bg-white c-fifth p-1 font-weight-bold d-flex align-items-center" v-if="user.subscription_type === 'CONTRIBUTOR'">CONTRIBUTOR<img src="/images/icons/music-red.svg" width="14rem" class="ml-1"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="d-flex flex-column bg-primary search" v-if="without_results">
            <p>Without results</p>
        </div>
    </section>
</template>

<script>
    import vClickOutside from 'v-click-outside'
    export default {
        name: "Search",
        props:['only_view'],
        data(){
            return{
                result_search: [],
                search_body: null,
                without_results: false
            }
        },
        directives: {
            clickOutside: vClickOutside.directive
        },
        methods:{
            hideSearch(){
                this.result_search = []
                this.search_body = null
                this.without_results = false
            },
            async showContentSearch(){
                this.without_results = false

                if(this.search_body.length < 5){
                    this.result_search = []
                    return  false
                }
                var data = {
                    search_body: this.search_body
                }
                await axios.post(`/Search`, data).then(res => {
                    this.result_search = res.data.result
                    if(this.result_search.length === 0) this.without_results = true
                })
            },
        }
    }
</script>


