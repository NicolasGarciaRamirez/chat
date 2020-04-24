<template>
    <div class="modal fade modal-register" tabindex="-1" role="dialog" aria-labelledby="ModalRegister" aria-hidden="true" id="ModalRegister">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4">
                    <h5 class="text-center">FREE USER SIGNUP</h5>
                    <form @submit.prevent="verifyCredentials" autocomplete="off">
                        <div class="d-flex justify-content-between">
                            <input  type="text" class="form-control mr-5" placeholder="First Name" v-model="user.first_name" required>
                            <input  type="text" class="form-control" placeholder="Last Name" v-model="user.last_name" required>
                        </div>
                        <input id="inputEmail" type="email" class="form-control my-3" placeholder="Email Address" v-model="user.email" required>
                        <input id="inputConfirmEmail" type="email" class="form-control " placeholder="Confirm Email Address" v-model="user.confirm_email">
                        <input id="inputPassword" type="password" class="form-control my-3" placeholder="Password" v-model="user.password"  required>
                        <input id="inputConfirmPassword" type="password" class="form-control" placeholder="Confirm Password" v-model="user.confirm_password" required>
                        <div class="mt-2 p-2 d-flex justify-content-center">
                            <button type="submit" class="btn bg-fifth text-white sign-up ">Sign Up</button>
                        </div>
                    </form>
                    <div><p class="text-center or">OR</p></div>
                    <div class="d-flex flex-column social-login">
                        <a href="#" class="btn bg-facebook text-white">Facebook Quick Singup</a>
                        <a href="#" class="btn bg-twitter text-white my-3">Twitter Quick Singup</a>
                        <a href="#" class="btn bg-white c-fifth">Google Quick Singup</a>
                    </div>
                    <p class="c-fourth text-center mt-3 mb-5">By loging in up you are agreeing to Noisesharks’ Terms of Use, Privacy Policy, & Copyright Policy</p>
                    <div class="divider"></div>
                    <p class="text-center text-white mt-4">Don’t have an ccount yet?!</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                user:{
                    first_name:'',
                    last_name:'',
                    email:'',
                    confirm_email:'',
                    password: '',
                    confirm_password: ''
                },
                validate_email:false,
                validate_password:false
            }
        },
        methods: {
            verifyCredentials(){
                
                if (this.user.email == this.user.confirm_email) {
                    $('#inputEmail').addClass("border-success")
                    $('#inputConfirmEmail').addClass("border-success")  
                    this.validate_email = true 
                }else{
                    $('#inputEmail').addClass("border-danger")
                    $('#inputConfirmEmail').addClass("border-danger")  
                }
                if (this.user.password === this.user.confirm_password) {
                    $('#inputPassword').addClass("border-success")
                    $('#inputConfirmPassword').addClass("border-success")
                    this.validate_password = true
                }else{
                    $('#inputPassword').addClass("border-danger")
                    $('#inputConfirmPassword').addClass("border-danger")
                }

                if (!this.validate_email && !this.validate_password || !this.validate_password || !this.validate_email) {
                    alert('you have error')
                }else{
                    this.save()
                }
            },
            save(){
                this.user = {
                    first_name: this.user.first_name,
                    last_name: this.user.last_name,
                    email: this.user.email,
                    password: this.user.password
                }
                axios.post(`/Register`, this.user).then(res => {
                    if (res.data.saved) {
                        window.location.replace('/')
                    }else{
                        alert('ERROR 500')
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        },
    }
</script>
