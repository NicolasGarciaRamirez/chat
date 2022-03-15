<template>
    <div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="ModalInviteFormSignUp" aria-hidden="true" data-backdrop="static" id="ModalInviteFormSignUp">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0 pt-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body border-0 px-5 pt-0">
                    <div class="d-flex flex-column text-center mb-4">
                        <h4 class="font-weight-bold c-seven">🎊 Wonderful! 🎊 <br>You’re an early adopter!</h4>
                        <span> Let’s change the music industry together! </span>
                    </div>
                    <form @submit.prevent="save"  autocomplete="off" class="text-center my-2">
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
                        <div class="row mx-0 mb-0">
                            <div class="col mr-1 p-0">
                                 <input type="text" :class="`form-control mb-3 ${errors.first('first_name') ? 'border-1c6' : ''}`"  name="first_name"  placeholder="First Name" v-model="user.first_name" v-validate="'required'" required/>
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
                                <input type="text" :class="`form-control mb-3 ${errors.first('last_name') ? 'border-1c6' : ''}`" name="last_name" placeholder="Last Name" v-model="user.last_name" v-validate="'required'" required/>
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
                             <input type="email" :class="`form-control mb-3 ${errors.first('email') ? 'border-1c6' : ''}`" name="email" placeholder="Email Address" v-model="user.email" v-validate="'required|email'" ref="email" v-on:focusout="verified_email" required>
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
                             <input type="email" :class="`form-control mb-3 ${errors.first('email_confirmation') ? 'border-1c6' : ''}`" id="email_confirmation" name="email_confirmation" placeholder="Confirm Email Address" v-model="user.email_confirmation" v-validate="'required|email|confirmed:email'" data-vv-as="email" @paste.prevent="onPaste" required>
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
                                {{ errors.first('email_confirmation') }}
                             </span>
                             <input type="password" :class="`form-control mb-3 ${errors.first('password') ? 'border-1c6' : ''}`"  autocomplete="false" name="password" placeholder="Password" v-model="user.password" v-validate="'required|verify_password'" ref="password" required>
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
                                {{ errors.first('password') }}
                            </span>
                            <input type="password" :class="`form-control mb-3 ${errors.first('password_confirmation') ? 'border-1c6' : ''}`"  autocomplete="false" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" v-model="user.password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" @paste.prevent="onPaste" required>
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
                                {{ errors.first('password_confirmation') }}
                            </span>
                            <div class="rounded-pill border-white font-weight-bold text-left py-1 mb-2 w-100 selec" id="dropdownCategory"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-caret-down"></i>
                                <div class="barhorizontal"></div>
                                <span>{{ user.country }}</span>
                            </div>
                            <div class="dropdown-menu text-white p-2 cursor-pointer overflow-auto mb-3" aria-labelledby="dropdownCategory" style="max-height: 25rem; min-height: 15rem; width: 16rem">
                                <div class="dropdown-item align-items-center" @click="user.country = country.name" v-for="(country, index) in countrys" :key="index">{{country.name}} <small class="mx-2 px-1 bg-third" v-if="country.tag">{{country.tag}}</small></div>
                            </div>
                            <span class="c-six font-weight-bold mb-1" v-if="user.country === 'Select Country' || user.country === ''">
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
                                The select country field is required
                            </span>
                            <span class="c-white text-center text-size-sm mb-2">
                                Stripe only supports the countries in the list above.
                                We are very sorry if you couldn’t find your country here.
                                However, rest assured we are putting a lot of effort into
                                including more countries on this list
                            </span>
                        </div>
                        <div class="d-flex justify-content-center my-2 p-0">
                            <button type="submit" class="btn bg-fifth text-white sign-up font-weight-bold rounded-pill w-100" v-if="!disable" >Create My Profile</button>
                            <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <p class="c-fourth text-center mb-2 text-size-sm">By creating a profile and signing up you are accepting Noisesharks' <a href="/docs/Terms%20and%20Conditions.pdf"  target="_blank" class="c-fourth"><b>Terms of Use</b></a>, <a href="/docs/Privacy%20and%20Cookies%20Policy.pdf" target="_blank" class="c-fourth"><b>Privacy Policy</b></a> , <a href="/docs/User%20Policy.pdf" target="_blank" class="c-fourth"><b>User Policy</b></a> ,& <a href="/docs/Copyright%20Policy%20and%20Notice%20and%20Take%20Down%20Policy%20and%20Procedure.pdf" target="_blank" class="c-fourth"><b>Copyright Policy</b></a></p>
                            <p class="c-fourth text-center mb-2 text-size-sm">By signing up you are also agreeing that you must create
                                a stripe connect account in order for you to recieve payments
                                from your supporters. we will direct you to the correct link.
                            </p>
                            <p class="c-fourth text-center mb-0 text-size-sm">
                                Noisesharks® does not issue refunds on behalf of contributors
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import {Validator} from "vee-validate";
    import Countrys from "../../../helpers/Countrys";
    import Auth from "../../../helpers/Auth";

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
        name: "ModalInviteFormSignUp",
        props: ['code_invite'],
        data(){
            return {
                user:{
                    first_name: "",
                    last_name: "",
                    email: "",
                    email_confirmation: "",
                    password: "",
                    password_confirmation: "",
                    payment_method: null,
                    country: "Select Country",
                    contributor_type: 'PERCENTAGE',
                    credit: 0,
                },
                backend_errors: null,
                countrys:[],
                disable: false
            }
        },
        computed:{
            channel_information(){
                return {
                    why_support: 'Hey there! You found your way to my channel! I work sincerely on my content aiming to add value to you, the Noisesharks community, and the music industry in general! Would really appreciate it if you help me reach my monthly goal!',
                    monthly_goal_last: {
                            current_earnings: 0,
                            monthly_goal: 150,
                            date_end: '',
                            percentage_completed: ''
                        },
                    tiers: [
                        {
                            id: null,
                            name: 'Tier1',
                            amount: '1',
                            description: `By selecting this tier you will support ${this.user.first_name + this.user.last_name} by sending them a monthly subscription of`,
                        },
                        {
                            id: null,
                            name: 'Tier2',
                            amount: '5',
                            description: `By selecting this tier you will support ${this.user.first_name + this.user.last_name} by sending them a monthly subscription of`,
                        },
                        {
                            id: null,
                            name: 'Tier3',
                            amount: '10',
                            description: `By selecting this tier you will support ${this.user.first_name + this.user.last_name} by sending them a monthly subscription of`,
                        }
                    ]
                }
            },
            currency(){
                return this.$parent.currency
            }
        },
        mounted(){
            Countrys.initialize()
            this.countrys = Countrys.countrys_alph     
        },
        methods:{
            async save(){
                await this.$validator.validate().then(valid => {
                    if (!valid) {
                        this.disable = false
                        return false
                    }             
                    this.user.subscription_type = 'CONTRIBUTOR'
                    this.user.channel_information = this.channel_information
                    this.user.code_invited = this.code_invite;

                    axios.post(`/Register/User/Invited/`, this.user).then(res => {
                        if (res.data.saved) {
                            Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar, false)
                            this.$toasted.show('Congratulations! You’re now a contributor', {
                                duration : 4000,
                                className: "notification",
                                keepOnHover: true,
                                iconPack: 'fontawesome',
                                action: {
                                    icon:'fa-times',
                                    onClick:(e, toast) => {
                                        toast.goAway(0);
                                    }
                                }
                            })
                            setTimeout( window.location.replace(`/${res.data.user.username}/Channel/Activity/`), 20)
                            swal("success", "You have obtained 10 credits for having registered in the application", 'success');
                        }
                    }).catch(err => {
                        this.disable = false
                        this.backend_errors = err.response.data.errors
                        Auth.keepLogged(err.response.status)
                    })
                });
            },
            async verified_email(){
                await axios.post('/Email/Verified/Unique', this.user).then(res=>{this.backend_errors = null}).catch(err=>{
                    this.backend_errors = err.response.data.errors
                    Auth.keepLogged(err.response.status)
                })
            },
        }
    }
</script>

<style scoped>

</style>
