<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalEditAccount" aria-hidden="true" id="ModalEditAccount">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center p-5">

                        <form @submit.prevent="update">
                            <div class="d-flex flex-column px-4">
                                <label class="c-fourth text-center">Account Type : <b class="c-fifth">{{ user.subscription_type }}</b></label>
                                <div class="d-flex-flex-column text-center my-4">
                                    <button class="bg-fifth text-white font-weight-bold border-0 rounded-pill mb-4">Become A Contributor</button>
                                    <p class="text-white justify-content-center">
                                        It’s <b>FREE</b>!!
                                        you only start paying when you start
                                        earining money from your supporters
                                    </p>
                                </div>
                                <div style="border-top: 1px solid #262626"></div>
                                <div class="d-flex flex-column my-3">
                                    <div v-if="message != null">
                                        <h5 :class="!disable_email ? 'alert alert-success' : 'alert alert-info'  ">{{ message }}</h5>
                                    </div>
                                    <input type="password" class="form-control  my-3" placeholder="Current Password" v-model="current_password" required>
                                    <label class="font-weight-bold">Email Addres:</label>
                                    <input type="text" class="form-control" placeholder="Email Address" v-model="user.email" :disabled="disable_email" required>
                                </div>
                                <div style="border-top: 1px solid #262626"></div>
                                <div class="text-center my-3">
                                    <button type="button" class="bg-primary border-0 rounded-pill" data-dismiss="modal">Cancel</button>
                                    <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="submit">{{ validate_password ? 'Update Email' : 'Check Password' }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props:['user'],
    data(){
        return{
            disable_email: true,
            current_password:'',
            errors_backend: null,
            message: "we need to verify your credentials before updating your email",
            validate_password: false
        }
    },
    methods: {
        async login(){
            this.message = "Checking your credentials, wait a moment please"
            var user = {
                email: this.user.email,
                password: this.current_password
            }
            await axios.post('/login', user ).then(res=>{
                if (res.data.auth) {
                    this.message = "your credentials are correct, please continue to update your email address"
                    this.validate_password = true
                    this.disable_email = false
                }
            }).catch(err=>{
                this.validate_password = false
                this.message = "Your credentials not match"
            })
        },
        async update(){
            if(!this.validate_password){
                await this.login()
                return false
            }
            await axios.post(`/User/Settings/Update/${this.user.username}`, this.user).then(res =>{
                if (res.data.updated) {
                    this.disable_email = true
                    this.current_password = ''
                    this.$toasted.show('The account information has been updated successfully!', {
                        position: "bottom-right",
                        duration : 4000,
                        className: "p-4 notification bg-primary",
                        keepOnHover: true
                    })
                }
            }).catch(err =>{
                alert('Error')
                console.log(err)
            })
        }
    },
}
</script>
