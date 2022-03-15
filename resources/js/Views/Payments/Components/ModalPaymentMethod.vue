<template>
    <div class="modal fade modal-login" role="dialog" id="ModalPaymentMethod">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-body">
                    <div class="d-flex flex-column m-sm-auto">
                        <h4 class="font-weight-bold text-center my-2">Billing Information</h4>
                        <div class="m-auto c-fifth">
                            <div class="d-flex flex-row justify-content-start my-2">
                                <input type="text" placeholder="First Name" class="form-control mr-2" v-model="biling_information.first_name"/>
                                <input type="text" placeholder="Last Name" class="form-control" v-model="biling_information.last_name"/>
                            </div>
                            <div class="d-flex flex-row justify-content-start my-2">
                                <input type="text" placeholder="First Line of Address" class="form-control  mr-2" v-model="biling_information.address"/>
                                <input type="text" placeholder="Country" class="form-control" v-model="biling_information.country"/>
                            </div>
                            <div class="d-flex flex-row justify-content-start my-2">
                                <input type="text" placeholder="City" class="form-control" v-model="biling_information.city"/>
                                <input type="text" placeholder="State/Province" class="form-control mx-2" v-model="biling_information.state"/>
                                <input type="text" placeholder="Postal/Zip Code" class="form-control" v-model="biling_information.zip_code"/>
                            </div>
                        </div>
                        <div class="divider my-2"></div>
                        <div class="m-auto">
                            <h4 class="font-weight-bold text-center my-2">Credit Card Information</h4>
                        </div>
                        <div class="d-flex flex-column m-auto">
                            <form @submit.prevent="createPaymentToken()" id="payment-form" class="my-2">
                                <input id="name_card" type="text" placeholder="Name on Bank Account" class="form-control my-2" v-model="name_card" onkeyup="disabled = false" required/>
                                <div id="card-element" :class="type_action === 'update' ? 'd-none' :'form-control border-0 pt-2 my-2'"></div>
                                <div :class="type_action !== 'update'? 'd-none': 'd-flex'">
                                    <div class="flex-grow-1">
                                        <input type="text" class="form-control bg-third c-fourth my-auto" :value="`**** `+payment_method.card.last4" disabled>
                                    </div>
                                    <div class="flex-fill">
                                        <div id="card-expiry" class="form-control border-0 pt-2 my-auto" style="border-radius: 0px !important;width: 136%; position: relative; left: -15px;"></div>
                                    </div>
                                    <div class="flex-fill">
                                        <div id="card-cvc" class="form-control border-0 pt-2 my-auto"></div>
                                    </div>
                                </div>
                                <div id="card-errors" role="alert" class="c-fifth font-weight-bold">{{error}}</div>
                                <div class="d-flex flex-column text-center my-2 mx-auto">
                                    <button type="submit" class="btn text-white font-weight-bold bg-fifth rounded-pill" v-if="!loading" :disabled="disabled">{{'Add Card'}}</button>
                                    <button class="btn rounded-pill text-white bg-fifth" v-if="loading" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>
                            <p class="my-2 c-fourth text-center text-size-sm">
                                By creating a profile and signing up you are accepting Noisesharks'.... <a href="/docs/Terms%20and%20Conditions.pdf"  target="_blank" class="c-fourth"><b>Terms of Use</b></a>, <a href="/docs/Privacy%20and%20Cookies%20Policy.pdf" target="_blank" class="c-fourth"><b>Privacy Policy</b></a> , <a href="/docs/User%20Policy.pdf" target="_blank" class="c-fourth"><b>User Policy</b></a> ,& <a href="/docs/Copyright%20Policy%20and%20Notice%20and%20Take%20Down%20Policy%20and%20Procedure.pdf" target="_blank" class="c-fourth"><b>Copyright Policy</b></a>
                            </p>
                            <p class="my-2 d-flex justify-content-center c-fourth text-center text-size-sm">
                                By signing up, creating your profile, and checking out you are also agreeing that you must create a stripe connect account in order for you to receive payments from your supporters. we will direct you to the correct link.
                            </p>
                            <p class="d-flex justify-content-center c-fourth text-center my-2 text-size-sm">
                                Noisesharks® does not issue refunds on behalf of contributors.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Payment from "../../../helpers/Payment";
    import StripeKeys from "../../../helpers/StripeKeys";
    import Auth from "../../../helpers/Auth";

    export default {
        name: "ModalPaymentMethod",
        data(){
            return {
                disabled: true,
                vta: 0,
                gateway: 0,
                total: 0,
                currency: '',
                biling_information_errors: null,
                error: null,
                loading: false,
                card: null,
                card_number: '',
                card_expiry: '',
                card_cvc: '',
                name_card:'',
                payment_method: {card:''},
                client_secret: null,
                token: null,
                auth: null,
                data_location: '',
                stripe: Stripe(StripeKeys.data_keys.STRIPE_KEY),
                type_action: ''
            }
        },
        mounted() {
            this.getLocation()
            this.initialize()
            let self = this
            let card_element = $('#name_card')
            if(this.type_action === 'save'){
                card_element.on('change', function (event){
                    if(event.currentTarget.value !== '' || event.currentTarget.value !== null ){self.disabled = false}
                    if(self.card !== null && self.name_card !== ''){self.disabled = false}
                })
                this.card.on('change', function (event) {
                    if (event.error) {
                        self.error = event.error.message
                        if(!event.complete) self.disabled = true
                    }else{
                        if(self.name_card !== ''){
                            if(event.complete) self.disabled = false
                        }
                    }
                    self.error = null
                })
            }else{
                card_element.on('change', function (event){
                    if(event.currentTarget.value !== '' || event.currentTarget.value !== null ){self.disabled = false}
                    if(self.card_expiry !== null && self.name_card !== '' && self.card_cvc){self.disabled = false}
                })
                this.card_expiry.on('change', function(event){
                    event.error ? self.error = event.error : self.disabled = false
                })
                this.card_expiry.on('ready', function(event){
                    event.error ? swal('Error',event.error, 'Error') : self.card_cvc.focus()
                })
                this.card_cvc.on('change', function(event){
                    event.error ? self.error = event.error : self.disabled = false
                })
            }
        },
        computed:{
            biling_information(){
                return {
                    id: null,
                    first_name: this.$parent.user.personal_information.first_name,
                    last_name: this.$parent.user.personal_information.last_name,
                    address: '',
                    country: this.data_location.country_name,
                    city: this.data_location.city,
                    state: this.data_location.region_name,
                    zip_code: this.data_location.zip,
                    payment_method_id:null
                }
            }
        },
        methods:{
            initialize(){
                let elements = this.stripe.elements()
                if(this.type_action === 'save'){
                    this.card = elements.create("card", { style: Payment.data.style, hidePostalCode: true });
                    this.card.mount('#card-element')
                }else{
                    this.card_expiry = elements.create("cardExpiry", {style: Payment.data.style});
                    this.card_expiry.mount('#card-expiry')

                    this.card_cvc = elements.create("cardCvc", {style: Payment.data.style,});
                    this.card_cvc.mount('#card-cvc')
                }
            },
            getLocation(){
                let self = this
                if(!this.$parent.user.payment_ip_data){
                    $.getJSON('https://api.ipstack.com/check?access_key='+StripeKeys.data_keys.CLIENT_IP_STACK_LOCATION, function (res){
                        self.data_location = res
                    })
                }else{
                    this.data_location = this.$parent.user.payment_ip_data
                }
                
            },
            createPaymentToken(){
                let data = {
                    name: this.biling_information.first_name+' '+this.biling_information.last_name,
                    address_line1: this.biling_information.address,
                    address_city: this.biling_information.city,
                    address_state: this.biling_information.state,
                    address_zip: this.biling_information.zip_code,
                    address_country: this.data_location.country_code,
                }
                let card = {
                    cardExpiry: this.card_expiry,
                    cardCvc: this.card_cvc
                }
                this.stripe.createToken(`${this.type_action === 'update' ? card : this.card}` , data).then(res => {
                    if(res.error){
                        swal('Error','An error occurred while trying to save this payment method. Try it again later.','error')
                    }else{
                        this.create(res.token.id)
                    }
                });
            },
            async create(token){
                await this.stripe.createPaymentMethod({
                    type: 'card',
                    card: {
                        token: token
                    }
                }).then(res =>{
                    if(res.error){
                        swal('Error','An error occurred while trying to save this payment method. Try it again later.','error')
                    }else{
                        this.payment_method = res.paymentMethod
                        this.payment_method.token = token
                        this.saveOrUpdate('save')
                    }
                }).catch(err =>{console.log(err)})
            },
            async saveOrUpdate(type){
                await Auth.setSession()
                let data = {
                    payment_method: this.payment_method,
                    biling_information: this.biling_information
                }
                await axios.post(`/User/${type}/paymentMethods/${Auth.state.username}`, data).then(res =>{
                    if(res.data.saved){
                        this.$toasted.show('New Card Added Successfully!', {
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
                        if(this.type_action === 'save'){
                            this.card.clear()
                            this.$parent.payment_methods.push(res.data.paymentMethod)
                        }else{
                            this.card_expiry.clear()
                            this.card_cvc.clear()
                        }

                        $('#ModalPaymentMethod').modal('hide')

                    }else{
                        swal('Error','error','error')
                    }
                }).catch(err=>{Auth.keepLogged(err.response.status)})
            },

        }
    }
</script>
