<template>
    <div>
        <section class="stream mx-auto pt-4">
            <public-post-desktop :users="user" class="d-none d-lg-block"></public-post-desktop>
            <posts ref="posts" :user="user" v-if="!(route_name === 'http://localhost:8000/Form' || route_name === 'https://www.noisesharks.com/Form')" />
            <div class="cross-center m-2" v-if="loading_paginate">
                <div class="position-absolute mb-2">
                    <img src="/images/logo-white.svg" class="img-fluid" style="width: 3.95rem">
                </div>
                <div class="spinner-border text-danger" role="status" style="width: 6.50rem; height: 6.50rem">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <modal-live-stream></modal-live-stream>
            <modal-mobile/>
            <modal-alert :user="auth"></modal-alert>
            <badge-more-100></badge-more-100>
            <alert-upload-meter ref="alertUploadMeter"></alert-upload-meter>
        </section>
    </div>
</template>

<script>
    import PublicPostDesktop from "../post/PublicPostDesktop";
    import Auth from "../../../helpers/Auth";
    import Posts from "../../Posts/Views/Posts";
    import ModalLiveStream from "../../CommingSoon/Components/ModalLiveStream";
    import ModalMobile from "../../CommingSoon/Components/ModalMobile";
    import ModalAlert from "../Components/ModalAlert";
    import FilterPost from "../../../helpers/FilterPost";
    import AlertUploadMeter from '../Components/AlertUploadMeter';
    import ModalBadgeMore100 from '../Components/ModalBadgeMore100';

    export default {
        name: "Index",
        props:['user'],
        components:{
            'badge-more-100':ModalBadgeMore100,
            ModalAlert,
            Posts,
            ModalLiveStream,
            ModalMobile,
            PublicPostDesktop,
            AlertUploadMeter
        },
        data(){
            return {
                route_name: window.location.href,
                loading: false,
                auth : Auth.state,
                all_post: [],
                loading_paginate: false,
                data_paginate: "",
                valid_filter: false,
            }
        },
        async mounted(){
            FilterPost.initialize()
            Auth.initialize()
            let self = this
            let data = FilterPost.jsonParseAttributes()

            if(data.genres !== null && data.categories !== null){
                if(data.genres.length < 1 && data.categories.length < 1) {
                    await this.getPosts()
                }else{
                    await this.filterPost()
                }
            }else if(data.genres === null && data.categories === null) {
                await this.getPosts()
            }else {
                if(data.genres ? data.genres.length < 1 : data.genres ){
                    await this.getPosts()
                }
                if(data.categories ? data.categories.length < 1 : data.categories){
                    await this.getPosts()
                }
            }
            let petition_finish = true
            $(window).scroll(function () {
                if(!self.$refs.posts.hiddePost) {
                    if (self.data_paginate.last_page !== self.data_paginate.current_page) {
                        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 200)) {
                            if (self.valid_filter) {
                                self.loading_paginate = true

                                if(!petition_finish){return false}
                                petition_finish = false

                                axios.post(self.data_paginate.next_page_url).then(res => {
                                    if (res.data.posts) {
                                        petition_finish = true
                                        let post_order = _.orderBy(res.data.posts.data, ['score'], ['desc'])
                                        _.each(post_order, function (post) {
                                            if (_.findIndex(self.all_post, function (o) {
                                                return o.token === post.token
                                            }) === -1) {
                                                self.all_post.push(post)
                                                self.data_paginate = res.data.posts
                                                self.loading_paginate = true
                                            }
                                        })
                                        self.orderPost()
                                    }
                                }).catch(err => {
                                    Auth.keepLogged(err.response.status)
                                })
                            } else {
                                self.loading_paginate = false
                            }
                        }
                    } else {
                        self.loading_paginate = false
                    }
                }else{
                    self.loading_paginate = false
                }
            })
            if(Auth.state.username) await Auth.setSession()
        },
        methods:{
            orderPost(){
                this.$refs.posts.posts = _.orderBy(this.all_post, ['score'], ['desc'])
            },
            async getPosts(state = null){
                this.valid_filter = true
                let self = this
                this.loading_paginate = true
                await axios.post('/Paginate/Posts').then(res => {
                    if (res.data) {
                        this.filter_valid = true
                        let post_order = _.orderBy(res.data.posts.data, ['score'], ['desc'])
                        this.loading_paginate = false
                        this.data_paginate = res.data.posts
                        if (this.data_paginate.last_page !== this.data_paginate.current_page) {
                            if(state !== null){
                                this.all_post = post_order
                            }else {
                                this.all_post.length > 0 ? this.all_post : this.all_post = []
                                _.each(post_order, function (post) {
                                    self.all_post.push(post)
                                })
                                this.orderPost()
                            }
                        }
                    } else { this.loading_paginate = false }
                }).catch(err => {Auth.keepLogged(err.response.status)})
            },
            async filterPost(){
                this.valid_filter = false
                let data = {
                    categories: JSON.parse(FilterPost.state.categories) === null ? [] : JSON.parse(FilterPost.state.categories)  ,
                    genres: JSON.parse(FilterPost.state.genres) === null ? [] : JSON.parse(FilterPost.state.genres)
                }
                if(data.categories || data.genres){
                    if(data.categories.length >= 1 || data.genres.length >= 1){
                        await axios.post('/Post/Filters', data).then(res =>{
                            if(res.data.posts){
                                if(data.categories !== null || data.genres !== null){
                                    let post_order = _.orderBy(res.data.posts, ['score'], ['desc'])
                                    this.all_post = post_order
                                    this.$refs.posts.posts = post_order
                                }
                            }
                        }).catch(err =>{Auth.keepLogged(err.response.status)})
                    }else{
                        this.all_post = []
                        await this.getPosts()
                    }
                }
            },
        }
    }
</script>
