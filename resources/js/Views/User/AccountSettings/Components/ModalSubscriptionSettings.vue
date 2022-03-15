<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalEditSubscriptionSettings">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close"  aria-label="Close" @click="dismisModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4 justify-content-center px-5 pb-5">
                        <div v-if="state_idle">
                            <div class="d-flex flex-row justify-content-center">
                                <span class="mx-2 c-fourth">Payment Method</span><span>****{{user.card_last_four}} {{user.card_brand}}</span>
                            </div>
                            <div class="d-flex justify-content-center my-3">
                                <button type="button" class="border-white font-weight-bold text-white action" @click="changePaymentMethod()">Change Payment Method</button>
                            </div>
                        </div>
                        <div v-if="state_verification">
                            <span class="text-white font-weight-bold">Please Confirm Password To Continue:</span>
                            <div class="d-flex flex-column justify-content-center my-3">
                                <div class="d-flex my-3">
                                    <input type="password" class="form-control" placeholder="Type Password..."  autocomplete="false" v-model="current_password">
                                </div>
                                <span class="c-fifth my-1">{{message}}</span>
                                <div class="text-center">
                                    <button class="btn rounded-pill text-white bg-fifth" @click="login">Confirm Identity</button>
                                </div>
                            </div>
                        </div>
                        <div v-if="state_update">
                            <form @submit.prevent="update">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-column">
                                        <label class="text-white font-weight-bold">Name on Account :</label>
                                        <input type="text" class="form-control" placeholder="Name on Account" v-model="user.artistic_name"/>
                                    </div>
                                    <div class="d-flex flex-column my-3">
                                        <label class="text-white font-weight-bold" >Sort Code :</label>
                                        <input type="text" class="form-control" placeholder="xxx"/>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <label class="text-white font-weight-bold">Account Number :</label>
                                        <input type="text" class="form-control" placeholder="xxxx-xxxx-xxxx" v-model="user.card_last_four"/>
                                    </div>
                                    <div class="my-3 d-flex flex-row justify-content-center">
                                        <button class="btn rounded-pill text-white bg-fifth" @click="update">Update</button>
                                        <button type="button" class="btn rounded-pill text-white bg-primary" @click="dismisModal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../../helpers/Auth";

    export default {
        name: "ModalSubscriptionSettings",
        props: ['user'],
        data(){
            return {
                state_idle: true,
                state_verification: false,
                state_update: false,
                message: '',
                current_password: ''
            }
        },
        methods:{
            changePaymentMethod(){
                this.state_idle = false
                this.state_verification = true
                this.state_update = false
            },
            async login(){
                let user = {
                    email: this.user.email,
                    password: this.current_password
                }
                await axios.post('/login', user ).then(res=>{
                    if (res.data.auth) {
                        this.state_update = true
                        this.state_verification = false
                        this.state_idle = false
                    }
                }).catch(err=>{
                    this.message = "The credentials do not match"
                    Auth.keepLogged(err.response.status)
                })
            },
            async update(){
                await axios.post('')
            },
            dismisModal(){
                this.state_idle = true
                this.state_update = false
                this.state_verification = false
                this.current_password = ''
                $('#ModalEditSubscriptionSettings').modal('toggle')
            }

        }
    }
</script>
