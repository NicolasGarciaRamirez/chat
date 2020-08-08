-following-<template>
    <tr>
        <td>
            <a :href="`/${user.username}/Profile`">
                <img :src="user.avatar" class="rounded-circle " style="width: 4rem" />
            </a>
        </td>
        <td>
            {{user.profile_information && user.profile_information.artistic_name ? user.profile_information.artistic_name : user.personal_information.full_name}}
        </td>
        <td class="mx-3" :id="`btnFollow`+user.id">
            <button type="button"  class="align-items-right follow-following-active" @click="storeUnFollow" :disable="disable">
                <svg version="1.2" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" viewBox="0 0 1179 1080" xml:space="preserve" width="1rem">
                    <g id="Layer_2">
                        <g id="Layer_2-2">
                            <path fill="#141414" d="M1179,407.04l-402.88-55.63L587.74,0L404.99,352.76L0,414.5L292.81,690.6L228.6,1080l363.37-182.49
                            l365.48,179.1L886.9,687.89L1179,407.04z"  stroke="white" stroke-width="2em"/>
                        </g>
                    </g>
                </svg>
            </button>
        </td>
    </tr>
</template>

<script>
    import Auth from "../../../../../../helpers/Auth";
    import Followers from "../../../../../../helpers/Followers";
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
            Followers.initialize()
            Auth.initialize()
        },
        methods:{
            addClassFollow(){
                $('#btnFollow'+this.user.id+' button').addClass('follow--following-active').removeClass('follow-following--idle')
            },
            storeUnFollow(){
                this.disable = true
                if (this.user.followers) {
                    this.user.followers.map(follow =>{
                        if (Auth.state.username === follow.user.username) {
                            this.url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                        }
                    })
                }
                axios.post(this.url , this.follow).then(res =>{
                    this.disable = false
                    if (res.data.unfollow){
                        Followers.set(res.data.following)
                        window.location.reload()
                    }
                }).catch(err =>{

                })
            }
        }
    }
</script>
