<template>
    <div class="modal fade modal-share" tabindex="-1" role="dialog" aria-labelledby="ModalShareProfile" aria-hidden="true" id="ModalShareProfile">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content modal-border-white p-3 mx-auto" style="max-width: 650px;">
                <div class="modal-header border-0">
                    <div class="w-100 text-center">
                        <button type="button" class="close p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div>
                            <h3><b>Share</b></h3>
                        </div>
                    </div>
                </div>
                <div class="modal-body p-1">
                    <textarea class="form-control mb-3" cols="30" rows="10" v-model="data"></textarea>
                    <div class="divider w-100"></div>
                    <div class="content-icons">
                        <div>
                            <ShareNetwork
                                network="facebook"
                                :url="`https://www.noisesharks.com/${user.username}/Profile`"
                                :title="''"
                                :description="data">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M9.9,23h2.6c0.6,0,1.1-0.5,1.1-1.1V13c0-0.6,0.5-1.1,1.1-1.1h1.2c0.6,0,1-0.4,1.1-1c0.1-0.4,0.1-0.9,0.2-1.4 c0.1-0.7-0.4-1.3-1.1-1.3h-1.2c-0.6,0-1.1-0.5-1.1-1.1V5.7c0.1-0.5,0.5-0.9,1.1-0.9h1.5c0.6,0,1.1-0.5,1.1-1.1V2.1 C17.5,1.5,17,1,16.4,1h-2.4C8.9,1,9,4.7,9,5.3v1.9c0,0.6-0.5,1.1-1.1,1.1H7.6C7,8.3,6.5,8.8,6.5,9.4v1.3c0,0.6,0.5,1.1,1.1,1.1h0 c0.6,0,1.1,0.5,1.1,1.1v8.8C8.8,22.5,9.3,23,9.9,23z"/> </svg>
                            </ShareNetwork>
                            <span> Facebook </span>
                        </div>
                        <div>
                            <ShareNetwork
                                network="twitter"
                                :url="`https://www.noisesharks.com/${user.username}/Profile`"
                                :title="''"
                                :description="data">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M22.4,5.2c-0.1,0-0.2,0.1-0.3,0.1c-0.7,0.2-0.7-0.1-0.2-0.6C22,4.5,22.2,4.3,22.4,4c0.4-0.6,0-0.8-0.6-0.6 c-0.2,0.1-0.5,0.2-0.7,0.3c-0.6,0.2-1.6-0.1-2.1-0.5c-0.7-0.5-1.6-0.7-2.5-0.7c-1.3,0-2.4,0.5-3.3,1.4c-0.9,0.9-1.4,2.1-1.4,3.4 c0,0.2,0,0.4,0,0.6c0,0.3-0.5,0.5-1.1,0.4C9.2,8.1,7.8,7.6,6.5,6.9C5.2,6.2,4,5.4,3,4.3C2.5,3.8,1.9,3.9,1.7,4.5 C1.6,4.9,1.5,5.4,1.5,5.8c0,0.8,0.2,1.6,0.6,2.3C2.3,8.4,2.5,8.7,2.8,9c0.4,0.5,0.4,0.8-0.2,0.6c-0.6-0.2-1-0.4-1-0.4s0,0,0,0 c0,1.2,0.4,2.2,1.1,3.1c0.4,0.5,0.9,1,1.5,1.2C4.7,13.8,5,14,4.7,14.1c-0.2,0-0.4,0-0.6,0c-0.1,0-0.3,0-0.4,0 c-0.2,0-0.3,0.5,0.1,1.1C4,15.6,4.4,16,4.8,16.4c0.5,0.4,1,0.6,1.5,0.8c0.7,0.2,0.8,0.5,0.2,0.9c-1.5,0.9-3.1,1.3-4.8,1.3 c-0.2,0-0.4,0-0.6,0c-0.3,0-0.1,0.3,0.5,0.6c1.9,1,3.9,1.5,6.1,1.5c1.7,0,3.2-0.3,4.7-0.8c1.5-0.5,2.7-1.3,3.8-2.2 c1-0.9,1.9-1.9,2.7-3.1c0.8-1.2,1.3-2.4,1.7-3.7c0.4-1.3,0.6-2.6,0.6-3.9c0-0.1,0-0.2,0-0.3c0-0.2,0.4-0.6,0.9-1.1 c0.2-0.2,0.4-0.4,0.6-0.7C23.2,5.2,23,5,22.4,5.2z"/> </svg>
                            </ShareNetwork>
                            <span> Twitter </span>
                        </div>
                        <div>
                            <ShareNetwork
                                network="whatsapp"
                                :url="`https://www.noisesharks.com/${user.username}/Profile`"
                                :title="''"
                                :description="data">
                                <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M19.9,4.1c-2-2-4.6-3.1-7.5-3.1S7,2.1,5,4.1s-3.1,4.6-3.1,7.5c0,1.8,0.5,3.5,1.3,5.1L1,23l6.4-2.2 c1.6,0.9,3.3,1.3,5.1,1.3c2.8,0,5.5-1.1,7.5-3.1c2-2,3.1-4.6,3.1-7.5S21.9,6.1,19.9,4.1z M17.7,15.5l-1.2,1.2 c-1,1-3.9-0.2-6.4-2.7c-2.5-2.5-3.7-5.4-2.7-6.4l1.2-1.2c0.3-0.3,0.7-0.3,0.9,0L11,7.8c0.3,0.3,0.3,0.7,0,0.9l-0.9,0.9 c0.9,1.9,2.4,3.4,4.3,4.3l0.9-0.9c0.3-0.3,0.7-0.3,0.9,0l1.5,1.5C17.9,14.8,17.9,15.2,17.7,15.5z"/> </svg>
                            </ShareNetwork>
                            <span> Whatsapp </span>
                        </div>
                        <div>
                            <ShareNetwork
                                network="telegram"
                                :url="`https://www.noisesharks.com/${user.username}/Profile`"
                                :title="''"
                                :description="data">
                                <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M6.3,13.5L9,20.4l3.6-3.6l6.1,4.9L23,2.3L1,11.5L6.3,13.5z M16.7,7.9L10,14l-0.8,3.2l-1.5-3.9L16.7,7.9z"/> </svg>
                            </ShareNetwork>
                            <span> Telegram </span>
                        </div>
                        <div>
                            <ShareNetwork
                                network="email"
                                :url="`https://www.noisesharks.com/${user.username}/Profile`"
                                :title="''"
                                :description="data">
                                <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M10.9,11.9c0.6,0.4,1.6,0.4,2.2,0c0,0,0,0,0,0l9.8-6.5c-0.3-0.9-1.2-1.6-2.2-1.6H3.4c-1,0-1.9,0.7-2.2,1.6 L10.9,11.9C10.9,11.9,10.9,11.9,10.9,11.9L10.9,11.9z"/> <path d="M13.8,13C13.8,13,13.8,13,13.8,13c-0.5,0.3-1.1,0.5-1.8,0.5c-0.6,0-1.3-0.2-1.8-0.5c0,0,0,0,0,0L1,6.8v11 c0,1.3,1.1,2.4,2.4,2.4h17.3c1.3,0,2.4-1.1,2.4-2.4v-11L13.8,13z"/> </svg>
                            </ShareNetwork>
                            <span> Email </span>
                        </div>
                    </div>
                    <form class="fild-comment">
                        <input type="text" :id="`sharedProfile${user.token}`" :value="`https://www.noisesharks.com/${user.username}/Profile`" class="form-control">
                        <label @click="copyLink">
                            Copy
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from '../../../../../helpers/Auth'
    export default {
        name: "ModalShareProfile",
        props:['user'],
        mounted(){
            Auth.initialize()
        },
        computed:{
            data(){
                let typeUser = this.$parent.user.subscription_type
                let data = ''
                data += (typeUser == 'FREE') ? 'Follow ' : 'Support '

                if(this.$parent.user.username == Auth.state.username){
                    // 1ra persona
                    let url = window.location.href.split('/')
                    if( url.pop().substr(0, 4) == 'Prof'){
                        // 3ra persona -> profile
                        data += this.user.artistic_name
                    }else{
                        // 1ra persona -> edit
                        data += this.user.channel_information.why_support
                    }
                    data += ' on Noisesharks!'
                }else{
                    // 3ra persona
                    data += `${this.user.artistic_name} on Noisesharks!`
                }
                return data
            }
        },
        methods:{
            copyLink(){
                let copyText = document.getElementById("sharedProfile"+this.user.token);
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");

                this.$toasted.show('Link copied successfully!', {
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
            }
        }
    }
</script>
