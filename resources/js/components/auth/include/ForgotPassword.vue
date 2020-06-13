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
                <div class="modal-body pt-4 text-white">
                    <h5 class="font-weight-bold text-white text-center">Forgot Password?</h5>
                    <p v-if="!message">
                        Don’t worry! Recovering your password is very easy!
                        Please type your account email and send a recovery request!
                    </p>
                    <p v-if="message">
                        {{ message }}
                    </p>
                    <form @submit.prevent="sendEmailForgotPassword" v-if="view_form">
                        <div class="d-flex flex-column">
                            <input type="text" class="form-control my-3" placeholder="Email Address" v-model="email" />
                             <div><p class="text-center or">OR</p></div>
                            <input type="text" class="form-control" placeholder="Artistic Name" v-model="artistic_name" />
                            <div  class="text-center">
                                <button class="btn text-white bg-fifth text-center my-5 w-50 rounded-pill">Send Request</button>
                            </div>
                        </div>
                    </form>
                    <div v-else>
                        We’ve sent a recovery email request to <span class="font-weight-bold">{{ email ? email : artistic_name }}</span>. <br>
                        Please visit your email then click on the button/link provided to <br>
                        procceed with your password reset request. <br><br>
                        Didn’t recieve and email yet?<br>
                        Please check your <span class="font-weight-bold">Spam</span> folder, or click on the button below. 
                        <div class="text-center">
                            <button class="btn text-white bg-fifth text-center my-5 w-50 rounded-pill">Resend Request</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
            if (this.email) {
                var request = { 'email' : this.email } 
            }else{
                var request = { 'artistic_name' : this.artistic_name }
            }
            axios.post(`ForgotPassword`, request).then(res =>{
                if (res.data.send) {
                    this.view_form = false
                }
                this.message = res.data.message
            }).catch(err =>{
                console.log(err)
            })
        }
    }
}
</script>