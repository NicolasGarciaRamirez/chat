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
                                    <input type="password" class="form-control  my-3" placeholder="Current Password" v-model="current_password" @change.prevent="getLogin" >
                                    <label class="font-weight-bold">Email Addres:</label>
                                    <input type="text" class="form-control" placeholder="Email Address" v-model="user.email" :disabled="disable_email">
                                </div>
                                <div style="border-top: 1px solid #262626"></div>
                                <div class="text-center my-3">
                                    <button class="bg-primary border-0 rounded-pill" data-dissmis="modal">Cancel</button>
                                    <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="submit" v-if="!disable" :disabled="disable_email" >Save</button>
                                    <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    </button>
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
            disable: true,
            disable_email: true,
            current_password:'',
            errors_backend: null,
            message: "we need to verify your credentials before updating your email"
        }
    },
    computed:{
        getLogin: function () {
            this.Login()
        }
    },
    methods: {
        Login(){
            this.message = "Checking your credentials, wait a moment please"
            this.disable = false
            var user = {
                email: this.user.email,
                password: this.current_password
            }
            axios.post('/login', user ).then(res=>{
                if (res.data.auth) {
                    this.message = "your credentials are correct, please continue to update your email address"
                    this.disable_email = false
                    
                }
            }).catch(err=>{
                this.message = "Your credentials not match"
            })
        },
        update(){
            this.disable = true
            axios.post(`/User/Settings/Update/${this.user.username}`, this.user).then(res =>{
                if (res.data.updated) {
                    alert('Has been update Information')
                    this.disable = false
                    window.location.reload()
                }
            }).catch(err =>{
                this.disable = false
                alert('Error')
                console.log(err)
            })
        }
    },
}
</script>