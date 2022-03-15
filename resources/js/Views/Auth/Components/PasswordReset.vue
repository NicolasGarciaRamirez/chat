<template>
   <div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="ModalResetPassword" aria-hidden="true" data-backdrop="static"
         id="ModalResetPassword">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-0 px-5 text-white">
                    <h5 class="font-weight-bold text-white text-center mb-3">Password Reset</h5>
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
                    <form @submit.prevent="update()">
                        <div class="d-flex flex-column">
                            <span class="c-six font-weight-bold">
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
                            <input type="password" :class="`form-control my-1 ${errors.first('password') ? 'border-1c6' : ''}`"  autocomplete="false" name="password" placeholder="Password" v-model="new_password" v-validate="'required|verify_password'" ref="password" required>
                            <span class="c-six font-weight-bold">
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
                            <input type="password" :class="`form-control my-1 ${errors.first('password_confirmation') ? 'border-1c6' : ''}`"  autocomplete="false" name="password_confirmation" placeholder="Confirm Password" v-model="new_password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" required>
                            <div class="divider mt-3 mb-4"></div>
                            <div  class="text-center">
                                <button class="btn text-white bg-fifth text-center mb-4 w-50 rounded-pill">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Validator } from 'vee-validate'
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
            password_confirmation: 'password'
        }
    }
};
Validator.localize(dictionary);
export default {
    props:['user'],
    data(){
        return {
            disable: false,
            new_password: '',
            new_password_confirmation: '',
            backend_errors: null
        }
    },
    mounted() {
        $('#ModalResetPassword').modal('show')
        $("#ModalResetPassword").on("hidden.bs.modal", function () {
            window.location.href = '/';
        });
    },
    methods:{
        update(){
            this.user.password = this.new_password_confirmation
            var data = {
                user: this.user,
                password: this.new_password
            }
            axios.post(`/ResetPassword`, data).then(res => {
                if (res.data.saved) {
                    this.disable = false
                    this.$toasted.show('Password Changed Successfully!', {
                        position: "bottom-right",
                        duration : 4000,
                        className: "notification",
                        keepOnHover: true
                    })
                    this.sleep(2000).then(() => {
                        window.location.href = '/login';
                    })
                }
            }).catch(err => {
                this.disable = false
                this.backend_errors = err.response.data.errors
                Auth.keepLogged(err.response.status)
            })
        },
        sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    }
}
</script>
