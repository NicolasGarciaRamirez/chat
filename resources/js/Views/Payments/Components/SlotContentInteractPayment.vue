<template>
    <section>
        <div class="primary-section contributor-form ">
            <div class="d-flex flex-column">
                <div class="d-flex flex-column p-1">
                    <h4 class="primary-section--title text-center c-seven" v-if="!invitate">
                        PAYMENT SUCCESSFUL!!
                    </h4>
                    <h5 :class="`${invitate ? 'c-seven' : 'c-white'} font-weight-bold text-center my-3`">
                        CONGRATULATIONS!.. YOU ARE NOW A CONTRIBUTOR!
                    </h5>
                    <span class="text-left mb-3">
                        You must now connect and link your Stripe and Noisesharks accounts together in order
                        to recieve your support earnings!<br>
                        Follow the steps below to connect your Stripe account:
                    </span>
                    <div class="d-flex flex-row mb-3">
                        <div class="primary-section__status">
                            <div class="number">
                                <h1>1</h1>
                                <svg class="p-2" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.7,4.3c-0.4-0.4-1.1-0.4-1.6,0L7.9,17.4l-5.1-5c-0.4-0.4-1.1-0.4-1.6,0c-0.4,0.4-0.4,1.1,0,1.5l5.8,5.8 c0.4,0.4,1.1,0.4,1.6,0l14-13.8C23.1,5.4,23.1,4.7,22.7,4.3z"/> </svg>
                            </div>
                            <div class="bar">

                            </div>
                            <div class="number">
                                <h1>2</h1>
                                <svg class="p-2" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.7,4.3c-0.4-0.4-1.1-0.4-1.6,0L7.9,17.4l-5.1-5c-0.4-0.4-1.1-0.4-1.6,0c-0.4,0.4-0.4,1.1,0,1.5l5.8,5.8 c0.4,0.4,1.1,0.4,1.6,0l14-13.8C23.1,5.4,23.1,4.7,22.7,4.3z"/> </svg>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center px-3">
                            <span class="text-left" id="text_one">
                                Create your stripe account, then comeback to link it with your
                                Noisesharks account.
                            </span>
                            <div class="d-flex flex-wrap justify-content-between align-items-center py-5" id="buttons">
                                <button type="button" class="button btn bt-sm " @click="addClassSuccessOne" :disabled="success_one"><u>I Have Created A Stripe Account</u></button>
                                <a href="https://dashboard.stripe.com/register" target="_blank" type="button" class="btn btn-sm btn-red rounded-pill mx-2" @click="addClassSuccessOne" :disabled="success_one">Create Stripe Account</a>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="text-left" id="text_two">
                                    Now that you have a Stripe account, click the button below to link it
                                    with your Noisesharks account
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center" id="button-connect">
                        <button type="button" class="btn btn-red rounded-pill" @click="addClassSuccessTwo" :disabled="!success_one">Link Stripe Account</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import StripeKeys from "../../../helpers/StripeKeys";
    import Auth from "../../../helpers/Auth";

    export default {
        name: "SlotContentInteractPayment.vue",
        props:['invitate'],
        data(){
            return{
                success_one: false,
                success_two: false,
                client_id: StripeKeys.data_keys.STRIPE_CLIENT_ID
            }
        },
        updated() {
        },
        methods: {
            addClassSuccessOne() {
                this.success_one = true
                $('#ModalStripe .primary-section').addClass('success-one')
            },
            addClassSuccessTwo() {
                this.success_two = true
                $('#ModalStripe .primary-section').addClass('success-two')
                this.connectAccounts()
            },
            async connectAccounts() {
                if (!Auth.state.username) {
                    await this.$parent.$parent.setHelperAuth()
                    window.open('https://connect.stripe.com/express/oauth/authorize?response_type=code&client_id='+this.client_id+'&scope=read_write', '_blank');
                }else{
                    window.open('https://connect.stripe.com/express/oauth/authorize?response_type=code&client_id='+this.client_id+'&scope=read_write', '_blank');
                }
            },
        }
    }
</script>
