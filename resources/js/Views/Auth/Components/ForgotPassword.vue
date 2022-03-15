<template>
    <div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="ModalForgotPassword" aria-hidden="true"
         id="ModalForgotPassword">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-0 px-4 text-white">
                    <h5 class="font-weight-bold text-white text-center mb-3">Forgot Password?</h5>
                    <p v-if="!message">
                        Don’t worry! Recovering your password is very easy!
                        Please type your account email and we'll send you an password recovery request!
                    </p>
                    <p calss="alert" v-if="message">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                  viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1" v-if="message">
                                <g>
                                    <g>
                                        <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                            C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                            V14.7z"/>
                                    </g>
                                </g>
                            </svg>
                            {{ message }}
                    </p>
                    <form @submit.prevent="sendEmailForgotPassword" v-if="view_form">
                        <div class="d-flex flex-column">
                            <input type="text" class="form-control my-3" placeholder="Email Address" v-model="email" />
                             <div><p class="text-center or">OR</p></div>
                            <input type="text" class="form-control" placeholder="Channel Name" v-model="artistic_name" />
                            <div  class="text-center">
                                <button class="btn text-white bg-fifth text-center my-5 w-50 rounded-pill">Send Request</button>
                            </div>
                        </div>
                    </form>
                    <div v-else>
                        We’ve sent a recovery email request to <span class="font-weight-bold">{{ email ? email : artistic_name }}</span>.
                        Please visit your email then click on the button/link provided to procceed with your password reset request.
                        <br>
                        <div class="divider mt-3 w-75"></div>
                        Didn’t recieve and email yet?
                        <br>
                        Please check your <span class="font-weight-bold">Spam</span> folder, or click on the button below!
                        <div class="text-center">
                            <button class="btn text-white bg-fifth text-center my-4 w-50 rounded-pill">Resend Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from "../../../helpers/Auth";

export default {
    data(){
        return {
            view_form: true,
            message: '',
            email: '',
            artistic_name: ''
        }
    },
    methods:{
        sendEmailForgotPassword(){
            let request = ''
            this.email ? request = { 'email' : this.email } : request = { 'artistic_name' : this.artistic_name }
            axios.post(`/ForgotPassword`, request).then(res =>{
                if (res.data.send) this.view_form = false
                this.message = res.data.message
            }).catch(err =>{Auth.keepLogged(err.response.status)})
        }
    }
}
</script>
