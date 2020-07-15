<template>
    <section class="relathions-ship">
        <div class="modal fade" z-index="1050" role="dialog" aria-labelledby="ModalRelathions" aria-hidden="true" id="ModalRelathions">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content modal-border-white p-3">
                    <div class="justify-content-center">
                        <div class="nav">
                            <a :class="$parent.type_table === 'followers' ? 'text-white font-weight-bold cursor-pointer active': 'text-white font-weight-bold cursor-pointer'" id="Followers-menu" @click.prevent="$parent.type_table = 'followers', getClassActive()">Followers</a>
                            <a :class="$parent.type_table === 'following' ? 'text-white font-weight-bold cursor-pointer mx-4 active' : 'text-white font-weight-bold cursor-pointer mx-4'" id="Following-menu"  @click.prevent="$parent.type_table = 'following', getClassActive()">Following</a>
                        </div>
                        <div class="d-flex flex-row my-4">
                            <label class="m-2">{{array.length}} {{$parent.type_table === 'followers' ? 'Followers' : '' || $parent.type_table === 'following' ? 'Following' : ''}}</label>
                            <form action="/" class="form-search ml-1">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input class="form-control pl-3" type="text" placeholder="Search through followers..." autocomplete="none">
                                        <div class="d-flex align-items-center icons-search">
                                            <div class="divider-vertical mx-2"></div>
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 width="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve">
                                                <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594
                                                C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488
                                                l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719
                                                s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-responsive-sm table-striped text-white bg-primary table-menu table-borderless">
                            <tbody >
                                <tr v-for="(user ,index) in array" :key="index" v-if="array.length > 0">
                                    <td><img :src="user.avatar" class="rounded-circle " style="width: 4rem" /></td>
                                    <td>{{user.personal_information.full_name}}</td>
                                    <td :id="'follow'+user.token">
                                        <button type="button"  class="align-items-right follow-idle" @click="addClassFollow">
                                            {{follow_type === 'unFollow' ? 'Following' : 'Follow Back'}}
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
                                    <td>
                                        <label class=""><a :href="`/${user.username}/Profile`" class="no-underline font-weight-bold text-white" >View Profile</a></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Followers from "../../../../helpers/Followers";
    import Auth from "../../../../helpers/Auth";

    export default {
        data(){
            return {
                follow_type: 'follow',
                follow:{
                    type: ''
                },
                followers:[]
            }
        },
        mounted() {
            Auth.initialize()
            Followers.initialize()
            this.getClassActive()
            this.getUser()
        },
        computed:{
            array(){
                if(this.$parent.type_table === 'following'){
                    return JSON.parse(Followers.data.followers)
                }else{
                    return this.followers
                }
            }
        },
        methods:{
            getUser(){
                let matches = []
                let users_follow = []
                let following = JSON.parse(Followers.data.followers)
                axios.post(`/User/get/${Auth.state.username}`).then(res =>{
                    _.each(res.data.user.followers , follow => {
                        this.followers.push(follow.user)
                        _.each(follow.user.followers, user =>{
                            users_follow.push(user.user)
                        })
                    })
                    for ( let i = 0; i < users_follow.length; i++ ) {
                        for ( let e = 0; e < following.length; e++ ) {
                            if ( users_follow[i].username === following[e].username ) {
                                matches.push( users_follow[i] )
                            }
                        }
                    }

                    matches.map(u =>{
                        $(`table tbody td #follow`+u.token+' button').addClass('follow-active').removeClass('follow-idle')
                    })

                }).catch(err =>{
                    console.log(err)
                })
            },
            getClassActive(){
                if (this.$parent.type_table === 'followers'){
                    $('#Followers-menu').addClass('active').removeClass('text-white')
                    $('#Following-menu').removeClass('active').addClass('text-white')
                }
                if (this.$parent.type_table === 'following'){
                    $('#Following-menu').addClass('active').removeClass('text-white')
                    $('#Followers-menu').removeClass('active').addClass('text-white')
                }
            },
            addClassFollow(){
                if (this.follow_type === 'follow'){
                    $(`#btnFollow`+this.user.token).addClass('follow-active').removeClass('follow-idle')
                }
            },
            storeFollow(){
                axios.post(url, request)
            }
        }


    }
</script>
