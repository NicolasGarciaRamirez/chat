<template>
    <section class="relathions-ship" ref="ModalRelathions">
        <div class="modal fade" z-index="1050" role="dialog" aria-labelledby="ModalRelathions" aria-hidden="true" id="ModalRelathions">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content modal-border-white bg-black p-3">
                    <div class="justify-content-center">
                        <div class="nav">
                            <a :class="type_table === 'followers' ? 'text-white font-weight-bold cursor-pointer active ml-2': 'text-white font-weight-bold cursor-pointer ml-2'" id="Followers-menu" @click="type_table = 'followers', getClassActive()">Followers</a>
                            <a :class="type_table === 'following' ? 'text-white font-weight-bold cursor-pointer mx-4 active' : 'text-white font-weight-bold cursor-pointer mx-4'" id="Following-menu"  @click="type_table = 'following', getClassActive()">Following</a>
                        </div>
                        <div class="d-flex flex-row my-4">
                            <label class="m-2 font-weight-bold">{{type_table === 'followers' ? 'Followers' : 'Following'}} {{ array ? array.length : '0'}}</label>
                            <form action="/" class="form-search ml-1">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input class="form-control pl-3" type="text" placeholder="Search through followers..." autocomplete="none">
                                        <div class="d-flex align-items-center d-md-down-none icons-search">
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
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped bg-black text-center  text-white text-justify table-relathions">
                                <single-follower :class="index % 2 === 0 ? 'bg-primary':''" v-for="(user ,index) in array" :key="index" :user="user" :type_table="'followers'" v-if="array.length > 0 && type_table === 'followers'" />
                                <single-following :class="index % 2 === 0 ? 'bg-primary':''" v-for="(user ,index) in array" :key="index" :user="user" :type_table="'following'" v-if="array.length > 0 && type_table === 'following'" />
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../../../helpers/Auth";
    import SingleFollower from "../Relathions/Followers/SingleFollower";
    import SingleFollowing from "../Relathions/Following/SingleFollowing";

    export default {
        components: {SingleFollowing, SingleFollower},
        data(){
            return {
                type_table: window.location.href === `/${Auth.state.username}/Channel/Edit` ? this.$parent.type_table : 'following',
                follow_type: 'follow',
                follow:{
                    type: ''
                },
                followers:[],
                followings:[]
            }
        },
        mounted() {
            Auth.initialize()
            this.getClassActive()
            this.getUser()
            this.getFollowings()
        },
        computed:{
            array(){
                if(this.type_table === 'following'){
                    return this.followings
                }else{
                    return this.followers
                }
            }
        },
        methods:{
            getUser(){
                axios.post(`/User/get/${Auth.state.username}`).then(res =>{
                    _.each(res.data.user.followers , follow => {
                        this.followers.push(follow.user)
                    })
                }).catch(err =>{
                    console.log(err)
                })
            },
            getFollowings(){
                axios.post(`/User/get/followings/${Auth.state.username}`).then(res =>{
                    _.each(res.data.followings, following =>{
                        this.followings.push(following.following)
                    })
                }).catch(err =>{
                    console.log(err)
                })
            },
            getClassActive(){
                if (this.type_table === 'followers'){
                    $('#Followers-menu').addClass('active').removeClass('text-white')
                    $('#Following-menu').removeClass('active').addClass('text-white')
                }
                if (this.type_table === 'following'){
                    $('#Following-menu').addClass('active').removeClass('text-white')
                    $('#Followers-menu').removeClass('active').addClass('text-white')
                }
            }
        }


    }
</script>
