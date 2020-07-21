<template>
    <section>
        <label>
            <a :href="`/${user.username}/Profile`">
                <img :src="user.avatar" class="rounded-circle " style="width: 4rem" />
            </a>
        </label>
        <label>
            {{user.personal_information.full_name}}
        </label>
        <label class="mx-3" :id="`btnFollow`+user.id">
            <button type="button"  class="align-items-right follow-idle" @click="addClassFollow">

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
        </label>
        <label class="d-md-down-none"><a :href="`/${user.username}/Profile`" class="no-underline font-weight-bold text-white mx-3" >View Profile</a></label>
        <label class="d-md-down-none font-weight-bold text-white">Message {{ user.personal_information.first_name}}</label>
    </section>
</template>

<script>
    import Auth from "../../../../../../helpers/Auth";
    import Followers from "../../../../../../helpers/Followers";
    export default {
        name: "SingleRelathionFollowers",
        props:['user','type_table'],
        data(){
            return {
                // follow_type:'unFollow',
                follow:{
                    type:''
                },
            }
        },
        mounted() {
            Followers.initialize()
            Auth.initialize()
            this.getFollowers()
        },
        computed:{
            follow_type(){
                if ($('#btnFollow'+this.user.id+' button').hasClass('follow-active')){
                    return 'unFollow'
                }
                return 'follow'
            }
        },
        methods:{
            addClassFollow(){
                if(this.follow_type === 'unFollow'){
                    $('#btnFollow'+this.user.id+' button').addClass('follow-active').removeClass('follow-idle')
                    this.storeUnFollow(this.follow_type)
                }else if(this.follow_type === 'follow'){
                    $('#btnFollow'+this.user.id+' button').addClass('follow-idle').removeClass('follow-active')
                    this.storeFollow(this.follow_type)
                }
            },
            getFollowers(){
                if(this.type_table === "followers"){
                    let object = JSON.parse(Followers.data.followers)
                    let objects =  this.$parent.followers

                    let array_matchs = _.intersectionBy(object, objects, 'id')
                    _.each(array_matchs , match=>{
                        $('#btnFollow'+match.id+' button').addClass('follow-active').removeClass('follow-idle')
                    })
                }
            },
            storeFollow(type){
                let request = ''
                if (type === 'follow') {
                    if (Auth.state.username) {
                        this.follow.type = 'Followed'
                    }else{
                        this.follow.type = 'Follower'
                    }
                }

                axios.post(`/${Auth.state.username}/Follow/follow/${this.user.id}`, this.follow).then(res =>{
                    if (res.data.follow) {
                        this.follow_type = 'unFollow'
                        Followers.set(res.data.following)
                        window.location.reload()
                    }

                }).catch(err =>{
                    console.log(err)
                })
            },
            storeUnFollow(type){
                let request = ''
                let url = ''
                if (type === 'unFollow') {
                    request = this.follow
                    if (this.user.followers) {
                        this.user.followers.map(follow =>{
                            if (Auth.state.username === follow.user.username) {
                                url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                            }
                        })
                    }
                }

                axios.post(url, request).then(res=>{
                    if (res.data.unfollow) {
                        this.follow_type = 'follow'
                        Followers.set(res.data.following)
                        window.location.reload()
                    }
                }).catch(err=>{
                    console.log(err)
                })

            }
        }
    }
</script>
