<template>
    <section>
        <div class="container-fluid px-4">
            <div class="d-flex flex-column">
                <div>
                    <h4 class="font-weight-bold text-center my-3">{{type === 'Free' ? 'Free User' : type}} Signup</h4>
                </div>
                <div class="alert text-white" v-if="backend_errors != null">
                    <ul class="p-0 m-0 list-style-none">
                        <li v-for="(error, index) in backend_errors" :key="index">
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="error[0]">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                        {{ error[0] }}</li>
                    </ul>
                </div>
                <form @submit.prevent="save"  autocomplete="off" class="text-center my-2">
                    <div class="row mx-0 mb-1">
                        <div class="col mr-1 p-0">
                            <input type="text" :class="`form-control my-1 ${errors.first('first_name') ? 'border-1c6' : ''}`"  name="first_name"  placeholder="First Name" v-model="user.first_name" v-validate="'required'" required/>
                         <span class="c-six font-weight-bold">
                         <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('first_name')">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                         {{ errors.first('first_name') }}</span>
                        </div>
                        <div class="col ml-1 p-0">
                            <input type="text" :class="`form-control my-1 ${errors.first('last_name') ? 'border-1c6' : ''}`" name="last_name" placeholder="Last Name" v-model="user.last_name" v-validate="'required'" required/>
                            <span class="c-six font-weight-bold">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('last_name')">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                                {{ errors.first('last_name') }}</span>
                        </div>
                    </div>
                    <div class="row m-auto">
                        <input type="email" :class="`form-control my-1 ${errors.first('email') ? 'border-1c6' : ''}`" name="email" placeholder="Email Address" v-model="user.email" v-validate="'required|email'" ref="email" v-on:focusout="verified_email" required>
                        <span class="c-six font-weight-bold">
                             <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('email')">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                            {{ errors.first('email') }}
                        </span>
                        <input type="email" :class="`form-control my-1 ${errors.first('email_confirmation') ? 'border-1c6' : ''}`" id="email_confirmation" name="email_confirmation" placeholder="Confirm Email Address" v-model="user.email_confirmation" v-validate="'required|email|confirmed:email'" data-vv-as="email" @paste.prevent="onPaste" required>
                        <span class="c-six font-weight-bold mt-1 mb-2">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('email_confirmation')">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                            {{ errors.first('email_confirmation') }}</span>
                        <input type="password" :class="`form-control my-1 ${errors.first('password') ? 'border-1c6' : ''}`" autocomplete="false" name="password" placeholder="Password" v-model="user.password" v-validate="'required|verify_password'" ref="password" required>
                        <span class="c-six font-weight-bold mt-1 mb-2">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('password')">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                            {{ errors.first('password') }}</span>
                        <input type="password" :class="`form-control my-1 ${errors.first('password_confirmation') ? 'border-1c6' : ''}`"   autocomplete="false" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" v-model="user.password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" @paste.prevent="onPaste" required>
                        <span class="c-six font-weight-bold mt-1 mb-2">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('password_confirmation')">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                            {{ errors.first('password_confirmation') }}</span>
                        <div class="rounded-pill border-white font-weight-bold text-left py-1 my-2 w-100 selec" id="dropdownCategory"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-if="type === 'Contributor'">
                            <i class="fas fa-caret-down"></i>
                            <div class="barhorizontal"></div>
                            <span>{{ user.country }}</span>
                        </div>
                        <div class="dropdown-menu text-white p-2 cursor-pointer overflow-auto my-1" aria-labelledby="dropdownCategory" style="max-height: 25rem; min-height: 15rem; width: 16rem">
                            <div class="dropdown-item align-items-center" @click="user.country = country.name" v-for="(country, index) in countrys" :key="index">{{country.name}} <small class="mx-2 px-1 bg-third" v-if="country.tag">{{country.tag}}</small></div>
                        </div>
                        <span class="c-six font-weight-bold mb-1" v-if="type === 'Contributor' && user.country === 'Select Country' || user.country === ''">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                            The select country field is required</span>
                        <span class="c-white text-center text-size-sm mb-2" v-if="type === 'Contributor'">
                            Stripe only supports the countries in the list above.
                            We are very sorry if you couldn’t find your country here.
                            However, rest assured we are putting a lot of effort into
                            including more countries on this list
                        </span>
                    </div>
                    <div class="d-flex justify-content-center my-2 p-0" v-if="type === 'Free'">
                        <button type="submit" class="btn bg-fifth text-white sign-up font-weight-bold rounded-pill w-100" v-if="!disable">Sign Up</button>
                        <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="py-2" v-if="type === 'Free'">
                        <p class="text-center or c-fourth mb-0">OR</p>
                    </div>
                    <div class="d-flex flex-column social-login mt-2" v-if="type === 'Free'">
                        <a href="/auth/facebook" class="btn bg-facebook rounded-pill font-weight-bold text-white">Facebook Quick Signup</a>
                        <a href="/auth/twitter" class="btn bg-twitter rounded-pill font-weight-bold text-white my-2">Twitter Quick Signup</a>
                        <a href="/auth/google" class="btn bg-google rounded-pill font-weight-bold c-fifth">Google Quick Signup</a>
                    </div>
                    <div class="d-flex flex-column" v-if="type === 'Contributor'">
                        <button type="button" class="btn rounded-pill bg-fifth text-white font-weight-bold my-2" @click="showPayment">Create Account!</button>
                    </div>
                </form>
                <p class="c-fourth text-center mb-2 text-size-sm">By creating a profile and signing up you are accepting Noisesharks' <a href="/docs/Terms%20and%20Conditions.pdf"  target="_blank" class="c-fourth"><b>Terms of Use</b></a>, <a href="/docs/Privacy%20and%20Cookies%20Policy.pdf" target="_blank" class="c-fourth"><b>Privacy Policy</b></a> , <a href="/docs/User%20Policy.pdf" target="_blank" class="c-fourth"><b>User Policy</b></a> ,& <a href="/docs/Copyright%20Policy%20and%20Notice%20and%20Take%20Down%20Policy%20and%20Procedure.pdf" target="_blank" class="c-fourth"><b>Copyright Policy</b></a></p>
                <p class="c-fourth text-center mb-2 text-size-sm" v-if="type === 'Contributor'">By signing up you are also agreeing that you must create
                    a stripe connect account in order for you to recieve payments
                    from your supporters. we will direct you to the correct link.
                </p>
                <p class="c-fourth text-center mb-3 text-size-sm">
                    Noisesharks® does not issue refunds on behalf of contributors
                </p>
                <div class="divider"></div>
                 <p class="text-white mb-3">Already have an account?<a href="#" class="c-fifth font-weight-bold mb-3 ml-2" @click="showModalLogin"> Login Here!</a></p>
            </div>
            <modal-payment-success></modal-payment-success>
            <modal-payment :type="contributor_type" ref="ModalPayment"></modal-payment>
            <modal-stripe :state="'account_connect_initial'" :auth_user="auth_user"></modal-stripe>
        </div>
    </section>
