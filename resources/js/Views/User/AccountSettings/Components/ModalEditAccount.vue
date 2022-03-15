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
                    <div class="modal-body justify-content-center py-0 px-4">
                        <form @submit.prevent="update" v-if="!summary_subscription">
                            <div class="d-flex flex-column px-4">
                            <h4 class="mb-3 font-weight-bold text-center">Account Overview</h4>
                                <div v-if="message != null">
                                    <h6 :class="!disable_email ? 'alert alert-success' : 'alert'  ">{{ message }}</h6>
                                </div>
                                <label class="c-fourth text-center mb-3">Account Type: <b class="c-fifth">{{ user.subscription_type }}</b></label>
                                <div class="d-flex-flex-column text-center" v-if="user.subscription_type === 'FREE'">
                                    <button type="button" class="btn bg-fifth text-white font-weight-bold border-0 rounded-pill mb-3" @click="redirectRegister()">
                                        Become a Contributor
                                    </button>
                                    <p class="text-white justify-content-center">
                                        For only 15% of your earnings, you can unlock the <strong>SUPPORT</strong> and <strong>REWARD</strong> buttons and start earning from your music-content!
                                    </p>
                                </div>
                                <!-- <div class="d-flex-flex-column text-center mb-3" v-if="user.subscription_type === 'CONTRIBUTOR'">
                                    <button type="button" class="btn rounded-pill text-white bg-fifth font-weight-bold" @click="showAlertCancel">Cancel Subscription</button>
                                </div> -->
                                <div style="border-top: 1px solid #262626"></div>
                                <!-- <label class="c-fourth text-center pt-3 mb-3" v-if="user.subscription_type  === 'CONTRIBUTOR'">Contributor Mode: <b class="c-fifth">{{ user.contributor_type }} MODE</b></label>
                                <div class="d-flex-flex-column text-center mb-3" v-if="user.subscription_type === 'CONTRIBUTOR'">
                                    <button type="button" class="btn rounded-pill text-white bg-fifth font-weight-bold" @click="showAlertSwitchMode">Change Mode</button>
                                </div>
                                <div style="border-top: 1px solid #262626"></div> -->
                                <div class="d-flex flex-column mb-3">
                                    <input type="password" class="form-control  my-3" placeholder="Current Password"   autocomplete="false" v-model="current_password" required>
                                    <label class="font-weight-bold">Email Addres:</label>
                                    <input type="email" class="form-control" placeholder="Email Address" v-model="user.email" :disabled="disable_email" required>
                                </div>
                                <div style="border-top: 1px solid #262626"></div>
                                <div class="text-right my-3">
                                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                    <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="submit">{{ validate_password ? 'Update Email' : 'Check Password' }}</button>
                                </div>
                            </div>
                        </form >
                        <summary-subscription :user="user" :type="user.contributor_type === 'PERCENTAGE' ? 'Subscription' : 'Percentage'" :summary="summary" v-if="summary_subscription"></summary-subscription>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Summary from "../../../Payments/Components/Summary";
