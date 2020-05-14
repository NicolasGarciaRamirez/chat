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
                    <h5 class="text-center">Login</h5>
                    <form @submit.prevent="login" autocomplete="off">
                        <input type="email" class="form-control my-3" placeholder="Email Address" v-model="user.email" required>
                        <input type="password" class="form-control" placeholder="Password" v-model="user.password" required>
                        <div class="mt-2 p-2 d-flex justify-content-between">
                            <button type="submit" class="btn c-fifth p-0"><b>Login</b></button>
                            <a href="#" class="c-fourth">Forgot Password?</a>
                        </div>
                    </form>
                    <div><p class="text-center or">OR</p></div>
                    <div class="d-flex flex-column social-login">
                        <a href="/login/facebook" class="btn bg-facebook text-white">Facebook Quick Login</a>
                        <a href="#" class="btn bg-twitter text-white my-3">Twitter Quick Login</a>
                        <a href="#" class="btn bg-white c-fifth">Google Quick Login</a>
                    </div>
                    <p class="c-fourth text-center mt-3 mb-5">By loging in up you are agreeing to Noisesharks’ Terms of Use, Privacy Policy, & Copyright Policy</p>
                    <div class="divider"></div>
                    <p class="text-center text-white mt-4">Don’t have an ccount yet?!</p>
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
    export default {
        props: ['is_login_view'],
        data(){
            return{
                user:{
                    email:'',
                    password: ''
                }
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
                    window.location.replace('/Profile/Channel/Activity')
                }).catch(err => {
                    alert('your credentials not have any match')
                })
            },
        }
    }
</script>
