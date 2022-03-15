<template>
    <section >
        <div class="d-flex flex-column">
            <div :class="`d-flex flex-column support-summary`" v-if="type_contribution === 'support' && view_summary">
                <b class="mb-2" v-if="$root.current_plan != ''">
                    Upgrading your support level to the tier {{summary.tier.tier_name}}
                </b>
                <div class="d-flex flex-row justify-content-between cursor-pointer" @click="$parent.view_summary = false">
                    <h5 class="font-weight-bold">Selected Tier:</h5>
                    <span class="text-white">({{currency }}{{summary.tier.tier_name}})</span>
                </div>
                <div class="d-flex flex-row justify-content-between my-2">
                    <h5 class="font-weight-bold">Amount:</h5>
                    <span class="text-white">{{currency}}{{summary.amount}}/month</span>
                </div>
                <h5 class="font-weight-bold">What You Get:</h5>
                <span class="p-2">{{summary.description}}</span>
                <div class="divider my-2" ></div>
            </div>
            <div :class="`d-flex flex-column summary`" v-if="view_summary">
                <h4 class="font-weight-bold m-auto">Summary</h4>
                <div class="d-flex flex-row justify-content-between my-2">
                    <span>Tier Amount:</span>
                    <span id="amount">{{currency}}{{summary.amount}}</span>
                </div>
                <div class="d-flex flex-row justify-content-between" v-if="data_location.continent_code === 'EU'">
                    <span>VAT (Depends on your country’s laws):</span>
                    <span id="vat">{{currency}}{{vat}}</span>
                </div>
                <div class="d-flex flex-row justify-content-between my-3">
                    <h4 class="font-weight-bold">Total:</h4>
                    <h4 class="font-weight-bold" id="total">{{currency}}{{total}}</h4>
                </div>
                <div class="divider my-3"></div>
            </div>
            <div :class="`d-flex flex-column biling-information`" v-if="view_summary">
                <h4 class="font-weight-bold text-center mb-2">Billing Information</h4>
                <div class="m-auto c-fifth">
                    <div class="d-flex flex-row justify-content-start mt-3 mb-2">
                        <input type="text" placeholder="First Name" class="form-control" v-model="biling_information.first_name"/>
                        <input type="text" placeholder="Last Name" class="form-control mx-2" v-model="biling_information.last_name"/>
                    </div>
                    <div class="d-flex flex-row justify-content-start my-2">
                        <input type="text" placeholder="First Line of Address" class="form-control " v-model="biling_information.address"/>
                        <input type="text" placeholder="Country" class="form-control mx-2" v-model="biling_information.country"/>
                    </div>
                    <div class="d-flex flex-row justify-content-start mt-2 mb-3">
                        <input type="text" placeholder="City" class="form-control mr-2" v-model="biling_information.city"/>
                        <input type="text" placeholder="State/Province" class="form-control" v-model="biling_information.state"/>
                        <input type="text" placeholder="Postal/Zip Code" class="form-control mx-2" v-model="biling_information.zip_code"/><span class="c-fifth">*</span>
                    </div>
                </div>
                <div class="divider my-3"></div>
            </div>
            <div :class="`d-flex flex-column credit-card-information`" v-if="view_summary">
                <h4 class="font-weight-bold text-center mb-3">Credit Card Information</h4>
<!--                <div :class="`d-flex flex-column mr-auto ${ index <= 1 ? 'shadow' : ''} cursor-pointer p-3`" v-for="(payment_data, index) in payment_methods" :key="index">-->
<!--                    <div class="d-flex flex-row">-->
<!--                        <span class="c-fourth">Card:</span> {{payment_data.card.brand}} ****{{payment_data.card.last4}}-->
<!--&lt;!&ndash;                        <small class="p-1 mx-2  rounded-pill c-third font-weight-bold cursor-pointer" style="background: #ffff00; font-size: 0.2rem" data-toggle="tooltip" data-placement="top" title="It is used at the time of subscriptions or invoices. You can always override this default" v-if="payment_default">DEFAULT</small>&ndash;&gt;-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <span class="c-fourth">Expiry:</span> {{payment_data.card.exp_month}}/{{payment_data.card.exp_year}}-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <span class="c-fourth">Billing Address Postal/Zip Code:</span>{{payment_data.billing_details.address.postal_code}}-->
<!--                    </div>-->
<!--                </div>-->
                <div class="text-center mb-3">
                    <button type="button" class="btn rounded-pill text-white font-weight-bold border-white" v-if="!change_payment && user.payment_methods.length > 0" @click="change_payment = true">Change Payment Method</button>
                </div>
                <div class="d-flex flex-column">
                    <form @submit.prevent="submit" id="payment-form" autocomplete="off">
                        <input id="name_card" type="text" placeholder="Name on Bank Account" class="form-control my-2" v-model="name_card" onkeyup="disabled = false" required/>
                        <div class="d-flex" v-if="payment_method_default && !change_payment">
                            <div class="flex-grow-2">
                                <input type="text" class="form-control bg-third c-fourth my-auto" :value="`**** `+payment_method_default.card.last4+'    '+payment_method_default.card.exp_month+'/'+payment_method_default.card.exp_year" disabled>
                            </div>
