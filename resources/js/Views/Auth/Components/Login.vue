<template>
    <section>
        <div class="modal fade modal-login" tabindex="-1" role="dialog"
             :data-backdrop="is_login_view ? 'static' : 'none'" aria-labelledby="ModalLogin" aria-hidden="true"
             id="ModalLogin">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <h5 class="text-center font-weight-bold">Login</h5>
                        <div class="alert text-white" v-if="backend_errors != null">
                            <ul class="p-0 m-0 list-style-none">
                                <li v-for="(error, index) in backend_errors" :key="index">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                      viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors">
                                    <g>
                                        <g>
                                            <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                                C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                                C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                                V14.7z"/>
                                        </g>
                                    </g>
                                </svg>
                                {{ error }}</li>
                            </ul>
                        </div>
                        <form @submit.prevent="login" autocomplete="off">
                            <input type="email" :class="`form-control mt-3 mb-2 ${errors.first('email') ? 'border-1c6' : ''}`" name="email" placeholder="Email Address" v-model="user.email" v-validate="'required|email'" required>
                            <span class="c-six font-weight-bold mb-3">
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
                                {{ errors.first('email') }}</span>
                            <input type="password" :class="`form-control mt-3 mb-2 ${errors.first('password') ? 'border-1c6' : ''}`"  autocomplete="false" name="password" placeholder="Password" v-model="user.password" v-validate="'required'" required>
                            <span class="c-six font-weight-bold mb-3">
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
                            <div class="px-2 pt-2 d-flex justify-content-between">
                                <button type="submit" class="btn c-fifth p-0 login"><b>Login</b></button>
                                <a class="forgot-password font-weight-bold" @click="showModalForgotPassword">Forgot Password?</a>
                            </div>
                            <div class="content-checkbox px-2 pt-2">
                                <div>
                                    <label class="check-button">
                                        <input type="checkbox" @change="setKeepLogged()" v-model="keep_logged">
                                        <span><b class="ml-1">Keep me logged in</b></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                        <div><p class="text-center or">OR</p></div>
                        <div class="d-flex flex-column social-login">
                            <a href="/auth/facebook" class="btn bg-facebook text-white">Facebook Quick Login</a>
                            <a href="/auth/twitter" class="btn bg-twitter text-white my-3">Twitter Quick Login</a>
                            <a href="/auth/google" class="btn bg-google c-fifth">Google Quick Login</a>
                        </div>
                        <p class="c-fourth text-center my-3 text-size-sm">By creating a profile and signing up you are accepting Noisesharks'.... <a href="/docs/Terms%20and%20Conditions.pdf"  target="_blank" class="c-fourth"><b>Terms of Use</b></a>, <a href="/docs/Privacy%20and%20Cookies%20Policy.pdf" target="_blank" class="c-fourth"><b>Privacy Policy</b></a> , <a href="/docs/User%20Policy.pdf" target="_blank" class="c-fourth"><b>User Policy</b></a> ,& <a href="/docs/Copyright%20Policy%20and%20Notice%20and%20Take%20Down%20Policy%20and%20Procedure.pdf" target="_blank" class="c-fourth"><b>Copyright Policy</b></a></p>
                        <div class="divider"></div>
                        <p class="text-center text-white">Don’t have an account yet?!</p>
                        <div class="text-center mb-3">
                            <a class="btn bg-fifth text-white sign-me" href="/Register"><b>SIGN ME UP NOW!</b></a>
                        </div>
                    </div>
                </div>
                <modal-register />
                <modal-forgot-password />
            </div>
        </div>
        <modal-same-email></modal-same-email>
    </section>
</template>

<script>
    import ModalRegister from '../Views/Register'
    import { Validator } from 'vee-validate';
    import ModalForgotPassword from './ForgotPassword'
    import Auth from "../../../helpers/Auth";
    import Followers from "../../../helpers/Followers";
    import ModalSameEmail from "./ModalSameEmail.vue";

    Validator.extend('email', {
        validate: value => {
            let strongRegex = new RegExp("^[^@]+@[^@]+\\.[a-zA-Z]{2,}$");
            return strongRegex.test(value);
        },
        getMessage: 'Please enter a valid email'
    })

    const dictionary = {
        en: {
            attributes: {
                email: 'email',
                password: 'password'
            }
        }
    };
    Validator.localize(dictionary);

    export default {
        props: ['is_login_view', 'message'],
        data(){
            return{
                user:{
                    email:'',
                    password: ''
                },
                backend_errors :null,
                keep_logged: false,
                href: ''
            }
        },
        components:{
            ModalSameEmail,
            'modal-register' : ModalRegister,
            ModalForgotPassword,
        },
        mounted() {
            if(this.message !== null && this.message !== undefined && this.message !== '' && this.message !== ' '){
                $('#ModalSameEmail').modal('show')
            }
            if (this.is_login_view) {
                $('#ModalLogin').modal('show')
                $("#ModalResetPassword").on("hidden.bs.modal", function () {window.location.href = '/';});
            }
            Auth.initialize()
            Auth.setSessionValue(this.keep_logged)
            Auth.state.session === 'true' ? this.keep_logged = true : this.keep_logged = false
        },
        methods:{
            showModalForgotPassword(){
                $('#ModalForgotPassword').modal('show')
            },
            async login(){
                await axios.post('/login', this.user).then(res =>{
                    if (res.data.auth) {
                        $('#ModalLogin').modal('hide')
                        Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar, this.keep_logged)
                        window.location.replace(`/`)
                    }else{
                        return
                    }
                }).catch(err => {
                    this.backend_errors = err.response ? err.response.data.errors : ''
                    Auth.keepLogged(err.response.status)
                })
            },
            setKeepLogged(){
                Auth.setSessionValue(this.keep_logged)
                Auth.initialize()
            }
        }
    }
</script>