import SummarySubscription from "../../../Payments/Components/SummarySubscription";
import Auth from "../../../../helpers/Auth";
export default {
    props:['user'],
    components:{SummarySubscription, Summary},
    data(){
        return{
            summary_subscription: false,
            disable_email: true,
            current_password:'',
            errors_backend: null,
            message: "We need to verify your credentials before updating your account",
            validate_password: false
        }
    },
    computed:{
        summary(){
            return {
                amount: this.user.contributor_type === 'PERCENTAGE' ? 3 : 10,
            }
        }
    },
    methods: {
        async login(){
            this.message = "Checking your credentials, wait a moment please"
            let user = {
                email: this.user.email,
                password: this.current_password
            }
            await axios.post('/login', user ).then(res=>{
                if (res.data.auth) {
                    this.message = "Your credentials are correct, please continue to update your account"
                    this.validate_password = true
                    this.disable_email = false
                }
            }).catch(err=>{
                this.validate_password = false
                this.message = "These credentials do not match"
                Auth.keepLogged(err.response.status)
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
                    this.$parent.user = res.data.user
                    $('#ModalEditAccount').modal('toggle')
                    this.$toasted.show('Your account information has been updated successfully!', {
                        position: "bottom-right",
                        duration : 4000,
                        className: "notification",
                        keepOnHover: true
                    })
                }
            }).catch(err =>{
                alert('Error')
                console.log(err)
                Auth.keepLogged(err.response.status)
            })
        },
        async showAlertCancel(){
            if(this.validate_password){
                swal({
                    text: 'Are you sure you would like to stop being a Contributor?\n' +
                        '\n' +
                        'By going ahead you will lose all contributor rights and your earnings from your supporters! \n' +
                        '\n' +
                        'You will become a free user where you will still be able to  post content but without making it exclusive. You will also cancel your subscription. ',
                    className: 'swal-alert',
                    buttons: ['No, Stay A Contributor','Stop Being A Contributor'],
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete){
                        swal({
                            title: 'Final Warning!',
                            text: 'You are about to forfeit being a contributor, cancel all of your support earnings, removing your ability to be rewarded, and becoming a free user!\n' +
                                '\n'+
                                'Reminder: You have the option to switch your mode to Percentage Mode which doesn’t charge you a monthly fee and deducts 5% off your earnings instead! I want to know more about Percentage Mode ',
                            className: 'swal-alert',
                            buttons: ['cancel','I’m Sure I want To Stop Being A Contributor'],
                            dangerMode: true,
                        }).then((willDelete) => {
                            if(willDelete){
                                axios.post(`/User/Settings/Cancel/Subscription/${this.user.username}`).then(res =>{
                                    if(res.data.updated){
                                        this.user = res.data.user
                                        this.$parent.user = res.data.user
                                        swal({
                                            title: 'Profile Downgrade Successfull',
                                            text: 'Your profile has now been downgraded to a Free Profile and you no longer have the “Contributor” tag. Your Reward and Support buttons are now\n' +
                                                'hidden and other Noisesharks can not user them to support you financially. We have also canceled your direct debit to Noisesharks.\n' +
                                                '\n'+
                                                'We will inform your supporters about your decission and cancel their direct debits.\n' +
                                                '\n'+
                                                'We are really pleased that we had you on board and we are looking to hear your thoughts on how we can improve!\n' +
                                                'Please give us your feed back here: Go To Suggestions Page \n' +
                                                'Thank you for your time as a Contributor on Noisesharks, and always remember that the door will always open for you if you change your mind.',
                                            className: 'swal-alert',
                                            buttons: [false,'Thank you'],
                                            dangerMode: true,
                                        })
                                    }
                                }).catch(err =>{Auth.keepLogged(err.response.status)})
                            }
                        })
                    }
                })
            }
        },
        async showAlertSwitchMode(){
            if(this.validate_password){
                if(this.user.contributor_type === 'SUBSCRIPTION'){
                    swal({
                        text:'Changing from Subscription Mode to Percentage Mode means that:\n' +
                            '\n' +
                            '- You will not be paying through direct debit anymore.\n' +
                            '- You will only be charged a consistent 5% of your Supports and \n' +
                            '   Rewards.\n' +
                            '- In order to switch to Percentage Mode there is a one-off $10 joining fee.',
                        className: 'swal-alert',
                        buttons: ['Cancel','Confirm Mode Switch'],
                        dangerMode: true,
                    }).then((willDelete) =>{
                        if(willDelete){
                            this.summary_subscription = true
                        }
                    })
                }else if(this.user.contributor_type === 'PERCENTAGE'){
                    swal({
                        text:'Changing from Percentage Mode to Subscription Mode means that: \n'+
                            '- You will not pay a fixed 5% of your earnings.\n'+
                            '- You will be charged a monthly price depending on what earning range you belong to: \n'+
                            '\n'+
                            '$3/month\n' +
                            '(When earning $0 - $150) \n'+
                            '\n' +
                            '$10/month \n' +
                            '(When earning $150 - $500)\n' +
                            '\n' +
                            '$25/month\n' +
                            '(When earning $500 - $1,000)\n' +
                            '\n' +
                            '$50/month\n' +
                            '(When earning $1,000 - $2,000)\n' +
                            '\n' +
                            '$100/month\n' +
                            '(When earning $2,000 - $5000)\n' +
                            '\n' +
                            '$250/month\n' +
                            '(When earning $5,000 - $10,000)\n' +
                            '\n' +
                            '$500/month\n' +
                            '(When earning $10,000+)'
                        ,
                        className: 'swal-alert',
                        buttons: ['Cancel','Confirm Mode Switch'],
                        dangerMode: true
                    }).then((willDelete) =>{
                        if(willDelete){
                            this.summary_subscription = true
                        }
                    })
                }
            }
        },
        redirectRegister(){
            window.location.replace('/Register')
        }
    },
}
</script>
