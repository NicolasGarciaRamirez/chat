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
                    <h5 class="font-weight-bold text-white text-center">Password Reset</h5>
                 
                    <form @submit.prevent="sendEmailForgotPassword" v-if="view_form">
                        <div class="d-flex flex-column">
                            <input type="password" class="form-control my-3" placeholder="Type New Password" v-model="new_password" />
                            <input type="password" class="form-control" placeholder="Type Confirm New Password" v-model="new_password_confirmation" />
                            <div class="my-5" style="border-top: 1px solid #262626"></div>
                            <div  class="text-center">
                                <button class="btn text-white bg-fifth text-center my-5 w-50 rounded-pill">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            disable: false,
            new_password: '',
            new_password_confirmation: '',
            errors_backend: null
        }
    },
    methods:{
        update(){
            this.user.password = this.new_password_confirmation
            axios.post(`/User/Settings/Update/${this.user.username}`, this.user).then(res => {
                if (res.data.updated) {
                    this.disable = false
                    this.$toasted.show('Chnge Password Succesfull', {
                        position: "bottom-right", 
                        duration : 4000,
                        className: "p-4 notification bg-primary",
                        keepOnHover: true
                    })
                    $('#ModalLogin').modal('show')
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
