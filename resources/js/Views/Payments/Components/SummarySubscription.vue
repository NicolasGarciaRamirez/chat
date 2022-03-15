<template>
    <section>
        <div class="d-flex flex-column justify-content-center p-3" >
            <div class="text-center">
                <h3 class="font-weight-bold">Summary</h3>
            </div>
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-between my-2">
                    <span>Joining Fee (Exc. VAT):</span>
                    <span> {{currency}} {{summary.amount }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between">
                    <span>VAT (Depends on your country’s laws)</span>
<!--                    <span> {{currency}} {{vta}}</span>-->
                </div>
                <div class="d-flex flex-row justify-content-between my-3">
                    <h5 class="font-weight-bold m-0">Total</h5>
                    <h5 class="font-weight-bold m-0"> {{currency}} {{total}}</h5>
                </div>
                <div class="divider"></div>
                <div class="d-flex flex-column">
                    <h4 class="font-weight-bold text-center mb-3">Billing Information</h4>
                    <div class="m-auto c-fifth">
                        <div class="d-flex flex-row justify-content-start mb-2">
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
                            <input type="text" placeholder="Postal/Zip Code" class="form-control" v-model="biling_information.zip_code"/><span class="c-fifth">*</span>
                        </div>
                    </div>
                    <div class="divider my-2"></div>
                    <div class="m-auto">
                        <h4 class="font-weight-bold text-center my-2">Credit Card Information</h4>
                    </div>
                    <div class="d-flex flex-column m-auto">
                        <form @submit.prevent="submit()" id="payment-form" class="my-2">
                            <input id="name_card" type="text" placeholder="Name on Bank Account" class="form-control my-2" v-model="name_card" v-validate="'required'" required/>
                            <span class="c-fifth">{{ errors.first('card_name') }}</span>
                            <div id="card-element" class="form-control border-0 pt-2 my-2"></div>
                            <div id="card-errors" role="alert" class="c-fifth font-weight-bold">{{error}}</div>
                            <div class="d-flex flex-column text-center my-2">
                                <button type="submit" class="btn text-white font-weight-bold bg-fifth rounded-pill" v-if="!loading" :disabled="disabled">{{'CHECKOUT'}}</button>
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
    </section>
</template>
<script>
    import Auth from "../../../helpers/Auth";
    import ModalPaymentSuccess from "../Views/ModalPaymentSuccess";
    import Payment from "../../../helpers/Payment";
    import StripeKeys from "../../../helpers/StripeKeys";
    import {Validator} from "vee-validate";
    import Location from "../../../helpers/Location";

    const dictionary = {
        en: {
            attributes: {
                card_name: 'Card Name',
            }
        }
    };
    Validator.localize(dictionary);
    export default {
        components: {ModalPaymentSuccess},
        props:['user', 'type', 'summary'],
        data(){
            return{
                disabled: true,
                vta: 0,
                gateway: 0,
                total: 0,
                currency: '',
                biling_information_errors: null,
                error: null,
                loading: false,
                card: null,
                name_card:'',
                payment_method: {
                    token: ''
                },
                client_secret: null,
                token: null,
                auth: null,
                data_location: ''
            }
        },
        computed:{
            biling_information(){
                return {
                    id: null,
                    first_name: this.$parent.$parent.user ? this.$parent.$parent.user.first_name : '',
                    last_name: this.$parent.$parent.user ? this.$parent.$parent.user.last_name : '',
                    address: '',
                    country: this.data_location.country_name,
                    city: this.data_location.city,
                    state: this.data_location.region_name,
                    zip_code: this.data_location.zip,
                    payment_method_id: null
                }
            },

        },
        mounted() {

            Auth.initialize()
            this.auth = Auth.state
            Payment.initialize()
            Location.initialize()

            let self = this
            let card_element = $('#name_card')
            card_element.on('change', function (event){
                if(event.currentTarget.value !== '' || event.currentTarget.value !== null ){self.disabled = false}
                if(self.card !== null && self.name_card !== ''){self.disabled = false}
            })

            Payment.data.card.on('change', function (event) {
                if (event.error) {
                    self.error = event.error.message
                    if(!event.complete){
                        self.disabled = true
                    }
                }else{
                    if(self.name_card !== ''){
                        if(event.complete){
                            self.disabled = false
                        }else{
                            self.disabled = true
                        }
                    }
                    self.error = null
                }
            })
            if(Location.data.location !== null){
                Location.data.location = JSON.parse(Location.data.location)
                self.data_location = Location.data.location
                self.currency      = Location.data.location.currency.symbol_native
                self.vta           = Location.data.location.continent_code === 'EU' ? parseFloat(((parseInt(self.summary.amount) * 20)/100)).toFixed(2) : 0
                Payment.initializePaymentData(self.summary, self.vta)
                self.total         = parseFloat(parseInt(self.summary.amount) + parseInt(self.vta)).toFixed(2)
                self.$parent.$parent.user.payment_ip_data = Location.data.location
                this.gateway = Payment.data.payment_values.gateway
            }else{
                this.getVta()
            }
        },
        methods:{
            getVta(){
                if(!this.data_location){
                    let self = this
                    $.getJSON('https://api.ipstack.com/check?access_key='+StripeKeys.data_keys.CLIENT_IP_STACK_LOCATION, function (res){
                        self.data_location = res
                        self.currency      = res.currency.symbol_native
                        self.vta           = res.continent_code === 'EU' ? parseFloat(((parseInt(self.summary.amount) * 20)/100)).toFixed(2) : 0
                        Payment.initializePaymentData(self.summary, self.vta)
                        self.total         = parseFloat(parseInt(self.summary.amount) + parseInt(self.vta)).toFixed(2)
                        self.$parent.$parent.user.payment_ip_data = res
                        Location.set(res, res.currency.symbol_native)

                    })
                    this.gateway = Payment.data.payment_values.gateway
                }
            },
            async switchMode(data){
                let url = ''
                if(window.location.href === `http://localhost:8000/User/Settings/${this.user.username}` || window.location.href === `https://www.noisesharks.com/User/Settings/${this.user.username}`){
                    url = `/User/Settings/Update/Subscription/${this.user.username}/${this.user.contributor_type === 'PERCENTAGE' ? 'SUBSCRIPTION' : 'PERCENTAGE'}`
                }else{
                    url = `/User/Settings/Update/Subscription/${this.user.username}/${this.type === 'Percentage' ? 'PERCENTAGE' : 'SUBSCRIPTION'}`
                }
                await axios.post(url).then(res =>{
                    if(res.data.updated){
                        if (window.location.href === `http://localhost:8000/User/Settings/${this.user.username}` || window.location.href === `https://www.noisesharks.com/User/Settings/${this.user.username}`){
                            this.$parent.summary_subscription = false
                            this.$root.$refs.AccountSettings.user = res.data.user
                        }
                        $('.swal-footer').addClass('text-center')
                        if(window.location.href === `http://localhost:8000/Register/Contributor/Percentage` || window.location.href === `http://localhost:8000/Register/Contributor/Subscription` || window.location.href === `https://www.noisesharks.com/Register/Contributor/Subscription` || window.location.href === `https://www.noisesharks.com/Register/Contributor/Percentage`){
                            window.location.replace(`/User/Settings/${this.user.username}`)
                        }
                    }
                }).catch(err=>{Auth.keepLogged(err.response.status)})
            },
            async submit(){
                if(this.biling_information.zip_code){
                    this.loading = true
                    await this.createTokenPayment()
                    await this.createPaymentMethod()
                }else{
                    swal('Error', 'fill in the field marked with (*)', 'error')
                }
            },
            async createPaymentMethod(){
                Payment.data.stripe.createPaymentMethod({
                    type: 'card',
                    card: Payment.data.card,
                    billing_details: {
                        name: this.name_card,
                        address: {
                            city: this.data_location.city,
                            state:  this.data_location.region_name
                        }
                    },
                }).then(res =>{
                    if(res.paymentMethod){
                        this.payment_method = res.paymentMethod
                        this.checkPaymentMethod()
                    }else{
                        swal({
                            icon:"error",
                            text: res.error.message,
                            className: 'swal-alert',
                            buttons: [false,'Ok'],
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                        this.loading = false
                    }
                }).catch(err =>{console.log(err)});
            },
            async checkPaymentMethod(){
                let url = Auth.state.username ? `/Payment/Intent/Update/Subscription/${this.type}/${Auth.state.username}` : `/Payment/Intent/Subscription/${this.type}`
                let data = {
                    payment_method: this.payment_method
                }
                data.payment_method.token = this.token
                await axios.post(url, data).then(res=>{
                    if(!res.data.error){
                        let data = {
                            client_secret: res.data.client_secret,
                            stripe: Payment.data.stripe,
                            payment_information:{
                                card: Payment.data.card,
                                name_card: this.name_card,
                                biling_information: this.biling_information
                            },
                            payment_method: this.payment_method,
                        }
                        data.payment_method.token = this.token
                        if(window.location.href === `http://localhost:8000/User/Settings/${this.auth.username}` || `https://www.noisesharks.com/User/Settings/${this.auth.username}` && this.auth.username){
                            this.switchMode(data)
                        }else{
                            this.$parent.$parent.save(data)
                        }
                    }else{
                        this.loading = false
                        swal({
                            icon:"error",
                            title:'transaction error!!',
                            text: res.data.error.message,
                            className: 'swal-alert',
                            buttons: [false,'Ok'],
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                    }
                }).catch(err =>{
                    this.loading = false
                    Auth.keepLogged(err.response.status)
                })
            },
            async confirmPayment(data){
                await Payment.data.stripe.confirmCardPayment(data.client_secret , {
                    payment_method:{
                        card: Payment.data.card,
                        billing_details: {
                            name: this.name_card,
                            address: {
                                city:this.data_location.city,
                                state: this.data_location.state
                            }
                        }
                    }
                }).then(res =>{
                    if(res.error){
                        this.loading = false
                        swal({
                            text: res.error.message,
                            className: 'swal-alert',
                            buttons: [false,'Ok'],
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                    }else{
                        if(res.paymentIntent.status === 'succeeded'){
                            swal({
                                title: 'Success',
                                text: 'Payment Successfull',
                                icon: 'success',
                                className:'swal-alert',
                                buttons: [false,'Ok'],
                                dangerMode: true,
                            })
                            $('.swal-footer').addClass('text-center')
                            setTimeout(`${this.switchMode()}`, 200)
                            this.loading = false
                        }
                    }
                })
            },
            async createTokenPayment(){
                let data = {
                    name: this.biling_information.first_name+' '+this.biling_information.last_name,
                    address_line1: this.biling_information.address,
                    address_city: this.biling_information.city,
                    address_state: this.biling_information.state,
                    address_zip: this.biling_information.zip_code,
                    address_country: this.biling_information.country,
                }
                await Payment.data.stripe.createToken(Payment.data.card, data).then(res => {
                    if(res.error){
                        swal('Error','An error occurred while trying to save this payment method. Try it again later.','error')
                    }else if(res){
                        this.token = res.token.id
                    }
                });
            }
        }
    }
</script>
