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
                <div class="modal-body pt-4 text-white">
                    <h5 class="font-weight-bold text-white text-center">Password Reset</h5>
                    <div class="alert bg-fifth text-white" v-if="backend_errors != null">
                        <ul class="p-0 m-0 list-style-none">
                            <li v-for="(error, index) in backend_errors" :key="index">{{ error[0] }}</li>
                        </ul>
                    </div>
                    <form @submit.prevent="update()">
                        <div class="d-flex flex-column">
                            <span class="c-fifth">{{ errors.first('password') }}</span>
                            <input type="password" class="form-control mb-3" name="password" placeholder="Password" v-model="new_password" v-validate="'required|verify_password'" ref="password" required>
                            <span class="c-fifth">{{ errors.first('password_confirmation') }}</span>
                            <input type="password" class="form-control mb-3" name="password_confirmation" placeholder="Confirm Password" v-model="new_password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" required>
                            <div class="my-5" style="border-top: 1px solid #262626"></div>
                            <div  class="text-center">
                                <button class="btn text-white bg-fifth text-center mb-5 w-50 rounded-pill">Change Password</button>
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

Validator.extend('verify_password', {
    validate: value => {
        var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])");
        return strongRegex.test(value);
    },
    getMessage: 'The password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number'
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
                        className: "p-4 notification bg-primary",
                        keepOnHover: true
                    })
                    this.sleep(2000).then(() => {
                        window.location.href = '/login';
                    })
                }
            }).catch(err => {
                this.disable = false
                this.backend_errors = err.response.data.errors
                console.log(err)
            })
        },
        sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    }
}
</script>
