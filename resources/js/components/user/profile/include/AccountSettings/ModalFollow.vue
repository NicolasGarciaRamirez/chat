<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalFollow" aria-hidden="true" id="ModalFollow">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content modal-border-white p-3">
                    <div class="justify-content-center">
                        <div class="cursor-pointer">
                            <a class="text-white font-weight-bold" id="Followers-menu" @click="$parent.type_table = 'followers', getClassActive()" >Followers</a>
                            <a class="text-white font-weight-bold mx-4" id="Following-menu"  @click="$parent.type_table = 'following', getClassActive()">Following</a>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <span>{{user.followers.length}} {{$parent.type_table === 'followers' ? 'Followers' : '' || $parent.type_table === 'following' ? 'Following' : ''}}</span>
                        </div>
                        <table class="table table-responsive-sm table-striped text-white bg-primary table-menu table-borderless">
                            <tbody >
                                <tr v-for="(follow ,index) in user.followers" :key="index" >
                                    <td><img :src="follow.user.avatar" class="rounded-circle " style="width: 4rem" /></td>
                                    <td>{{follow.user.personal_information.full_name}}</td>
                                    <td>
                                        <button type="button" class="bg-primary align-items-right border-white follow-idle">
                                            Follow
                                            <svg version="1.2" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 x="0px" y="0px" viewBox="0 0 1179 1080" xml:space="preserve" width="1rem" class="ml-2">
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
                                        <label class=""><a :href="`/${follow.user.username}/Profile`" class="no-underline font-weight-bold text-white" >View Profile</a></label>
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
    export default {
        props:['user'],
        mounted() {
            this.getClassActive()
        },
        computed:{

        },
        methods:{
            getClassActive(){
                if (this.$parent.type_table === 'followers'){
                    $('#Followers-menu').addClass('active c-fifth').removeClass('text-white')
                    $('#Following-menu').removeClass('active c-fifth').addClass('text-white')

                }
                if (this.$parent.type_table === 'following'){
                    $('#Following-menu').addClass('active c-fifth').removeClass('text-white')
                    $('#Followers-menu').removeClass('active c-fifth').addClass('text-white')
                }
            }
        }


    }
</script>
