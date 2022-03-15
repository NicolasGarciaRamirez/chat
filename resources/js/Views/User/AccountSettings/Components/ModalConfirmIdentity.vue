<template>
    <div class="modal fade modal-login" role="dialog" id="modalConfirmIdentity">
        <div class="modal-dialog modal-dialog-centered " role="document" style="width: 400px">
            <div class="modal-content modal-border-white">
                <div class="modal-body p-3">
                    <div class="d-flex flex-column justify-content-between">
                        <div class="d-flex flex-column px-5 py-3" v-if="!validate_password">
                            <form @submit.prevent="validIndentity">
                                <div class="cross-center">
                                    <h5 class="text-center font-weight-bold">Confirm Identity</h5>
                                </div>
                                <div class="cross-center">
                                    Please Confirm Password To Continue:
                                </div>
                                <div class="d-flex flex-column justify-content-center align-items-center px-2">
                                    <input type="password" class="form-control my-3"  autocomplete="false" placeholder="Type Password..." @keyboard.enter="validIndentity" v-model="password" required>
                                    <span :class="validate_password ? 'my-3 c-seven' : 'c-fifth my-3' " v-if="message">
                                        {{message}}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-end align-items-end px-2">
                                    <a class="forgot-password font-weight-bold" @click="showModalForgotPassword">Forgot Password?</a>
                                </div>
                                <div class="d-flex mt-3">
                                    <div style="border-top: 1px solid #303030; width: 100%;"></div>
                                </div>
                                <div class="text-right my-3">
                                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                    <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="submit" v-if="!disable" :disabled="password === null">Confirm Identity</button>
                                    <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex flex-column justify-content-center" v-if="validate_password">
                            <div class="cross-center">
                                <h5 class="text-center c-seven font-weight-bold mb-3">Identity Confirmed!</h5>
                            </div>
                            <div class="cross-center">
                                Delete Account?
                            </div>
                            <div class="d-flex mt-3">
                                <div class="divider"></div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center my-0">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn rounded-pill text-white bg-fifth font-weight-bold" @click="action(type)">{{type}} Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from "../../../../helpers/Auth";

    export default {
        name: "ModalConfirmIdentity",
        props:['user'],
        data(){
            return {
                password: null,
                disable: false,
                validate_password: false,
                message: '',
                type: ''
            }
        },
        mounted() {
            Auth.initialize()
        },
        methods:{
            async action(type){
                axios.post(`/User/AccountSettings/Action/${type}/${this.user.username}`).then(res =>{
                    if(res.data.action){
                        this.$toasted.show(`Account ${type} Successfully!`, {
                            position: "bottom-right",
                            duration : 4000,
                            className: "notification",
                            keepOnHover: true,
                            action: {
                                text:'x',
                                onClick:(e, toast) => {
                                    toast.goAway(0);
                                }
                            }
                        })
                        Auth.logout()
                    }
                }).catch(err =>{
                    if(err) Auth.keepLogged(err.response.status)
                })
            },
            async validIndentity(){
                await Auth.setSession()
                this.disabled = true
                let user = {
                    email: this.user.email,
                    password: this.password
                }
                await axios.post('/login', user ).then(res=>{
                    if (res.data.auth) {
                        this.disabled = false
                        this.validate_password = true
                        this.message = "The credentials the credentials are correct"
                    }this.disabled = false
                }).catch(err=>{
                    this.disabled = false
                    this.validate_password = false
                    this.message = "The credentials do not match"
                })
            },
            showModalForgotPassword(){
                $('#ModalForgotPassword').modal('show')
            }
        }
    }
</script>

<style scoped>

</style>
