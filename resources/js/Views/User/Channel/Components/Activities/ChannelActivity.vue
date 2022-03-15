<template>
    <section class="channel">
        <modal-login />
        <modal-new-playlist />
        <modal-share-post></modal-share-post>
        <div class="navigation-header">
            <div class="navigation-header__select-section bg-black">
                <h3>
                    <a href="#" :class="'text-white font-weight-bold active'" :style="'border-radius:0 0 0 0.6rem;'">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="mr-2"> <path d="M21.1,4.9h-7.5l2.8-2.8c0.3-0.3,0.3-0.7,0-0.9c-0.3-0.3-0.7-0.3-0.9,0L12,4.6L8.6,1.2c-0.3-0.3-0.7-0.3-0.9,0 c-0.3,0.3-0.3,0.7,0,0.9l2.8,2.8H2.9C1.9,4.9,1,5.8,1,6.8v12.9c0,1.1,0.9,1.9,1.9,1.9h1.9v0.6c0,0.4,0.3,0.6,0.6,0.6 s0.6-0.3,0.6-0.6v-0.6h11.6v0.6c0,0.4,0.3,0.6,0.6,0.6s0.6-0.3,0.6-0.6v-0.6h2c1.1,0,1.9-0.9,1.9-1.9V6.8C23,5.8,22.1,4.9,21.1,4.9 z M17.8,18.5c0,0.4-0.3,0.6-0.6,0.6H4.2c-0.4,0-0.6-0.3-0.6-0.6V8.1c0-0.4,0.3-0.6,0.6-0.6h12.9c0.4,0,0.6,0.3,0.6,0.6V18.5z M20.4,17.2c0,0.4-0.3,0.6-0.6,0.6s-0.6-0.3-0.6-0.6v-2.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6V17.2z M19.7,12.6 c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,12.4,20.1,12.6,19.7,12.6z M19.7,10.1c-0.4,0-0.6-0.3-0.6-0.6 c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,9.8,20.1,10.1,19.7,10.1z"/> <path d="M4.9,8.8h11.6v9.1H4.9V8.8z"/> </svg>
                        Channel
                    </a>
                </h3>
                <h3>
                    <a :href="`/${user.username}/Profile`" class="c-fourth font-weight-bold" style="border-radius:0 0 .6rem 0;">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="mr-1"> <path d="M12,1c3.2,0,5.8,2.8,5.2,6.1c-0.3,2.1-2.1,3.7-4.3,4.2c-3.4,0.6-6.2-1.9-6.2-5.1C6.7,3.4,8.9,1,11.9,1H12z"/> <path d="M12,13.7c-5,0-9,3.7-9.5,8.5c0,0.5,0.3,0.8,0.8,0.8c3.1,0,14.5,0,17.5,0c0.4,0,0.7-0.3,0.7-0.7 C21,17.6,17,13.9,12,13.7z"/> </svg>
                        About
                    </a>
                </h3>
            </div>
            <div class="navigation-header__select-subsection d-none d-lg-block">
                <a :href="`/${user.username}/Channel/Activity`" class="active">Activity</a>
                <!-- <a :href="`/${user.username}/Channel/Playlist`" class="text-white font-weight-bold">Playlist</a> -->
            </div>
        </div>
        <div class="row navigation-body flex-row-reverse ">
            <div class="col-12 col-lg-4" v-if="user.subscription_type ==='CONTRIBUTOR'">
                <div class="mr-lg-3" v-if="user.channel_information">
                    <div class="navigation-body__content" v-if="user.channel_information">
                        <h4 class="font-weight-bold text-white mb-3">Why Support Channel?</h4>
                        <p class="mb-0">
                            {{user.channel_information.why_support}}
                        </p>
                    </div>
                    <div class="navigation-body__content d-flex flex-column text-center tier" v-if="user.channel_information" >
                        <h4 class="font-weight-bold"> Monthly Goal </h4>
                        <!-- £ -->
                        <div class="d-flex flex-row justify-content-center align-items-center px-4">
                            <span>
                                {{user.channel_information && user.channel_information.monthly_goal_last ? user.channel_information.monthly_goal_last.currency:''}}{{user.channel_information && user.channel_information.monthly_goal_last ? (user.channel_information.monthly_goal_last.current_earnings.toFixed(2) ) : 0}}
                            </span>
                            <div class="bg-fourth progress m-2" style="height: 4px">
                                <div class="progress-bar bg-fifth" role="progressbar" :style="'width:'+user.channel_information.monthly_goal_last.percentage_completed+'%'" :aria-valuenow="user.channel_information.monthly_goal_last.percentage_completed" aria-valuemin="0" aria-valuemax="100">
                                    <div class="line-monthly-goal"></div>
                                </div>
                            </div>
                            <span class="text-white">{{user.channel_information && user.channel_information.monthly_goal_last ? user.channel_information.monthly_goal_last.currency: ''}}{{user.channel_information && user.channel_information.monthly_goal_last ? user.channel_information.monthly_goal_last.monthly_goal : 0}}</span>
                        </div>
                    </div>
                    <div class="navigation-body__content" v-if="user.channel_information.tiers.length">
                        <div class="d-flex flex-column text-center px-2 pb-3'" v-for="(tier, index) in user.channel_information ? user.channel_information.tiers : []" :key="index" >
                            <h4 class="font-weight-bold m-0 pb-3" v-if="index <= 0">What Will Supporters Get?</h4>
                            <h5 class="font-weight-bold mb-3">{{tier.name}}</h5>
                            <p class="d-flex justify-content-center"> <!-- style="white-space: pre-line" -->
                                {{tier.description}}
                            </p>
                            <div :class="user.channel_information.tiers.length !== index+1 ? 'mb-3' : ''">
                                <button class="btn bg-seven rounded-pill c-black font-weigh-bold " v-if="$root.current_plan === tier.id" @click="$root.redirectAccountSettings()">Your Current Plan</button>
                                <button type="button" class="btn rounded-pill font-weight-bold bg-fifth text-white text-center" @click="showModalSupport" v-else>{{currency}}{{tier.amount}}</button>
                            </div>
                            <div class="divider" v-if="user.channel_information.tiers.length !== index+1" ></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 d-lg-none">
                <div class="navigation-header__select-subsection">
                    <a :href="`/${user.username}/Channel/Activity`" class="active">Activity</a>
                    <!-- <a :href="`/${user.username}/Channel/Playlist`" class="text-white font-weight-bold">Playlist</a> -->
                </div>
            </div>
            <div :class="`pr-lg-0 col-12 ${user.subscription_type ==='CONTRIBUTOR'? 'col-lg-8': 'col-lg-12'}`" >
                <div class="navigation-body__content-post">
                    <div class="m-3">
                        <div v-for="(post, index) in user.posts" :key="post.token">
                            <post :post="post" :index="index" :user="user" :key="post.token" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import ModalLogin from "../../../../Auth/Components/Login";
import ModalNewPlaylist from "../Playlist/include/ModalNewPlaylist";
import ModalSharePost from "../../../../Posts/Components/ModalSharePost";
import Auth from "../../../../../helpers/Auth";

export default {
    props:['user'],
    data(){
        return {
            is_activity_panel: true,
        }
    },
    components:{
        ModalLogin,
        ModalNewPlaylist,
        ModalSharePost,
    },
    mounted() {
        Auth.initialize()
    },
    computed:{
        currency(){
            if(Auth.state.username){
                let object_currency = typeof this.user.payment_ip_data.currency === 'string'
                    ? JSON.parse(this.user.payment_ip_data.currency)
                    : this.user.payment_ip_data.currency
                return object_currency.symbol_native
            }else{
                return ''
            }
        }
    },
    methods:{
        showModalSupport(){
            $('#modalSupport').modal('show')
        },
    }
}
</script>
