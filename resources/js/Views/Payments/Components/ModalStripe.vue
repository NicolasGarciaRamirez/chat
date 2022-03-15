<template>
    <section>
        <div class="modal fade modal-payment" data-backdrop="static" role="dialog" id="ModalStripe">
            <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
                <div class="modal-content modal-border-white">
                    <div class="modal-body p-3">
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        <div class="d-flex flex-column align-items-center justify-content-center tex-center" v-if="state === 'account_connect_initial'">
                            <slot-content-interact-payment ref="slotContentInteractPayment" :invitate="invitate"></slot-content-interact-payment>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center text-center" v-if="state === 'account_connect_success'">
                            <div>
                                <h4 class="font-weight-bold c-seven">STRIPE ACCOUNT CONNECTED!</h4>
                            </div>
                            <div>
                                <h6 class="d-flex text-white font-weight-bold my-4">
                                    Your Stripe and Noisesharks accounts are now linked
                                </h6>
                            </div>
                            <div class="d-flex flex-row w-100">
                                <div class="d-flex flex-column p-2">
                                    <svg version="1.1" baseProfile="tiny" id="svg_one" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         x="0px" y="0px" viewBox="0 0 1075 1080" xml:space="preserve" class="payment-time-success" width="2.3rem">
                                        <g class="d-flex align-items-center">
                                            <circle cx="536.45" cy="537.24" r="487.55"></circle>
                                            <g>
                                                <polygon fill="#00FF00" points="798.62,354.05 479.36,673.29 312.24,506.13 285.9,532.47 479.36,725.95 824.96,380.37"/>
                                            </g>
                                        </g>
                                    </svg>
                                    <svg version="1.1" baseProfile="tiny" id="svg_line" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         x="0px" y="0px" viewBox="0 0 61 1080" xml:space="preserve" height="1.8rem" class="payment-time-success">
                                        <g>
                                            <line style="stroke-width: 160px" x1="25.45" y1="1088.5" x2="29.45" y2="2.81"></line>
                                        </g>
                                    </svg>
                                    <svg version="1.1" baseProfile="tiny" id="svg_two" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         x="0px" y="0px" viewBox="0 0 1075 1080" xml:space="preserve" width="2.3rem" class="payment-time-success">
                                        <g>
                                            <circle  cx="536.45" cy="537.24" r="487.55"></circle>
                                            <g>
                                                <polygon fill="#00FF00" points="798.62,354.05 479.36,673.29 312.24,506.13 285.9,532.47 479.36,725.95 824.96,380.37"/>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="d-flex flex-column align-items-start p-2">
                                    <span class="c-seven mb-4 mt-2">
                                        Create your stripe account.
                                    </span>
                                    <span class="c-seven mb-3 mt-3">
                                        Link your Stripe and Noisesharks accounts together.
                                    </span>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="d-flex flex-column justify-content-start text-left">
                                <span class="my-1">
                                    You have now unlocked all of the following:
                                </span>
                                <span class="my-1">1- The <b class="font-weight-bold">CONTRIBUTOR</b> badge. This will be displayed in your profile and on your content.</span>
                                <span>2- The <b class="font-weight-bold">Reward</b> button: Users can send you one off donations using this button, it will be displayed
                                    in your profile and on your content.</span>
                                <span class="my-1">3- The <b class="font-weight-bold">Support</b> button: Users can start supporting you on a monthly bases using this button,
                                    it will be displayed in your profile and on your content.</span>
                                <span>4- <b class="font-weight-bold">Tiers</b> system: You can set different tiers at different prices for your supporters to choose from.
                                    These tiers will be special promises that you will give to your supporters depending on their
                                    selection.</span>
                                <span class="my-1">5- You can also lock your content and make it execlusive only for your supporters.</span>
                                <span>6- You are now able to set a <b class="font-weight-bold">Monthly Earnings Goal</b> so that users can see where you’re at
                                    and help you achieve it.</span>
                                <div class="text-center my-1">
                                    <button type="button" class="btn btn-red rounded-pill" @click="goIt()">Got It!</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center text-center" v-if="state === 'account_connect_error'">
                            <h4 class="font-weight-bold text-danger">Connect Stripe Accounts Error</h4>
                            <div class="d-flex flex-column justify-content-center w-50">
                                <form @submit.prevent="connectAccounts">
                                    <span class="c-six mb-3">Trial ({{count}}) - Stripe ID invalid! Please try again or contact our <a href="/Help" class="c-six">Help</a> team!</span>
                                    <button type="submit" class="btn btn-red rounded-pill">Trying Connect Accounts</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import StripeKeys from "../../../helpers/StripeKeys";
    import SlotContentInteractPayment from './SlotContentInteractPayment'
    export default {
        name: "ModalStripe",
        components: {SlotContentInteractPayment},
        props:['state'],
        data(){
            return {
                stripe_id: '',
                count: 0,
                client_id: StripeKeys.data_keys.STRIPE_CLIENT_ID,
                invitate: false
            }
        },
        mounted(){
            Auth.initialize()
            this.auth = Auth.state
        },
        methods:{
            async connectAccounts(){
                await Auth.setSession()
                if(!Auth.state.username){
                    await this.$parent.setHelperAuth()
                }
                window.location.replace('https://connect.stripe.com/express/oauth/authorize?response_type=code&client_id='+this.client_id+'&scope=read_write');
            },
            async goIt(){
                await Auth.setSession()
                window.location.replace(`/${Auth.state.username}/Channel/Edit`)
            }
        }
    }
</script>
