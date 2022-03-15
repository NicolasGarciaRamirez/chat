<template>
    <section>
        <div class="modal fade modal-profile-information" role="dialog" id="ModalAlert">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0 px-4">
                        <div class="d-flex flex-column text-white">
                            <h4 class="font-weight-bold text-center c-mustard mb-3">Choose A Profile Title!</h4>
                            <p class="text-center c-fourth m3-3 ">
                                👋 Hi there! You must choose a <strong>Profile Type</strong> and <strong>Title</strong> in order for you to post your content!
                            </p>
                            <div class="divider c-fourth m3-3"></div>
                            <h6 class="font-weight-bold text-left m3-3 mb-3">Please Choose Profile Type</h6>

                            <div class="w-100 row justify-content-around mb-0">
                                <label class="check-button mb-4">
                                    <input type="radio" value="A Person or A Project" v-model="profile_information.profile_type" required>
                                    <span> <b class="ml-1">Musician/Project/Channel</b></span>
                                </label>
                                <label class="check-button mb-4">
                                    <input type="radio" value="A Band" v-model="profile_information.profile_type" required>
                                    <span> <b class="ml-1">Band/Group/Duet</b></span>
                                </label>
                            </div>
                            <h6 class="font-weight-bold text-left m3-3 mb-3">Please Choose Title</h6>
                            <div class="dropdown mb-3 dropdown-sm">
                                <div class="dropdown-btn my-0" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b> {{ profile_information.title.length ? (profile_information.title.length >= 10) ? profile_information.title.substring(0, 10) + '...' : profile_information.title: 'Please Choose Title' }} </b>
                                    <div class="icon">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdown" v-if="profile_information.profile_type == 'A Person or A Project'">
                                    <div class="dropdown-item" @click="profile_information.title = 'Talking Music Channel'">Talking Music Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Gear Channel'">Gear Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Instruments Channel'">Instruments Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Music Podcast'">Music Podcast</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Vlog Channel'">Vlog Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Composer'">Composer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Instrument Tutor'">Instrument Tutor</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Vocal Coach'">Vocal Coach</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Mixing Engineer'">Mixing Engineer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Music Producer'">Music Producer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Mastering Engineer'">Mastering Engineer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Recording Engineer'">Recording Engineer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Audio Engineer'">Audio Engineer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Sound Designer'">Sound Designer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'One Person Band'">One Person Band</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Rapper'">Rapper</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Singer'">Singer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Singer Songwriter'">Singer Songwriter</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Guitarist'">'Guitarist</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Guitar Channel'">Guitar Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Drummer'">Drummer</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Drum Channel'">Drum Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Bassist'">Bassist</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Bass Channel'">Bass Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Keyboardist'">Keyboardist</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Pianist'">Pianist</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'DJ'">DJ</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Beatmaker'">Beatmaker</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Music Studio'">Music Studio</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Manager'">Manager</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'A&R'">A&R</div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdown" v-else-if="profile_information.profile_type == 'A Band'">
                                    <div class="dropdown-item" @click="profile_information.title = 'Vlog Channel'"> Vlog Channel</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Band'">Band</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Duet'">Duet</div>
                                    <div class="dropdown-item" @click="profile_information.title = 'Orchestra'">Orchestra</div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdown" v-else>
                                    <div class="dropdown-item c-mustard"> Please choose <strong>Profile Type</strong> first!</div>
                                </div>

                            </div>
                            <div class="divider c-fourth"></div>
                            <div class="d-flex flex-row justify-content-end mb-3">
                                <button class="btn mx-2" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn rounded-pill font-weight-bold text-white bg-fifth" @click.prevent="saveProfileInformation()" v-if="!disable">Save</button>
                                <button type="button" class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    export default {
        props:['user'],
        components:{

        },
        data(){
            return {
                profile_information:{
                    profile_type:'',
                    title:'',
                },
                disable:false
            }
        },
        mounted() {
            Auth.initialize()
        },
        methods:{
            async saveProfileInformation(){
                await Auth.setSession()
                this.disable = true
                if(!this.validateData()){
                    this.disable = false
                    return false
                }
                await axios.post(`/${Auth.state.username}/Update`, this.profile_information).then(res =>{
                    if(res.data.updated){
                        this.$toasted.show('Your profile has been updated successfully!', {
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
                        this.disable = false
                        $('#ModalAlert').modal('toggle')
                    }
                }).catch(err =>{
                    $('#ModalAlert').modal('toggle')
                    this.disable = false
                    swal('Error', 'Please verified your email address','error')
                    window.open('/email/verify')
                })
            },
            validateData(){
                let validate = true
                if(this.profile_information.profile_type === "") validate = false;
                if(this.profile_information.title === "Select Title") validate = false;
                return validate;
            }
        }
    }
</script>