<!--                            <div class="flex-fill">-->
<!--                                <div id="card-cvc" class="form-control border-0 pt-2 my-auto"></div>-->
<!--                            </div>-->
                        </div>
                        <div v-if="change_payment || !payment_method_default">
                            <div id="card-element" class="form-control border-0 pt-2 my-2"></div>
                            <div id="card-errors" role="alert" class="c-fifth"></div>
                        </div>
                        <div class="text-center my-3 d-flex justify-content-center w-100">
                            <button type="submit" class="btn text-white font-weight-bold bg-fifth rounded-pill shadow-red" v-if="!loading" :disabled="disabled">CHECKOUT</button>
                            <button type="button" class="btn rounded-pill text-white bg-fifth" v-if="loading" >
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                    <p class="c-fourth text-center mb-2 text-size-sm">By checking out you are accepting Noisesharks' <a href="/docs/Terms%20and%20Conditions.pdf"  target="_blank" class="c-fourth"><b>Terms of Use</b></a>, <a href="/docs/Privacy%20and%20Cookies%20Policy.pdf" target="_blank" class="c-fourth"><b>Privacy Policy</b></a> , <a href="/docs/User%20Policy.pdf" target="_blank" class="c-fourth"><b>User Policy</b></a> ,& <a href="/docs/Copyright%20Policy%20and%20Notice%20and%20Take%20Down%20Policy%20and%20Procedure.pdf" target="_blank" class="c-fourth"><b>Copyright Policy</b></a></p>

                    <p class="c-fourth text-center mb-3 text-size-sm">
                        Noisesharks® does not issue refunds on behalf of contributors
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import Payment from "../../../helpers/Payment";
    import StripeKeys from "../../../helpers/StripeKeys";
    export default {
        name: "Summary",
        props:['summary', 'type_contribution', 'post', 'view_summary', 'user'],
        data(){
            return {
                total:0,
                vat:0,
                gateway: 0,
                loading: false,
                disabled: true,
                card: null,
                card_number: '',
                card_expiry: '',
                card_cvc: '',
                name_card:'',
                client_secret: null,
                token: null,
                data_location: '',
                currency_data: null,
                payment_method: null,
                payment_methods: [],
                payment_method_default: null,
                elements: '',
                change_payment: false,
                stripe: Stripe(StripeKeys.data_keys.STRIPE_KEY)
            }
        },
        mounted() {
            Auth.initialize()
            this.getPaymentsMethods()
        },
        updated(){
            if(Auth.state.username){
                this.calIva()
                if(this.view_summary){
                    let self = this
                    if(this.$parent.user.payment_methods.length > 0 || this.card === null || this.change_payment) {
                        this.initialize()
                    }
                    let card_element = $('#name_card')
                    card_element.on('change', function (event){
                        if (event.complete) {
                            this.disabled = false
                        } else if (event.error) {
                            // show validation to customer
                        }
                        if(event.currentTarget.value !== '' || event.currentTarget.value !== null ){self.disabled = false}

                    })
                    card_element.on('ready', function (event){
                        self.disabled = false
                    })
                }
            }
        },
        computed:{
            currency(){
                return this.$parent.currency
            },
            biling_information(){
                if(Auth.state.username){
                    return {
                        id: null,
                        first_name: this.$parent.user.personal_information ? this.$parent.user.personal_information.first_name : '',
                        last_name: this.$parent.user.personal_information ? this.$parent.user.personal_information.last_name : '',
                        address: '',
                        country: this.data_location.country_name,
                        city: this.data_location.city,
                        state: this.data_location.region_name,
                        zip_code: this.data_location.zip,
                        payment_method_id:null
                    }
                }
            }
        },
        methods:{
            initialize(){
                this.elements = this.stripe.elements()

                if(this.$parent.user.payment_methods.length > 0 && !this.change_payment) {
                }else{
                    if(this.card === null) {
                        this.card = this.elements.create('card', {style: Payment.data.style, hidePostalCode: true})
                        this.card.mount('#card-element')
                    }
                }
            },
            reset(){
                this.total = 0
                this.vat = 0
                this.gateway =  0
                this.loading =  false
                this.disabled =  true
                this.card =  null
                this.card_number =  ''
                this.card_expiry =  ''
                this.card_cvc =  ''
                this.name_card = ''
                this.stripe = Stripe(StripeKeys.data_keys.STRIPE_KEY)
                this.payment_method =  null
                this.client_secret =  null
                this.token =  null
                this.data_location =  ''
                this.currency_data =  null
                this.payment_methods =  []
                this.elements = ''
                this.change_payment = false
            },
            async getPaymentsMethods(){
                if(this.user.payment_methods){
                    if(this.user.payment_methods.length > 0){
                        let self = this
                        this.user.payment_methods.map(payment_method => {
                            let data = { payment_method: payment_method.card_id }
                            axios.post(`/User/get/paymentMethods/${Auth.state.username}`, data).then(res =>{
                                if(res.data) {
                                    self.payment_methods.push(res.data.payment_method)
                                    self.payment_method_default = res.data.payment_method_default ? res.data.payment_method : null
                                }
                            }).catch(err=>{
                                Auth.keepLogged(err.response.status)
                            })
                        })
                    }
                }
            },
            calIva(){
                if(!this.$parent.user.payment_ip_data){
                    let self = this
                    $.getJSON('https://api.ipstack.com/check?access_key='+StripeKeys.data_keys.CLIENT_IP_STACK_LOCATION, function (res){
                        if(res.currency && res.continent_code) {
                            // set location
                            self.data_location = res
                            // set currency
                            self.currency_data = res.currency.symbol === 'CO$' ? '$' : res.currency.symbol
                            self.$parent.currency = res.currency.symbol === 'CO$' ? '$' : res.currency.symbol
                            // set vat
                            self.vat = res.continent_code === 'EU' ? parseFloat(((parseInt(self.summary.amount) * 20) / 100)).toFixed(2) : 0
                            // initialize payment data
                            Payment.initializePaymentData(self.summary, self.vat)
                            self.total = Payment.data.payment_values.total
                        }
                        if(Auth.state.username){
                            axios.post(`/${Auth.state.username}/Payment/Save/Ip/Data`, res).then(res =>{
                                if(res.data.saved){
                                    self.$parent.user.payment_ip_data = res.data.user.payment_ip_data
                                }
                            }).catch(err=>{
                                swal('Error', `${err}`, 'error')
                            })
                        }

                    })
                    this.gateway = Payment.data.payment_values.gateway
                }else{
                    this.$parent.user.payment_ip_data.currency = typeof this.$parent.user.payment_ip_data.currency === 'string' ? JSON.parse(this.$parent.user.payment_ip_data.currency) : this.$parent.user.payment_ip_data.currency
                    // set location
                    this.data_location = this.$parent.user.payment_ip_data
                    // set currency
                    this.currency_data = this.$parent.user.payment_ip_data.currency.symbol === 'CO$' ? '$' : this.$parent.user.payment_ip_data.currency.symbol
                    // ya no se necesita
                    // this.$parent.currency = this.$parent.user.payment_ip_data.currency.symbol === 'CO$' ? '$' : this.$parent.user.payment_ip_data.currency.symbol

                    // set vat
                    this.vat = this.$parent.user.payment_ip_data.continent_code === 'EU' ? parseFloat(((parseInt(this.summary.amount) * 20) / 100)).toFixed(2) : 0
                    // initialize payment data
                    Payment.initializePaymentData(this.summary, this.vat)
                    this.total = Payment.data.payment_values.total

                    this.gateway = Payment.data.payment_values.gateway
                }

            },
            async submit(){
                await Auth.setSession()
                if(this.biling_information.zip_code){
                    this.loading = true
                        await this.createPaymentMethod()
                }else{
                    swal('Error', 'fill in the field marked with (*)', 'error')
                }
            },
            async createPaymentMethod(){
                let payment = this.$parent.user.payment_methods
                if(payment.length < 1 || this.change_payment){
                    await this.stripe.createPaymentMethod({
                        type: 'card',
                        card: this.card,
                        billing_details: {
                            name: this.name_card,
                            address: {
                                city:this.biling_information.city,
                                state: this.biling_information.state
                            }
                        },
                    }).then(res =>{
                        this.payment_method = res.paymentMethod
                        this.createPaymentToken()
                    }).catch(err =>{console.log(err)});
                }else{
                    this.payment_method = payment[0]
                    this.token = this.payment_method.card_token
                    if(this.$root.current_plan !== ''){
                        await this.updateSubscription()
                    }else{
                        await this.createPaymentIntent()
                    }
                }
            },
            async createPaymentToken(){
                let data = {
                    name: this.biling_information.first_name+' '+this.biling_information.last_name,
                    address_line1: this.biling_information.address,
                    address_city: this.biling_information.city,
                    address_state: this.biling_information.state,
                    address_zip: this.biling_information.zip_code,
                    address_country: this.biling_information.country,
                }
                await this.stripe.createToken(this.card, data).then(result => {
                    if (result.error) {
                        swal('Error', 'token error','error')
                    } else {
                        this.token = result.token.id;
                        if(this.$root.current_plan !== ''){
                            this.updateSubscription()
                        }else{
                            this.createPaymentIntent()
                        }
                    }
                }).catch(err =>{
                    this.loading = false
                });
            },
            async createPaymentIntent(){
                await Auth.setSession()
                parseFloat(this.summary.amount).toFixed(2)
                let data = {
                    summary : this.summary,
                    payment_method: this.payment_method,
                    biling_information: this.biling_information,
                }
                data.payment_method.token = this.token;
                this.$root.current_plan !== '' ? data.current_plan_id = this.$root.current_plan : ''

                await axios.post(`/${Auth.state.username}/Payment/Intent/${this.post ? this.post.user.token : this.$parent.user.token}/${this.type_contribution}/${this.token}`, data).then(res=>{
                    // valido si el tipo de contribucion es support , para ejecutar el guardado y la generacion de facturas
                    if(res.data.type === 'support'){
                        this.save()
                        window.location.replace(`/Payment/Invoice/Generate/${res.data.type}/${res.data.payment.invoice.id}/${res.data.user.token}`, '_blank')
                        axios.get(`/Payment/Invoice/Generate/${res.data.type}/${res.data.payment.invoice.id}/${res.data.user.token}`).then(res =>{}).catch(err=>{Auth.keepLogged(err.response.status)})
                    }else if(res.data.errors) {
                        swal({
                            text: res.data.errors === 'Your card has insufficient funds.' ? res.data.errors : 'This user does not meet the conditions to receive money.',
                            icon: 'error',
                            className:['swal-alert'],
                            buttons: [false,'Ok'],
                        })
                        $('.swal-footer').addClass('text-center')
                    }
                    if(res.data.client_secret){
                        this.client_secret = res.data.client_secret
                        // si el usuario esta en canada , se confirma el pago desde el backend,
                        // se debe evitar a todo costo errores en el guardado del reward...
                        if(this.post.user.country === 'Canada'){
                            swal({
                                title: 'Success',
                                text: 'Payment Successfull',
                                icon:'success',
                                className:'swal-alert',
                                buttons: [false,'Ok'],
                            })
                            $('.swal-footer').addClass('text-center')
                            this.save()
                            window.location.replace(`/Payment/Invoice/Generate/reward/${res.data.payment.id}/${res.data.user.token}`, '_blank')
                            axios.get(`/Payment/Invoice/Generate/reward/${res.data.payment.id}/${res.data.user.token}`).then(res =>{}).catch(err=>{Auth.keepLogged(err.response.status)})
                        }else{
                            this.confirmPayment(res.data.client_secret, res.data.payment, res.data.user)
                        }
                    }
                    this.loading = false
                }).catch(err =>{
                    this.loading = false
                    console.log(err)
                    Auth.keepLogged(err.response.status)
                })
            },
            async confirmPayment(client_secret, payment, user){
                await Auth.setSession()
                let payment_method = ''
                let payment_method_options = ''
                // valido si tiene metodo de pago seleccionado o se esta enviando un nuevo metodo de pago
                if(this.payment_method_default){
                    payment_method = `${this.payment_method_default.id}`
                    payment_method_options = {
                        card: {
                            cvc: this.card_cvc
                        }
                    }
                }else{
                    payment_method = {
                        card: this.card,
                        billing_details: {
                            name: this.name_card,
                            address: {
                                city: this.biling_information.city,
                                state: this.biling_information.state
                            }
                        }
                    }
                    payment_method_options = null
                }
                await this.stripe.confirmCardPayment(client_secret ,{payment_method}).then(res =>{
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
                                icon:'success',
                                className:'swal-alert',
                                buttons: [false,'Ok'],
                            })
                            $('.swal-footer').addClass('text-center')
                            this.save()
                            window.location.replace(`/Payment/Invoice/Generate/reward/${payment.id}/${user.token}`, '_blank')
                            axios.get(`/Payment/Invoice/Generate/reward/${payment.id}/${user.token}`).then(res =>{}).catch(res=>{Auth.keepLogged(err.response.status)})
                        }
                    }
                })
            },
            async save(){
                if(Auth.state.username){
                    await Auth.setSession()
                    let self = this
                    // aca valido la ruta en la que se encuentra para realizar el cliclo
                    // del cambio de estado en el support, si esta en el stream busca los posts del usuario
                    // y cambia el estado, de lo contrario lo hace en el cahnnel activity

                    if(window.location.href === 'http://localhost:8000/' || window.location.href === 'http://localhost:8000/#' || window.location.href === 'https://www.noisesharks.com/' || window.location.href === 'https://www.noisesharks.com/#' ){
                        _.each(this.$root.$refs.home.$refs.posts.$children, function(post, key){
                            // console.log(post)
                            if(key > 4){
                                if(post.post.token === self.post.token){
                                    if(self.type_contribution === 'support'){
                                        post.$refs.reactions.support_type = 'support-payment'
                                        post.$refs.reactions.support.monthly_amount = self.summary.amount
                                        post.$refs.reactions.support.tier_id = self.summary.tier.tier_id
                                        post.$refs.reactions.storeSupport()
                                        self.$parent.view_summary = false
                                        self.change_payment = false
                                        $('#modalSupport').modal('toggle')
                                    }else if(self.type_contribution === 'reward'){
                                        post.$refs.reactions.reward_type = 'reward-payment'
                                        post.$refs.reactions.reward.amount = self.summary.amount
                                        post.$refs.reactions.storeReward()
                                        self.$parent.view_summary = false
                                        self.change_payment = false
                                        $('#modalReward').modal('toggle')
                                    }
                                }
                            }
                        })
                    }else{
                        if(this.type_contribution === 'support'){
                            this.$parent.$parent.support_type = 'support-payment'
                            this.$parent.$parent.support.monthly_amount = self.summary.amount
                            this.$parent.$parent.support.tier_id = self.summary.tier.tier_id
                            this.$parent.$parent.storeSupport()
                            self.$parent.view_summary = false
                            $('#modalSupport').modal('toggle')
                        }else if(this.type_contribution === 'reward'){
                            this.$parent.$parent.reward_type = 'reward-payment'
                            this.$parent.$parent.reward.amount = self.summary.amount
                            this.$parent.$parent.storeReward()
                            self.$parent.view_summary = false
                            $('#modalReward').modal('toggle')
                        }
                    }
                }else{
                    $('#ModalLogin').modal('show');
                }
            },
            async updateSubscription(){

                let supports = ''
                _.each(this.post.user.supports, support =>{
                    if(support.user.username === Auth.state.username){return supports = support}
                })
                let data = {
                    username_receptor: this.post.user.username,
                    support: supports,
                    summary : this.summary,
                    payment_method: this.payment_method,
                }
                data.payment_method.token = this.token;

                await axios.post(`/${Auth.state.username}/Payment/Update/Subscription/${this.$root.current_plan}/${this.summary.tier.tier_id}`, data).then(res =>{
                    if(res.data.updated){
                        console.log(res.data)
                        this.$root.current_plan = res.data.support.tier_id
                        window.location.replace(`/Payment/Invoice/Generate/${res.data.type}/${res.data.payment.invoice.id}/${res.data.user.token}`, '_blank')
                        axios.get(`/Payment/Invoice/Generate/${res.data.type}/${res.data.payment.invoice.id}/${res.data.user.token}`).then(res =>{}).catch(err=>{Auth.keepLogged(err.response.status)})
                        swal('Success', 'Subscription Updated Succesfully', 'success')
                    }else{
                        swal('error', 'has been a error ','error')
                    }
                    this.loading = false
                }).catch(err => {
                    console.log(err)
                    this.loading = false
                })
            }
        }
    }
</script>
