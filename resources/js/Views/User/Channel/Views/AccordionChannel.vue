<template>
    <div class="container-fluid p-0" ref="AccordionChannel">
        <form @submit.prevent="save" enctype="multipart/form-data">
            <div class="accordion" id="AccordionChannel">
                <div class="card">
                    <div class="card-header" data-target="whySupport" >
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold"> Why Support Channel? <small>(Contributors Only)</small> <span class="c-fifth">*</span> </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="whySupport" class="card-body">
                        <div class="" v-if="user.subscription_type === 'FREE'">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor</button>
                            <p class="text-white">Become a contributor and start earning money from your supporters today!</p>
                        </div>
                        <div class="" v-else>
                            <textarea class="form-control p-3 detected-change" cols="160" rows="10" placeholder="Give users a reason to support your channel financially... What value do you add?" v-model="channel_information.why_support"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" data-target="monthlyGoal">
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                Edit Monthly Goal <small>(Contributors Only)</small> <span class="c-fifth">*</span>
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="monthlyGoal" class="card-body">
                        <div  v-if="user.subscription_type === 'FREE'">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor </button>
                            <p class="text-white">Become a contributor and start earning money from your supporters today!</p>
                        </div>
                        <div class="" v-else>
                            <div class="d-flex flex-row">
                                <h4 class="font-weight-bold mx-2 mt-2">$</h4>
                                <input class="form-control detected-change mb-3" placeholder="0.00" style="width: 10rem" v-model="channel_information.monthly_goal_last.monthly_goal">
                            </div>
                            <span>Current total earnings from supporters = <span class="c-seven font-weight-bold"> $ {{channel_information ?channel_information.monthly_goal_last.current_earnings : 0}}</span></span>
                            <div class="text-center d-flex flex-column font-weight-bold mb-2 mt-4">
                                Monthly Goal
                                <div class="d-flex flex-row justify-content-center">
                                    <span class="c-seven font-weight-bold">$ {{channel_information ? channel_information.monthly_goal_last.current_earnings : 0 }}</span>
                                    <div class="bg-fourth progress m-2" style="height: 4px;margin: 0.65rem 0.5rem !important;">
                                        <div class="progress-bar bg-fifth" role="progressbar" :style="'width:'+channel_information.monthly_goal_last.percentage_completed+'%'" :aria-valuenow="channel_information.monthly_goal_last.percentage_completed" aria-valuemin="0" aria-valuemax="100">
                                            <div class="line-monthly-goal"></div>
                                        </div>
                                    </div>
                                    <span class="text-white font-weight-bold">$ {{ channel_information.monthly_goal_last.monthly_goal}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"  data-target="tiers" >
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                Edit Tiers <small>(Contributors Only)</small>
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                    <div id="tiers" class="card-body">
                        <div  v-if="user.subscription_type === 'FREE'">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor </button>
                            <p class="text-white">Become a contributor and start earning money from your supporters today!</p>
                        </div>
                        <div v-else>
                            <button type="button" class="btn btn-outline-light rounded-pill mb-3" @click="addedTier">
                                Add Tier
                                <svg class="icon-sm ml-2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor; margin-bottom: 4px;" xml:space="preserve"> <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M17.7,12.7h-5v5c0,0.4-0.3,0.7-0.7,0.7 s-0.7-0.3-0.7-0.7v-5h-5c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7h5v-5c0-0.4,0.3-0.7,0.7-0.7s0.7,0.3,0.7,0.7v5h5 c0.4,0,0.7,0.3,0.7,0.7C18.5,12.4,18.1,12.7,17.7,12.7z"/> </svg>
                            </button>
                            <div>
                                <single-tier class="ml-2 " v-for="(tier, index) in channel_information.tiers" :key="index" :index="index" :tier="tier"></single-tier>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" >
                    <div class="card-header" @click="showModalRelathions('Supports')" >
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Supporters <small>(Contributors Only)</small>
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" @click="showModalRelathions('Rewards')">
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Rewards <small>(Contributors Only)</small>
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div class="card" >
                    <div class="card-header" @click="showModalRelathions('Followers')">
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold" >
                                View Followers
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div class="card" >
                    <div class="card-header" @click="showModalRelathions('Supporting')">
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Supporting
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div class="card" @click="showModalRelathions('Rewarding')">
                    <div class="card-header" >
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Rewarded
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" @click="showModalRelathions('Following')">
                        <div>
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Following
                            </button>
                            <svg  class="icon-m float-right caret" version="1.1" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M22.8,7.4l-1.7-1.6c-0.3-0.2-0.7-0.2-0.9,0l-7.7,7.4c-0.3,0.2-0.7,0.2-0.9,0L3.8,5.8 c-0.3-0.2-0.7-0.2-0.9,0L1.2,7.4c-0.3,0.3-0.3,0.7,0,1l10.3,9.9c0.3,0.2,0.7,0.2,0.9,0l10.3-9.9C23.1,8.1,23.1,7.6,22.8,7.4z"/> </svg>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center text-center m-5">
                    <button class="btn rounded-pill text-white font-weight-bold" @click="reload">Cancel</button>
                    <button type="submit" class="btn rounded-pill text-white bg-fifth font-weight-bold" v-if="!disable">Save</button>
                    <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </form>
        <modal-contributor />
        <modal-comming-contributor />
    </div>
</template>

<script>
import ModalContributor from "../../../CommingSoon/Components/ModalContributor";
import ModalCommingContributor from '../../../CommingSoon/Components/ModalContributor'
import SingleTier from "../Components/Activities/SingleTier";
import Auth from "../../../../helpers/Auth";
import Functionality from "../../../../helpers/Functionality";
export default {
    props:['user'],
    components: {
        SingleTier,
        ModalContributor,
        ModalCommingContributor,
    },
    data(){
        return {
            disable: false,
            url: '',
            state_collapse: 'close',
            channel_information: {
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
            },
        }
    },
    mounted(){
        Auth.initialize()
        this.initializeVariables()
        Functionality.accordion('#AccordionChannel')
        if(!this.user.channel_information && this.user.subscription_type === 'CONTRIBUTOR'){
            this.showAlertChange()
        }
    },
    methods: {
        getChanges(){
            let fields = [
                ".detected-change"
            ]

            fields.forEach(field => {
                $(field).on('change', (e) => {
                    this.showAlertChange(e)
                })
            });
        },
        showAlertChange(e){
            if(this.detectedChange){ return true }

            this.detectedChange = true

            this.$toasted.show('You have made unsaved changes', {
                duration : 8000000,
                className: "notification",
                keepOnHover: true,
                position: 'bottom-right',
                fullWidth : true,
                singleton:true,
                action: [
                    {
                        text:'Cancel',
                        class: 'button-cancel',
                        onClick:(e, toast) => {
                            this.detectedChange = false
                            location.reload()
                            toast.goAway(0);
                        }
                    },
                    {
                        text:'Save',
                        class: 'button-save',
                        onClick:(e, toast) => {
                            this.detectedChange = false
                            this.save()
                            toast.goAway(0);
                        }
                    }
                ],
                onComplete: function () {
                    $('.toasted-container ')
                }
            })
        },
        reload(){
            window.location.replace(`/${Auth.state.username}/Channel/Activity`)
        },
        showModalRelathions(type){
            let self = this
            if (type === 'Following' || type === 'Followers'){
                this.$root.$refs.modalRelathion.type_table = type
                $('#ModalRelathions').modal('show')
            }else if(this.user.subscription_type === 'CONTRIBUTOR' && type === 'Supports' ||this.user.subscription_type === 'CONTRIBUTOR' && type === 'Rewards' || this.user.subscription_type === 'CONTRIBUTOR' && type === 'Supporting' || this.user.subscription_type === 'CONTRIBUTOR' && type === 'Rewarding'){
                this.$root.$refs.modalRelathion.type_table = type
                $('#ModalRelathions').modal('show')
            }else if(this.user.subscription_type === 'FREE'){
                swal({
                    text: 'You need to be a Contributor to access this!!',
                    className: 'swal-alert',
                    buttons:['Cancel','Become a Contributor'],
                    dangerMode: true
                }).then((willDelete) => {
                    if(willDelete){
                        self.showModalContributor()
                    }
                })
                $('.swal-footer').addClass('text-center')
            }
        },
        showModalContributor(){
            window.location.replace('/Register')
        },
        addedTier(){
            this.channel_information.tiers.push({
                id: null,
                name:'',
                amount: '',
                description:'',
            })
        },
        async save(){
            if(Auth.state.username){
                await Auth.setSession()
                this.disable = true
                if(!this.validateData()){
                    this.disable = false
                    swal({
                        text: 'Please fill out the fields marked with (*)',
                        className: 'swal-alert',
                        buttons: {
                            cancel: false,
                            confirm: 'Ok'
                        },
                        dangerMode: true,
                    })
                    $('.swal-footer').addClass('text-center')
                    return false
                }
                axios.post(this.url, this.channel_information).then(res =>{
                    if(res.data.saved || res.data.updated){
                        this.$toasted.show('Your channel information has been updated successfully!', {
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
                        window.location.replace(`/${Auth.state.username}/Channel/Activity`)
                        this.disable = false
                    }else{
                        this.disable = false
                    }
                }).catch(err =>{
                    console.log(err)
                    this.disable = false
                    Auth.keepLogged(err.response.status)
                })
            }else{
                $('#modalLogin').modal('show')
            }
        },
        initializeVariables(){
            this.url = `/${Auth.state.username}/Channel/Information/save`
            if(this.user.channel_information){
                this.channel_information = this.user.channel_information
                if(!this.user.channel_information.monthly_goal_last){
                    this.channel_information.monthly_goal_last = {
                        monthly_goal: 0,
                        current_earnings: 0
                    }
                }
                this.url = `/${Auth.state.username}/Channel/Information/update`
            }
            this.getChanges()
        },
        validateData(){
            let validate = false
            if(this.channel_information.monthly_goal === '') return validate = false
            if(this.channel_information.why_support === '') return validate = false
            if(this.channel_information.tiers.length > 0){
                this.channel_information.tiers.map(tier =>{
                    if(tier.name === '' || tier.description === '' || tier.amount === '') {
                        swal({
                            text: 'Please fill out the fields marked with (*) to add the tier',
                            className: 'swal-alert',
                            buttons: {
                                cancel: false,
                                confirm: 'Ok'
                            },
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                        validate = false
                    }else{
                        validate = true
                    }
                })
            }else{
                validate = true
            }
            return validate;
        },
    }
}
</script>
<style lang="scss" scoped>
    i{
        transition: all linear .3s;
        &.active{
            transform: rotate(180deg) !important;
        }
    }
</style>
