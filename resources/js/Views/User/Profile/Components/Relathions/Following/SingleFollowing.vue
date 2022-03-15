<template>
    <tr>
        <td class="d-flex align-items-center" style="min-width: max-content">
            <a :href="`/${user.username}/Channel/Activity`">
                <img :src="user.avatar" class="rounded-circle " style="width: 4rem" />
            </a>
            <label class="ml-3">
                {{user.artistic_name}} 
                <img src="/images/icons/check.svg" alt="" class="icon-check ml-1" v-if="user.verification_date">
                <svg class="icon-check d-none" style="transform: translateY(-2px)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path fill="#FFC34D" d="M4,11.5l1-4.8C5,6.2,5.7,6,6.1,6.5l2.8,3.8c0.4,0.6-0.1,0.7-2,3C4.5,12,3.8,12.3,4,11.5L4,11.5z"/> <path fill="#FFC34D" d="M17.1,13.2c-1.9-2.2-2.5-2.4-2-3l2.8-3.8c0.3-0.4,1-0.3,1.1,0.3l1,4.8C20.2,12.3,19.4,12.1,17.1,13.2z"/> <path fill="#FFEA80" d="M22,8.9l-4.6,3.4l-4.8-8.4c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-4.8,8.4L2,8.9 C1.5,8.5,0.9,9,1,9.6l1.8,6.9l1.2,0.7l-0.8,0.6l0.5,2.1c0.1,0.3,0.3,0.5,0.6,0.5h15.5c0.3,0,0.6-0.2,0.6-0.5l0.5-2.1l-0.5-0.6 l0.8-0.6L23,9.6C23.1,9,22.5,8.5,22,8.9L22,8.9z"/> <path fill="#FFEA80" d="M23,9.6l-1.8,6.9l-0.8,0.6l0.5,0.6l-0.5,2.1c-0.1,0.3-0.3,0.5-0.6,0.5H12V3.6c0.2,0,0.4,0.1,0.6,0.3 l4.8,8.4L22,8.9C22.5,8.5,23.1,9,23,9.6L23,9.6z"/> <path fill="#FF6A4D" d="M14.5,13.6l-1.9-3.2c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-1.9,3.2c-0.1,0.2-0.1,0.5,0,0.7 l1.9,3.2c0.1,0.2,0.3,0.3,0.6,0.3c0.2,0,0.4-0.1,0.6-0.3l1.9-3.2C14.6,14.1,14.6,13.8,14.5,13.6z"/> <path fill="#FF6A4D" d="M14.5,14.3l-1.9,3.2c-0.1,0.2-0.3,0.3-0.6,0.3v-7.7c0.2,0,0.4,0.1,0.6,0.3l1.9,3.2 C14.6,13.8,14.6,14.1,14.5,14.3z"/> <path fill="#FFC34D" d="M7.5,17.2c0,0.4-0.3,0.6-0.6,0.6H3.1l-0.3-1.3h4.1C7.2,16.5,7.5,16.8,7.5,17.2z"/> <path fill="#FFC34D" d="M21.2,16.5l-0.3,1.3h-3.7c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H21.2z"/> </svg>
            </label>
        </td>
        <td class="mx-3" :id="`btnFollow`+user.id">
            <button type="button"  class="align-items-right follow-following-active rounded-pill" @click="storeUnFollow" :disable="disable">
                <svg version="1.2" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1179 1080" xml:space="preserve" width="1rem"> <g id="Layer_2"> <g id="Layer_2-2"> <path fill="#141414" d="M1179,407.04l-402.88-55.63L587.74,0L404.99,352.76L0,414.5L292.81,690.6L228.6,1080l363.37-182.49 l365.48,179.1L886.9,687.89L1179,407.04z"  stroke="white" stroke-width="2em"/> </g> </g> <polygon class="st0" points="112.5,54.4 94,92.1 52.1,98.7 82,128.6 75.4,170.5 112.9,150.5 150.8,170.1 143.8,128.3 173.7,98.4 131.7,92.2 	"/> </svg>
            </button>
        </td>
        <td>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary">
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M21.1,4.9h-7.5l2.8-2.8c0.3-0.3,0.3-0.7,0-0.9c-0.3-0.3-0.7-0.3-0.9,0L12,4.6L8.6,1.2c-0.3-0.3-0.7-0.3-0.9,0 c-0.3,0.3-0.3,0.7,0,0.9l2.8,2.8H2.9C1.9,4.9,1,5.8,1,6.8v12.9c0,1.1,0.9,1.9,1.9,1.9h1.9v0.6c0,0.4,0.3,0.6,0.6,0.6 s0.6-0.3,0.6-0.6v-0.6h11.6v0.6c0,0.4,0.3,0.6,0.6,0.6s0.6-0.3,0.6-0.6v-0.6h2c1.1,0,1.9-0.9,1.9-1.9V6.8C23,5.8,22.1,4.9,21.1,4.9 z M17.8,18.5c0,0.4-0.3,0.6-0.6,0.6H4.2c-0.4,0-0.6-0.3-0.6-0.6V8.1c0-0.4,0.3-0.6,0.6-0.6h12.9c0.4,0,0.6,0.3,0.6,0.6V18.5z M20.4,17.2c0,0.4-0.3,0.6-0.6,0.6s-0.6-0.3-0.6-0.6v-2.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6V17.2z M19.7,12.6 c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,12.4,20.1,12.6,19.7,12.6z M19.7,10.1c-0.4,0-0.6-0.3-0.6-0.6 c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,9.8,20.1,10.1,19.7,10.1z"/> <path d="M4.9,8.8h11.6v9.1H4.9V8.8z"/> </g> </svg>
                </button>
                <button type="button" class="btn btn-secondary">
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M12,1c3.2,0,5.8,2.8,5.2,6.1c-0.3,2.1-2.1,3.7-4.3,4.2c-3.4,0.6-6.2-1.9-6.2-5.1C6.7,3.4,8.9,1,11.9,1H12z"/> <path d="M12,13.7c-5,0-9,3.7-9.5,8.5c0,0.5,0.3,0.8,0.8,0.8c3.1,0,14.5,0,17.5,0c0.4,0,0.7-0.3,0.7-0.7 C21,17.6,17,13.9,12,13.7z"/> </svg>
                </button>
            </div>
        </td>
    </tr>
</template>

<script>
    import Auth from "../../../../../../helpers/Auth";
    export default {
        name: "SingleRelathionFollowing",
        props:['user','type_table'],
        data(){
            return {
                disable:false,
                follow_type:'unFollow',
                follow:{
                    type:''
                },
                url: ''
            }
        },
        mounted() {
            Auth.initialize()
        },
        methods:{
            async storeUnFollow(){
                await Auth.setSession()
                this.disable = true
                if (this.user.followers) {
                    this.user.followers.map(follow =>{
                        if (Auth.state.username === follow.user.username) {
                            this.url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                        }
                    })
                }
                await axios.post(this.url , this.follow).then(res =>{
                    this.disable = false
                    if (res.data.unfollow){
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
                }).catch(err =>{
                    Auth.keepLogged(err.response.status)
                })
            }
        }
    }
</script>
