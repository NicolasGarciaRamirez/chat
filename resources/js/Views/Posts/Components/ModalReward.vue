<template>
    <div class="modal fade modal-reward" tabindex="-1" role="dialog" aria-labelledby="ModalReward" aria-hidden="true" id="modalReward">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content modal-border-white" v-if="post.user">
                <div class="modal-header border-0 d-flex align-items-center p-0 mb-1">
                    <img :src="`${post.user.cover}`" class="img-fluid support-brand-header">
                    <div class="head-content d-flex align-items-center ml-2">
                        <img :src="`${post.user.avatar}`" alt="" class="support-img-profile rounded-circle mt-3">
                        <div class="d-flex flex-column p-2">
                            <a :href="`/${post.user.username}/Channel/Activity`" class="text-white text-decoration-none font-weight-bold user-name">
                                {{post.user.artistic_name }}
                                <img src="/images/icons/check.svg" alt="" class="check-icon mx-2" v-if="post.user.verification_date">
                                <svg class="icon-check" style="transform: translateY(-2px)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" v-if="post.user.badge_verification"> <path fill="#FFC34D" d="M4,11.5l1-4.8C5,6.2,5.7,6,6.1,6.5l2.8,3.8c0.4,0.6-0.1,0.7-2,3C4.5,12,3.8,12.3,4,11.5L4,11.5z"/> <path fill="#FFC34D" d="M17.1,13.2c-1.9-2.2-2.5-2.4-2-3l2.8-3.8c0.3-0.4,1-0.3,1.1,0.3l1,4.8C20.2,12.3,19.4,12.1,17.1,13.2z"/> <path fill="#FFEA80" d="M22,8.9l-4.6,3.4l-4.8-8.4c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-4.8,8.4L2,8.9 C1.5,8.5,0.9,9,1,9.6l1.8,6.9l1.2,0.7l-0.8,0.6l0.5,2.1c0.1,0.3,0.3,0.5,0.6,0.5h15.5c0.3,0,0.6-0.2,0.6-0.5l0.5-2.1l-0.5-0.6 l0.8-0.6L23,9.6C23.1,9,22.5,8.5,22,8.9L22,8.9z"/> <path fill="#FFEA80" d="M23,9.6l-1.8,6.9l-0.8,0.6l0.5,0.6l-0.5,2.1c-0.1,0.3-0.3,0.5-0.6,0.5H12V3.6c0.2,0,0.4,0.1,0.6,0.3 l4.8,8.4L22,8.9C22.5,8.5,23.1,9,23,9.6L23,9.6z"/> <path fill="#FF6A4D" d="M14.5,13.6l-1.9-3.2c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-1.9,3.2c-0.1,0.2-0.1,0.5,0,0.7 l1.9,3.2c0.1,0.2,0.3,0.3,0.6,0.3c0.2,0,0.4-0.1,0.6-0.3l1.9-3.2C14.6,14.1,14.6,13.8,14.5,13.6z"/> <path fill="#FF6A4D" d="M14.5,14.3l-1.9,3.2c-0.1,0.2-0.3,0.3-0.6,0.3v-7.7c0.2,0,0.4,0.1,0.6,0.3l1.9,3.2 C14.6,13.8,14.6,14.1,14.5,14.3z"/> <path fill="#FFC34D" d="M7.5,17.2c0,0.4-0.3,0.6-0.6,0.6H3.1l-0.3-1.3h4.1C7.2,16.5,7.5,16.8,7.5,17.2z"/> <path fill="#FFC34D" d="M21.2,16.5l-0.3,1.3h-3.7c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H21.2z"/> </svg>
                            </a>
                            <div class="d-flex flex-row justify-content-start align-items-center user-type">
                                <span class="title-tag">{{post.user.profile_information && post.user.profile_information.title ? post.user.profile_information.title : 'title profile not choseen'}}</span>
                                <span class="contributor-tag" v-if="post.user.subscription_type === 'CONTRIBUTOR'">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red" class="contributor-icon"></span>
                            </div>
                        </div>
                    </div>
                    <div style="transform: translateY(-4rem);">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body pt-2">
                    <div  class="summary">
                        <sumary :currency="currency" :summary="summary" :post="post" :type_contribution="'reward'" :view_summary="view_summary" :user="user" ref="summary"></sumary>
                    </div>
                    <div class="d-flex flex-column text-center align-items-center" v-if="!view_summary">
                        <h4 class="font-weigh-bold my-2">Reward A One-off Donation</h4>
                        <p class="mb-3">
                            By entering an amount below, you will directly reward  <span class="font-weight-bold">{{post.user.artistic_name}}</span>  Financially
                            with a one-off donation. This amount is for this single time only and it doesn’t auto-renew.
<!--                            Noisesharks DOES NOT take any cut from this support.-->
                        </p>
                        <div class="d-flex flex-column w-100" v-if="post.user.channel_information">
                            <div class="divider" v-if="post.user.channel_information.why_support"></div>
                            <div class="d-flex text-center flex-column" v-if="post.user.channel_information.why_support">
                                <h4 class="font-weigh-bold mb-3">Why Support Channel?</h4>
                                <p>{{post.user.channel_information ? post.user.channel_information.why_support : ''}}</p>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <h4 class="font-weigh-bold">Enter Desired One-off Reward Amount </h4>
                        <div class="mb-3 input-reward" id="input-reward">
                            <input id="amount" type="number" class="my-2 mx-auto" placeholder="0.00" autocomplete="off" v-model="summary.amount"/>
                        </div>
                        <div class="text-center mb-3 w-100">
                            <button type="button" class="btn bg-fifth rounded-pill text-white shadow-red" @click="initializeSummary()" :disabled="summary.amount <= 0">CONTINUE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Sumary from "../../Payments/Components/Summary";
import Payment from "../../../helpers/Payment";
import StripeKeys from "../../../helpers/StripeKeys";
import Auth from "../../../helpers/Auth";
import Location from '../../../helpers/Location';
export default {
    props:['user','post'],
    components:{Sumary},
    data(){
        return {
            view_summary: false,
            summary:{
                tier:'',
                amount:'',
                description:'',
            }
        }
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
    mounted(){
        let self = this.$parent
        let _self = this
        let modalReward = $("#modalReward")
        modalReward.on('show.bs.modal', function () {
            Location.getIp(_self.user, self.$refs)
        })
        modalReward.on('hidden.bs.modal', function () {
            self.$refs.rewardModal.$refs.summary.reset()
            self.$refs.rewardModal.view_summary = false
            self.$refs.rewardModal.summary = {
                tier:'',
                amount:'',
                description:''
            }
        });
    },
    methods:{
        convertDecimal(){
            this.summary.amount = parseFloat(this.summary.amount).toFixed(2)
        },
        initializeSummary(){
            if(Auth.state.username){
                if(Auth.state.username !== this.post.user.username){
                    this.view_summary = true
                    $('.modal-body').animate({
                        scrollTop: $(".modal-body").offset().top
                    },1);
                }else{
                    swal('Error', 'You can\'t support yourself!', 'error')
                }
            }else{
                $('#modalReward').modal('toggle')
                $('#ModalLogin').modal('show');
            }

        },
        getCurrencyClass(currency){
            if(currency.symbol === '£'){
                $('#input-reward').addClass('input-reward-pounds').removeClass('input-reward')
            }else if(currency.symbol === '€'){
                $('#input-reward').addClass('input-reward-eur').removeClass('input-reward')
            }
        }
    }
}
</script>


