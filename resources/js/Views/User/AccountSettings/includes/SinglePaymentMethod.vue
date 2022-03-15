<template>
    <div class="d-flex flex-column justify-content-start align-items-start">
        <div class="d-flex flex-row">
            <span class="c-fourth">- Card:&nbsp;</span> {{payment_data.card.brand}} ****{{payment_data.card.last4}}
            <small class="p-1 mx-2  rounded-pill c-third font-weight-bold cursor-pointer" style="background: #ffff00; font-size: 0.2rem" data-toggle="tooltip" data-placement="top" title="It is used at the time of subscriptions or invoices. You can always override this default" v-if="payment_default">DEFAULT</small>
        </div>
        <div>
            <span class="c-fourth">&nbsp;&nbsp;&nbsp;Expiry:</span> {{payment_data.card.exp_month}}/{{payment_data.card.exp_year}}
        </div>
        <div>
            <span class="c-fourth">&nbsp;&nbsp;&nbsp;illing Address Postal/Zip Code:</span>{{payment_data.billing_details.address.postal_code}}
        </div>
        <div>
            <span class="c-fourth">&nbsp;&nbsp;&nbsp;Activity:</span>--
        </div>
        <div class="d-flex justify-content-start my-3">
            <div>
                <button type="button" class="btn rounded-pill border-white font-weight-bold text-white action" @click="update()">Edit Card</button>
            </div>
            <div class="mx-3">
                <button type="button" class="btn rounded-pill border-white font-weight-bold text-white action" @click="drop()">Remove Card</button>
            </div>
            <div>
                <button type="button" class="btn rounded-pill border-white font-weight-bold text-white action" @click="manageActivity()">Manage Activity</button>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from "../../../../helpers/Auth";
    import ModalActivityPayment from "../Components/ModalActivityPayment";

    export default {
        name: "SinglePaymentMethod",
        props:['payment', 'index'],
        data(){
            return {
                payment_default: false,
                payment_data: {
                    billing_details:{
                        address:{}
                    },
                    card:{}
                }
            }
        },
        mounted(){
            Auth.initialize()
            this.get()
        },
        created() {
            this.get()
        },
        methods:{
            async get(){
                let data = { payment_method: this.payment.card_id }
                await axios.post(`/User/get/paymentMethods/${Auth.state.username}`, data).then(res =>{
                    this.payment_data = res.data.payment_method
                    this.payment_default = res.data.payment_method_default
                }).catch(err=>{Auth.keepLogged(err.response.status)})
            },
            async update(){
                this.$parent.$refs.ModalPaymentMethod.type_action = 'update'
                this.$parent.$refs.ModalPaymentMethod.payment_method = this.payment_data
                await this.$parent.$refs.ModalPaymentMethod.initialize()
                $('#ModalPaymentMethod').modal('show')
            },
            async drop(){
                swal({
                    title: `Remove Card?`,
                    text: `You are about to remove the card ***${this.payment_data.card.last4}.
                           This card is not in use, to remove it click Confirm Removal below`,
                    className: 'swal-alert',
                    buttons: ['Cancel','Confirm Removal'],
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete){
                        axios.post(`/User/delete/paymentMethods/${Auth.state.username}/${this.payment.id}`).then(res => {
                            if(res.data.deleted){
                                let self = this
                                let index = _.findIndex(this.$parent.payment_methods, function(o) { return o.id === self.payment.id; });
                                this.$parent.payment_methods.splice(index, 1)
                                swal({
                                    title: 'Card Removed Successfully!',
                                    text: 'You have successfully erased the details of the card ***'+this.payment_data.card.last4+'!',
                                    className: 'swal-alert',
                                    buttons:[false,'Got it!'],
                                    danger:true
                                })
                                this.$toasted.show('Card Removed Successfully!', {
                                    position: "bottom-right",
                                    duration : 4000,
                                    className: "notification",
                                    keepOnHover: true,
                                    action: {
                                        text:'x',
                                        onClick:(e, toast) => {
                                            toast.goAway(0);
                                        }
                                    }
                                })
                                $('.swal-button').addClass('text-center')
                            }
                        }).catch(err =>{Auth.keepLogged(err.response.status)})
                    }
                })
                $('.swal-text').addClass('text-center')
            },
            async manageActivity(){
                let data = {payment_method: this.payment.card_token}
                await axios.post(`/${Auth.state.username}/Payment/Get/Activity`, data).then(res =>{
                    if(res.data){
                        this.$parent.$refs.ModalActivityPayment.activitys = res.data.payments
                        $('#ModalActivityPayment').modal('show')
                    }
                }).catch(err=>{
                    Auth.keepLogged(err.response.status)
                })
                this.payment.card_id
            }
        }
    }
</script>

