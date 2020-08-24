<template>
    <tr v-if="user">
        <td>
            <a :href="`/${user.username}/Profile`">
                <img :src="user.avatar" class="rounded-circle " style="width: 4rem" />
            </a>
        </td>
        <td>
            <label>{{user.artistic_name}}<img src="/images/icons/check.svg" alt="" class="icon-check ml-1" v-if="user.verification_date"></label>
        </td>
        <td class="mx-3" :id="`btnFollow`+user.id">
            <button type="button"  class="align-items-right follow-following-idle" @click="!disable_follow && follow_type === 'follow' ? storeFollow() : '' || !disable_follow && follow_type === 'unFollow' ? storeUnFollow() : ''">
                <svg version="1.2" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" viewBox="0 0 1179 1080" xml:space="preserve" width="1rem">
                    <g id="Layer_2">
                        <g id="Layer_2-2">
                            <path fill="#141414" d="M1179,407.04l-402.88-55.63L587.74,0L404.99,352.76L0,414.5L292.81,690.6L228.6,1080l363.37-182.49
                            l365.48,179.1L886.9,687.89L1179,407.04z"  stroke="white" stroke-width="2em"/>
                        </g>
                    </g>
                    <polygon class="st0" points="112.5,54.4 94,92.1 52.1,98.7 82,128.6 75.4,170.5 112.9,150.5 150.8,170.1 143.8,128.3 173.7,98.4 131.7,92.2"/>
                </svg>
            </button>
        </td>
    </tr>
</template>

<script>
    import Auth from "../../../../../../helpers/Auth";
    import Followers from "../../../../../../helpers/Followers";
    export default {
        name: "SingleRelathionFollowers",
        props:['user','type_table'],
        data(){
            return {
                follow:{
                    type:''
                },
                follow_type: 'follow',
                disable_follow: false
            }
        },
        mounted() {
            Followers.initialize()
            Auth.initialize()
            this.getFollowers()
        },
        methods:{
            getFollowers(){
                let object = this.$parent.followings
                let objects =  this.$parent.followers

                let array_matches = _.intersectionBy(object, objects, 'id')
                _.each(array_matches , match=>{
                    if(this.user.id === match.id){
                        $('#btnFollow'+match.id+' button').addClass('follow-following-active').removeClass('follow-following-idle')
                        this.follow_type = 'unFollow'
                    }
                })
            },
            async storeFollow(){
                await Auth.setSession()
                this.disable_follow = true
                let request = ''
                if (Auth.state.username === this.user.username) {
                    this.follow.type = 'Followed'
                }else{
                    this.follow.type = 'Follower'
                }
                await axios.post(`/${Auth.state.username}/Follow/follow/${this.user.id}`, this.follow).then(res =>{
                    if (res.data.follow) {
                        $('#btnFollow'+this.user.id+' button').addClass('follow-following-active').removeClass('follow-following-idle')
                        this.disable_follow = false
                        this.user.followers.push(res.data.follow)
                        this.$root.$refs.AppNav.followings = res.data.followings
                        this.$parent.followings = []
                        _.each(res.data.followings, following =>{
                            this.$parent.followings.push(following.following)
                        })
                        this.follow_type = 'unFollow'
                        let self = this
                        _.forEach(this.$root.$refs.home.$refs.posts.$children, function(children, key){
                            if(key > 4){
                                if(children.post.user.username === self.user.username){
                                    children.follow_type = 'unfollow'
                                    children.post.user.followers.push(res.data.follow)
                                    $(`#follow`+children.post.token+' button').addClass('follow-active').removeClass('follow-idle')
                                }
                            }
                        })

                    }
                }).catch(err =>{
                    console.log(err)
                })
            },
            async storeUnFollow(){
                await Auth.setSession()
                this.disable_follow = true
                let url = ''

                if (this.user.followers) {
                    this.user.followers.map(follow =>{
                        if (Auth.state.username === follow.user.username) {
                            url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                        }
                    })
                }
                await axios.post(url, this.follow).then(res=>{
                    if (res.data.unfollow) {
                        $('#btnFollow'+this.user.id+' button').removeClass('follow-following-active').addClass('follow-following-idle')
                        this.disable_follow = false
                        this.follow_type = 'follow'
                        this.$root.$refs.AppNav.followings = res.data.followings
                        this.$parent.followings = []
                        _.each(res.data.followings, following =>{
                            this.$parent.followings.push(following.following)
                        })
                        let self = this
                        _.forEach(this.$root.$refs.home.$refs.posts.$children, function(children, key){
                            if(key > 4){
                                if(children.post.user.username === self.user.username){
                                    children.follow_type = 'follow'
                                    $(`#follow`+children.post.token+' button').addClass('follow-idle').removeClass('follow-active')
                                }
                            }
                        })
                    }
                }).catch(err=>{
                    console.log(err)
                })
            }
        }
    }
</script>
