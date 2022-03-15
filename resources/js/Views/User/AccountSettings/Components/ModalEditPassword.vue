<template>
    <section>
        <div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="ModalEditPassword" aria-hidden="true" id="ModalEditPassword">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 py-0">
                        <div class="text-center">
                            <h4 class="text-white font-weight-bold mb-3">Change Password?</h4>
                        </div>
                        <div class="alert text-white" v-if="errors_backend != null">
                            <ul v-for="(error, index) in errors_backend" :key="index">
                                <li>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="error">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                                {{error}}</li>
                            </ul>
                        </div>
                        <form @submit.prevent="getLogin">
                            <div class="d-flex flex-column align-items-center">
                                <span class="c-six font-weight-bold mb-2"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('current_password')"> <g> <g> <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5 C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3 C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3 V14.7z"/> </g> </g> </svg>{{ errors.first('current_password') }}</span>
                                <input type="password"  autocomplete="false" :class="`form-control w-75 my-1 ${errors.first('current_password') ? 'border-1c6' : ''}`" name="current_pasword" placeholder="Confirm Current Password"  v-model="current_password" v-validate="'required|verify_password'" required>
                                <span class="c-six font-weight-bold mb-2"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('new_password')"> <g> <g> <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5 C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3 C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3 V14.7z"/> </g> </g> </svg>{{ errors.first('new_password') }}</span>
                                <input type="password"  autocomplete="false" :class="`form-control w-75 my-1 ${errors.first('new_password') ? 'border-1c6' : ''}`" name="password" placeholder="New Password" v-model="new_password" v-validate="'required|verify_password'" ref="password" required>
                                <span class="c-six font-weight-bold mb-2"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="errors.first('password_confirmation')"> <g> <g> <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5 C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3 C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3 V14.7z"/> </g> </g> </svg>{{ errors.first('password_confirmation') }}</span>
                                <input type="password"  autocomplete="false" :class="`form-control w-75 my-1 ${errors.first('password_confirmation') ? 'border-1c6' : ''}`" name="password_confirmation" placeholder="Confirm Password" v-model="new_password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" required>
                            </div>
                            <div class="d-flex flex-column justify-content-end align-items-end cursor-pointer my-3">
                                <a class="forgot-password font-weight-bold" @click="showModalForgotPassword">Forgot Password?</a>
                            </div>
                            <div class="mb-3" style="border-top: 1px solid #262626"></div>
                            <div class="text-right mb-3">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn bg-fifth text-white font-weight-bold rounded-pill" v-if="!disable">Change Password</button>
                                <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <modal-forgot-password />
    </section>
</template>

<script>
import { Validator } from 'vee-validate'
import Auth from "../../../../helpers/Auth";
import ModalForgotPassword from "../../../Auth/Components/ForgotPassword";

Validator.extend('verify_password', {
    validate: value => {
        var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])");
        return strongRegex.test(value);
    },
    getMessage: 'Your password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number'
})
export default {
    props:['user'],
    components:{
        ModalForgotPassword
    },
    data(){
        return {
            disable: false,
            current_password: '',
            new_password: '',
            new_password_confirmation: '',
            errors_backend: null
        }
    },
    methods:{
        showModalForgotPassword(){
            $('#ModalForgotPassword').modal('show')
        },
        getLogin(){
            this.disable = true
            var user = {
                email: this.user.email,
                password: this.current_password
            }
            axios.post('/login', user ).then(res=>{
                if (res.data.auth) {
                    this.user.password = this.new_password
                    this.update()
                }
            }).catch(err=>{
                this.errors_backend = err.response.data.errors
                Auth.keepLogged(err.response.status)
            })
        },
        update(){
            Auth.setSession()
            axios.post(`/User/Settings/Update/${this.user.username}`, this.user).then(res => {
                if (res.data.updated) {
                    this.disable = false
                    this.$toasted.show('Password Changed Successfully!', {
                        position: "bottom-right",
                        duration : 4000,
                        className: "notification",
                        keepOnHover: true
                    })
                    $('#ModalEditPassword').modal('toggle')
                }
            }).catch(err => {
                this.disable = false
                swal('Error')
                Auth.keepLogged(err.response.status)
            })
        }
    }
}
</script>
