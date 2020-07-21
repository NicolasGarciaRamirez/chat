<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalEditPassword" aria-hidden="true" id="ModalEditPassword">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-5 pb-5">
                        <div class="alert bg-fifth text-white" v-if="errors_backend != null">
                            <ul v-for="(error, index) in errors_backend" :key="index">
                                <li>{{error}}</li>
                            </ul>
                        </div>
                        <form @submit.prevent="getLogin">
                            <div class="d-flex flex-column align-items-center">
                                <span>{{ errors.first('current_password') }}</span>
                                <input type="password" class="form-control w-75" name="current_pasword" placeholder="Confirm Current Password"  v-model="current_password" v-validate="'required|verify_password'" required>
                                <span>{{ errors.first('new_password') }}</span>
                                <input type="password" class="form-control my-3 w-75" name="password" placeholder="New Password" v-model="new_password" v-validate="'required|verify_password'" ref="password" required>
                                <span>{{ errors.first('password_confirmation') }}</span>
                                <input type="password" class="form-control w-75" name="password_confirmation" placeholder="Confirm Password" v-model="new_password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="password" required>
                            </div>
                            <div class="my-5" style="border-top: 1px solid #262626"></div>
                            <div class="text-center">
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
    </section>
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
export default {
    props:['user'],
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
            })
        },
        update(){
            axios.post(`/User/Settings/Update/${this.user.username}`, this.user).then(res => {
                if (res.data.updated) {
                    this.disable = false
                    this.$toasted.show('Chnge Password Succesfull', {
                        position: "bottom-right",
                        duration : 4000,
                        className: "p-4 notification bg-primary",
                        keepOnHover: true
                    })
                    $('#ModalEditPassword').modal('toggle')
                }
            }).catch(err => {
                this.disable = false
                alert('Error')
                console.log(err)
            })
        }
    }
}
</script>
