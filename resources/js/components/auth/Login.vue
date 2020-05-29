<template>
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
                <div class="modal-body pt-4">
                    <h5 class="text-center font-weight-bold">Login</h5>
                    <div class="alert bg-fifth text-white" v-if="backend_errors != null">
                        <ul class="p-0 m-0 list-style-none">
                            <li v-for="(error, index) in backend_errors" :key="index">{{ error }}</li>
                        </ul>
                    </div>
                    <form @submit.prevent="login" autocomplete="off">
                        <span class="c-fifth">{{ errors.first('email') }}</span>
                        <input type="email" class="form-control my-3" name="email" placeholder="Email Address" v-model="user.email" v-validate="'required|email'" required>
                        <span class="c-fifth">{{ errors.first('password') }}</span>
                        <input type="password" class="form-control" name="password" placeholder="Password" v-model="user.password" v-validate="'required'" required>
                        <div class="mt-2 p-2 d-flex justify-content-between">
                            <button type="submit" class="btn c-fifth p-0 login"><b>Login</b></button>
                            <a href="#" class="forgot-password font-weight-bold">Forgot Password?</a>
                        </div>
                    </form>
                    <div><p class="text-center or">OR</p></div>
                    <div class="d-flex flex-column social-login">
                        <a href="/login/facebook" class="btn bg-facebook text-white">Facebook Quick Login</a>
                        <a href="#" class="btn bg-twitter text-white my-3">Twitter Quick Login</a>
                        <a href="#" class="btn bg-white c-fifth">Google Quick Login</a>
                    </div>
                    <p class="c-fourth text-center mt-3 mb-5">By logging in up you are agreeing to Noisesharks’ <a href="/terms" class="c-fourth"><b>Terms of Use</b></a>, <a href="#" class="c-fourth"><b>Privacy Policy</b></a> , & <a href="#" class="c-fourth"><b>Copyright Policy</b></a></p>
                    <div class="divider"></div>
                    <p class="text-center text-white mt-4">Don’t have an account yet?!</p>
                    <div class="text-center mb-3">
                        <a class="btn bg-fifth text-white sign-me" href="/Register"><b>SIGN ME UP NOW!</b></a>
                    </div>
                </div>
            </div>
            <modal-register />
        </div>
    </div>
</template>

<script>
    import ModalRegister from './Register'
    import { Validator } from 'vee-validate';
    import Auth from '../../helpers/Auth'

    export default {
        props: ['is_login_view'],
        data(){
            return{
                user:{
                    email:'',
                    password: ''
                },
                backend_errors :null
            }
        },
        components:{
            'modal-register' : ModalRegister
        },
        mounted() {
            if (this.is_login_view) {
                $('#ModalLogin').modal('show')
            }
        },
        methods:{
            async login(){
                await axios.post('/login', this.user).then(res =>{
                    if (res.data.auth) {
                        Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar)
                        window.location.replace(`/${res.data.user.username}/Profile/Rates`)
                    }else{
                        return
                    }
                }).catch(err => {
                    this.backend_errors = err.response.data.errors
                })
            },
        }
    }
</script>
