<template>
    <div class="modal fade modal-same-email" role="dialog" aria-labelledby="ModalInvite" aria-hidden="true" id="ModalInvite">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="border-0 pb-0">
                    <button type="button" class="close mr-2 mt-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="c-white">&times;</span>
                    </button>
                </div>
                <div class="px-3 py-0">
                    <div class="d-flex flex-column justify-content-center align-items-center py-0">
                        <h4 class="mb-3"><b>I’ve Been Invited</b></h4>

                        <div class="d-flex flex-column">
                            <div class="form-group m-0">
                            <div class="input-group input-group-outline">
                                <input class="form-control" type="text" placeholder="Paste invitation code here" autocomplete="none" v-model="code" @change="validCode()" @blur="validCode()">
                                <div class="divider-vertical"></div>
                                <a class="ctn" style="z-index: 9" @click="validCode()">
                                    APPLY
                                </a>
                            </div>
                        </div>

                            <span class="c-six font-weight-bold mt-1 mb-2" v-if="error !== ''">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="c-six icon-sm mb-1 mr-1">
                                    <g>
                                        <g>
                                            <path fill="#fc4444" d="M22.5,17.6L14.8,3.1C13.5,1,10.5,1,9.2,3.1L1.5,17.6c-1.3,2.2,0.3,4.9,2.8,4.9h15.5
                                                C22.3,22.5,23.8,19.7,22.5,17.6z M12,19.9c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                                C13.3,19.3,12.7,19.9,12,19.9z M13.3,14.7c0,0.7-0.6,1.3-1.3,1.3s-1.3-0.6-1.3-1.3V8.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3
                                                V14.7z"/>
                                        </g>
                                    </g>
                                </svg>
                                {{ error }}
                            </span>
                        </div>
                    </div>
                    <div class="divider mt-3 w-75"></div>
                    <div class="d-flex flex-column justify-content-center align-items-center mb-4 py-0 px-3">
                        <h4 class="mb-3"><b>I’ve Not Been Invited Yet</b></h4>
                        <button type="button" class="btn btn-bg-degrad rounded-pill w-14rem" @click="showModalFormInvite()">Get an invite</button>
                    </div>
<!--                    <div class="d-flex flex-column bg-third justify-content-center align-items-center p-3 my-3 border-radius">-->
<!--                        <h4 class="mb-3"><b>Skip Invitation</b></h4>-->
<!--                        <button type="button" class="btn bg-fifth rounded-pill mb-3 w-14rem" @click="replacePage('/Register/Contributor/Percentage')">Refundable $10 joining fee</button>-->
<!--                        <p class="mb-0">-->
<!--                            We will refund you your joining fee in full within 30 days if you don’t want to-->
<!--                            become a contributor anymore! just email <b>support@noisesharks.com</b>-->
<!--                        </p>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from "../../../helpers/Auth";

    export default {
        name: "ModalInvite",
        data(){
            return {
                code: '',
                error: '',
                loading: false
            }
        },
        computed:{
            user() {
                if (Auth.state.username){
                    return this.$root.$refs.modalRelathion.user
                }else{
                    return {
                        artistic_name: Auth.state.username
                    }
                }
            },
            channel_information(){
                return {
                    why_support: 'Hey there! You found your way to my channel! I work sincerely on my content aiming to add value to you, the Noisesharks community, and the music industry in general! Would really appreciate it if you help me reach my monthly goal!',
                        monthly_goal_last:{
                        current_earnings: 0,
                            monthly_goal: 150,
                            date_end: '',
                            percentage_completed: ''
                    },
                    tiers: [
                        {
                            id: null,
                            name:'Tier1',
                            amount: '1',
                            description:`By selecting this tier you will support ${this.user.artistic_name} by sending them a monthly subscription of`,
                        },
                        {
                            id: null,
                            name:'Tier2',
                            amount: '5',
                            description:`By selecting this tier you will support ${this.user.artistic_name} by sending them a monthly subscription of`,
                        },
                        {
                            id: null,
                            name:'Tier3',
                            amount: '10',
                            description:`By selecting this tier you will support ${this.user.artistic_name} by sending them a monthly subscription of`,
                        }
                    ]
                }
            },
            currency(){
                return this.$parent.currency
            }
        },
        mounted() {
            Auth.initialize()
        },
        methods:{
            showModalFormInvite(){
                $('#ModalFormInvite').modal('show')
                $('#ModalInvite').modal('hide')
            },
            replacePage(url){
                window.location.replace(url)
            },
            async validCode(){
                if(this.code !== ''){
                    if( this.code.match('r/') || this.code.match('u/') || this.code.match('ig/') || this.code.match('fb/') || this.code.match('tk/')  || this.code.match('in/')  || this.code.match('ns/') ){
                        if(Auth.state.username){
                            if(this.loading) {return false}
                            this.loading = true
                            let data = {
                                channel_information: this.channel_information
                            }
                            await axios.post(`/User/Settings/Update/Subscription/${Auth.state.username}/Percentage`, data)
                                .then(res=>{
                                    if(res.data.updated){
                                        this.loading = false
                                        this.$toasted.show('Congratulations! You’re now a contributor', {
                                            duration : 4000,
                                            className: "notification",
                                            keepOnHover: true,
                                            iconPack: 'fontawesome',
                                            action: {
                                                icon:'fa-times',
                                                onClick:(e, toast) => {
                                                    toast.goAway(0);
                                                }
                                            }
                                        })
                                        setTimeout(function(){window.location.replace('/')}, 100)
                                        // this.$root.$refs.modalStripe.invitate = true
                                        // $('#ModalStripe').modal('show')
                                    }
                                })
                                .catch(err=>{
                                    this.loading = false
                                    console.log(err)
                                })
                        }else{
                            this.loading = false
                            this.$parent.code =this.code;
                            $('#ModalInviteFormSignUp').modal('show')
                        }
                        $('#ModalInvite').modal('hide')

                    }else{
                        this.error = "This invitation code is incorrect! Please try again."
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