</template>

<script>
    import { Validator } from 'vee-validate'
    import Auth from "../../../helpers/Auth";
    import ModalPayment from "../../Payments/Views/ModalPayment";
    import ModalStripe from "../../Payments/Components/ModalStripe";
    import ModalPaymentSuccess from "../../Payments/Views/ModalPaymentSuccess";
    import Countrys from "../../../helpers/Countrys";
    import Payment from "../../../helpers/Payment";
    import GoogleCaptcha from "../../../helpers/GoogleCaptcha";

    Validator.extend('verify_password', {
        validate: value => {
            var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])");
            return strongRegex.test(value);
        },
        getMessage: 'Your password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number'
    })

    const dictionary = {
        en: {
            attributes: {
                first_name: 'first name',
                last_name: 'last name',
                email_confirmation: 'email confirmation',
                password_confirmation: 'password',
                select_country: 'select country'
            }
        }
    };
    Validator.localize(dictionary);

    export default {
        components: {ModalPaymentSuccess, ModalStripe, ModalPayment},
        props: ['type', 'contributor_type'],
        data() {
            return {
                disable: false,
                user: {
                    first_name: "",
                    last_name: "",
                    email: "",
                    email_confirmation: "",
                    password: "",
                    password_confirmation: "",
                    payment_method: null,
                    country: "Select Country",
                    credit: 0,
                    biling_information:{
                        first_name: '',
                        last_name: '',
                        address: '',
                        country: '',
                        city:'',
                        state:'',
                        zip_code: '',
                        user_id: ''
                    }
                },
                backend_errors: null,
                auth_user: '',
                countrys:[],
                google_key:''
            }
        },
        mounted() {
            Countrys.initialize()
            Payment.initialize()
            this.google_key = GoogleCaptcha.google_key
            this.countrys = Countrys.countrys_alph
            let self = this
            $('#ModalPayment').on('show.bs.modal', function () {
                self.$refs.ModalPayment.$refs.SummarySubscription.getVta()
            });
        },
        methods: {
            onClick(e){
                e.preventDefault();
                grecaptcha.ready(function() {
                    grecaptcha.execute(GoogleCaptcha.google_key.public, {action: 'submit'}).then(function(token) {
                        console.log(token, 'token captcha')
                        return token
                    });
                });
            },
            onPaste(){
                swal('Error', 'Pasting and Ctrl+V are not allowed', 'error')
                $('.swal-footer').addClass('text-center')
            },
            showPayment(){
                this.$validator.validate().then(valid => {
                    if(valid && this.user.country !== ''){
                        $('#ModalPayment').modal('show')
                    }else{
                        swal({
                            title: 'Error',
                            text: 'Please complete all fields',
                            icon: 'error',
                            className: 'swal-alert',
                            buttons: [false,'Ok'],
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                    }
                })
            },
            async save(data) {
                this.disable = true
                this.$validator.validate().then(valid => {
                    if (!valid) {
                        this.disable = false
                        return false
                    }
                    this.user.subscription_type = this.type
                    this.user.contributor_type = this.contributor_type
                    this.user.payment_method = data.payment_method
                    if(this.type !== 'Free'){
                        this.user.biling_information = data.payment_information.biling_information
                    }
                    axios.post(`/Register`, this.user).then(res => {
                        if (res.data.saved) {
                            if(window.location.href === 'http://localhost:8000/Register/Contributor/Percentage' || window.location.href === 'http://localhost:8000/Register/Contributor/Subscription' || window.location.href === 'https://www.noisesharks.com/Register/Contributor/Percentage' || window.location.href === 'https://www.noisesharks.com/Register/Contributor/Subscription'){
                                this.auth_user = res.data.user
                                data.payment = res.data.payment ? res.data.payment : null
                                this.confirmPayment(data)
                            }else{
                                Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar)
                                window.location.replace(`/`)
                            }
                        }
                    }).catch(err => {
                        this.disable = false
                        this.backend_errors = err.response.data.errors
                        Auth.keepLogged(err.response.status)
                    })
                });
            },
            async setHelperAuth(){
                await Auth.set(this.auth_user.token, this.auth_user.username, this.auth_user.avatar)
                await Auth.setSession()
            },
            async confirmPayment(data){
                await data.stripe.confirmCardPayment(data.client_secret , {
                    payment_method:{
                        card: data.payment_information.card,
                        billing_details: {
                            name: data.payment_information.name_card,
                            address: {
                                city: data.payment_information.biling_information.city,
                                state: data.payment_information.biling_information.state
                            }
                        }
                    }
                }).then(res =>{
                    if(res.error){
                        this.$refs.ModalPayment.loading = false
                        swal({
                            text: res.error.message,
                            className: 'swal-alert',
                            buttons: [false,'Ok'],
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                    }else{
                        if(res.paymentIntent.status === 'succeeded'){
                            this.$refs.ModalPayment.loading = false
                            $('#ModalPayment').modal('toggle')
                            $('#ModalPaymentSuccess').modal('show')
                            if(data.payment){
                                window.location.replace(`/Payment/Invoice/Generate/contributor/${data.invoice.id}/${data.user.id}`, '_blank')
                                axios.get(`/Payment/Invoice/Generate/contributor/${data.invoice.id}/${data.user.id}`).then(res =>{})
                            }
                        }
                    }
                })
            },
            async verified_email(){
                await axios.post('/Email/Verified/Unique', this.user).then(res=>{this.backend_errors = null}).catch(err=>{
                    this.backend_errors = err.response.data.errors
                    Auth.keepLogged(err.response.status)
                })
            },
            showModalLogin(){
                $('#ModalLogin').modal('show')
            }
        }
    }
</script>
