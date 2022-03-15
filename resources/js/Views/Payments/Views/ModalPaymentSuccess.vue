<template>
    <section>
        <div class="modal fade modal-contributor-form" role="dialog" id="ModalPaymentSuccess">
            <div class="modal-dialog modal-dialog-centered  modal-md" role="document"  style="max-width: 587px">
                <div class="modal-content modal-border-white modal-payment">
                    <div class="modal-body p-1">
                        <slot-content-interact-payment></slot-content-interact-payment>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import StripeKeys from "../../../helpers/StripeKeys";
    import SlotContentInteractPayment from '../Components/SlotContentInteractPayment'

    export default {
        name: "ModalPaymentSuccess",
        components: {SlotContentInteractPayment},
        data(){
            return{
                client_id: StripeKeys.data_keys.STRIPE_CLIENT_ID
            }
        },
        methods:{
            async connectAccounts(){
                if(!Auth.state.username){
                    await this.$parent.setHelperAuth()
                    window.location.replace('https://connect.stripe.com/oauth/authorize?response_type=code&client_id='+this.client_id+'&scope=read_write');
                }
            },
        }
    }
</script>
