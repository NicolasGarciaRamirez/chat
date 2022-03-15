<template>
    <div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="ModalFormInvite" aria-hidden="true" data-backdrop="static" id="ModalFormInvite">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body border-0 pt-0 form-invite">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <form @submit.prevent="sendEmail" autocomplete="off" class="text-center my-0">
                            <h4 class="mb-2"><b>Apply for an invitation</b></h4>
                            <div class="mb-4"><span>🤝 Let’s change the music industry together!</span></div>
                            <div class="d-flex flex-row justify-content-center align-items-center">
                                <input class="form-control mb-3 mr-2" placeholder="First Name" v-model="user_invite.first_name"/>
                                <input class="form-control mb-3" placeholder="last Name" v-model="user_invite.last_name"/>
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <input class="form-control mb-3" placeholder="Email Address" v-model="user_invite.email_address"/>
                                <input class="form-control mb-3" placeholder="Confirm Email Address" v-model="user_invite.email_address_confirmation"/>
                                <div class="form-group mb-3 w-100">
                                    <div class="input-group input-group-outline">
                                        <input type="number" class="form-control mb-3" min="0" placeholder="Mobile Number" v-model="user_invite.movile_number"/>
                                        <div class="divider-vertical"></div>
                                        <a class="ctn" href="#">
                                            <div class="dropdown dropdown-sm m-0">
                                                <div class="dropdown-btn m-0 " id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span>{{ code_name_movile }} ({{ code_number_movile }})</span>
                                                    <div class="icon">
                                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="dropdown">
                                                    <div class="dropdown-item" @click="code_number_movile = code.number, code_name_movile = code.name" v-for="(code, index) in codes" :key="index">
                                                        {{code.name}}({{code.number}})
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <textarea rows="5" class="form-control mb-3 border-radius" placeholder="What did you like about Noisesharks the most at first glimpse?" v-model="user_invite.what_like_noisesharks"></textarea>
                                <textarea rows="5" class="form-control mb-3 border-radius" placeholder="How did you find out about Noisesharks?" v-model="user_invite.how_did_noisesharks"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn rounded-pill btn-bg-degrad w-14rem">Get an invitation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MovileCodes from "../../../helpers/MovileCodes";
    export default {
        name: "ModalFormInvite",
        data(){
            return {
                user_invite:{
                    first_name: '',
                    last_name: '',
                    email_address: '',
                    confirm_email_address:'',
                    movile_number: '',
                    what_like_noisesharks: '',
                    how_did_noisesharks: ''
                },
                code_number_movile: '+57',
                code_name_movile: 'CO'
            }
        },
        computed:{
            codes(){
                return MovileCodes.codes
            }
        },
        methods:{
            sendEmail(){
                this.user_invite.movile_number = this.code_number_movile + this.user_invite.movile_number
                axios.post('/Email/Send/Invitation', this.user_invite).then(res=>{
                    if(res.data.send){
                        $('#ModalSuccessMail').modal('show')
                        $('#ModalFormInvite').modal('hide')
                    }else{
                        swal('error','Error', 'error')
                    }
                }).catch(err =>{
                    swal('error',err.errors.message, 'error')
                })
            }
        }
    }
</script>

<style lang="scss">
    .form-invite .input-group-outline{
        z-index: 10;
        .dropdown-btn{
            border: none !important; 
            .icon{
                margin-left: .5rem !important;
                &::after{
                    left: 100%;
                    right: -10px !important;
                    width: 2px !important;
                    height: 90% !important;
                }
            }
        }
        input{
            margin-bottom: 0 !important;
            border: none !important;
            background-color: var(--third-color) !important;
            z-index: -1;
            padding-left: 8.5rem !important;
            padding-right: .5rem !important;
        }
        .divider-vertical,
        .ctn{
            z-index: 5;
        }
        .ctn{
            left: 0;
            width: max-content;
        }
        .divider-vertical,
        {
            display: none;
        }
    }
</style>
