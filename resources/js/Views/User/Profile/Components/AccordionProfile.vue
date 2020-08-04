<template>
    <section class="container-fluid edit-profile">
        <form @submit.prevent="save" enctype="multipart/form-data" ref="form_profile_update_information">
            <div id="accordionProfile" class="accordion">
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingOne">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <button type="button" class="btn btn-link no-underline text-white font-weight-bold">Profile Type <span class="c-fifth">*</span></button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionProfile" >
                        <div class="card-body  bg-black">
                            <div class="row text-justify profile-type">
                                <div class="col-md-6">
                                    <input type="radio" id="personProject" value="A Person or A Project"  v-model="profile_information.profile_type" required>
                                    <label for="personProject">
                                        <span>A person or A Project</span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="aBand" value="A Band" v-model="profile_information.profile_type"  required>
                                    <label for="aBand">
                                        <span>A Band</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingTwo">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <button type="button" class="btn btn-link no-underline collapsed text-white font-weight-bold">Title<span class="c-fifth">*</span></button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <div class="row text-justify ">
                                <div class="col text-center select">
                                    <select class="select-form font-weight-bold" v-model="profile_information.title">
                                        <option value="Select Title">Select Title</option>
                                        <optgroup  v-if="profile_information.profile_type == 'A Person or A Project'">
                                            <option value="Vlog Channel">Vlog Channel</option>
                                            <option value="Podcast">Podcast</option>
                                            <option value="Composer">Composer</option>
                                            <option value="Vocal Coach">Vocal Coach</option>
                                            <option value="Mixing Engineer">Mixing Engineer</option>
                                            <option value="Music Producer">Music Producer</option>
                                            <option value="Mastering Engineer">Mastering Engineer</option>
                                            <option value="Recording Engineer">Recording Engineer</option>
                                            <option value="Sound Designer">Sound Designer</option>
                                            <option value="Instrument Tutor">Instrument Tutor</option>
                                            <option value="Rapper">Rapper</option>
                                            <option value="Singer">Singer</option>
                                            <option value="Singer Songwriter">Singer Songwriter</option>
                                            <option value="Guitarist">Guitarist</option>
                                            <option value="Drummer">Drummer</option>
                                            <option value="Bassist">Bassist</option>
                                            <option value="Keyboardist">Keyboardist</option>
                                            <option value="DJ">DJ</option>
                                            <option value="Beatmaker">Beatmaker</option>
                                            <option value="Music Studio">Music Studio</option>
                                            <option value="Manager">Manager</option>
                                            <option value="A&R">A&R</option>
                                        </optgroup>
                                        <optgroup v-if="profile_information.profile_type == 'A Band'">
                                            <option value="Band">Band</option>
                                            <option value="Duet">Duet</option>
                                            <option value="Orchestra">Orchestra</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingThree">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <button class="btn btn-link collapsed text-white no-underline font-weight-bold" type="button">
                                Artistic Name <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <input type="text" class="form-control mb-3" placeholder="Artistic Name" v-model="profile_information.artistic_name">
<!--                            <input type="checkbox"> Use Artistic Name Instead of Personal Name-->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingFourth">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="false" aria-controls="collapseFourth">
                            <button type="button" class="btn btn-link no-underline collapsed text-white font-weight-bold">
                                About You
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseFourth" class="collapse" aria-labelledby="headingFourth" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <textarea class="form-control p-3" cols="180" rows="10" placeholder="Write About You..." v-model="profile_information.about_you"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingFifth">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                            <button type="button"  class="btn btn-link no-underline collapsed text-white font-weight-bold">
                                Members <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseFifth" class="collapse bg-black" aria-labelledby="headingFifth" data-parent="#accordionProfile">
                        <div class="text-white bg-black text-center card-body">
                            <div class="d-flex flex-row mb-4">
                                <h5>Current Members</h5>
                                <button type="button" class="bg-primary c-white  rounded-pill mx-lg-5 mx-sm-2" v-on:click="addMember('current')">Add Current Member</button>
                            </div>
                            <div>
                                <single-member v-for="(current, index) in current_members" :key="index" :member="current" :index="index" :type="'current'" />
                            </div>
                            <div class="d-flex flex-row mb-4">
                                <h5>Former Members</h5>
                                <button type="button" class="bg-primary c-white  rounded-pill mx-lg-5 mx-sm-2" v-on:click="addMember('past')">Add Former Member</button>
                            </div>
                            <div>
                                <single-member  v-for="(past, index) in past_members" :key="index" :member="past" :index="index" :type="'past'" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingSix">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <button type="button" class="btn btn-link no-underline collapsed text-white font-weight-bold">
                                Releases <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse text-center bg-black" aria-labelledby="headingSix" data-parent="#accordionProfile">
                        <button type="button" class="bg-primary c-white rounded-pill mb-4" v-on:click="addRelease">Add Release</button>
                        <div id="releases" class="d-flex text-white bg-black align-items-center flex-wrap">
                            <single-release v-for="(release, index) in releases_information" :key="index" :release="release" :index="index" />
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingSeven">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <button type="button" class="btn btn-link no-underline collapsed text-white font-weight-bold">
                                Worked With <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-column justify-content-center align-items-center text-center">
                                    <button type="button" class="bg-primary text-white rounded-pill font-weight-bold my-3" @click="addWork = true" v-if="!addWork">Add Worked With</button>

                                    <input class="form-control bg-black my-2 work-with" v-model="addWorkName" @keypress.enter.prevent="addedWork($event)" v-else autofocus>
                                    <div class="d-flex flex-row icon-work-with cursor-pointer" v-if="addWork" @click.prevent="addedWork($event)">
                                        <span class="border-left">&nbsp;</span>
                                        <img src="/images/icons/work-with.svg" width="19rem"/>
                                    </div>
                                </div>
                                <div class="d-flex flex-row flex-wrap ">
                                    <span class="text-white text-center text-work m-2 p-2" v-for="(work , index) in worked_with" :key="index">{{work.name}}<i class="fas fa-times cursor-pointer mx-2 py-1" @click="deleteWorkWith(work)"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingEight">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            <button type="button" class="btn btn-link no-underline collapsed text-white font-weight-bold" >
                                Genre <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <div class="text-center select">
                                <button type="button" class="text-white font-weight-bold" @click="showModalSelectGenres">Select Genre(s)</button>
                            </div>
                            <div class="text-left">
                                <ul v-for="(item , index) in profile_information.genres" :key="index" >
                                    <li>{{ item }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingNine">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            <button type="button" class="btn btn-link no-underline collapsed text-white font-weight-bold">
                                Services <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <div class="text-center select">
                                <button type="button" class="text-white font-weight-bold" @click="showModalSelectServices">Select Service(s)</button>
                                <div class="text-left">
                                    <ul v-for="(item , index) in profile_information.services" :key="index" >
                                        <li>{{ item }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black font-weight-bold cursor-pointer" id="headingTen">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                            <button type="button" class="btn btn-link no-underline collapsed text-white font-weight-bold">
                                Social Media  <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <div class="form-group row">
                                <label class="col-sm-2">Youtube</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Youtube">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Twitch</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Twitch">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Instagram</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Instagram">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Facebook</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Facebook">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Twitter</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Twitter">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">TikTok</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.TikTok">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">LinkedIn</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.LinkedIn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">SnapChat</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.SnapChat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">SoundCloud</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.SoundCloud">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Bandcamp</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Bandcamp" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Spotify</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Spotify" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center text-center m-5">
                <button class="btn rounded-pill bg-black text-white font-weight-bold">Cancel</button>
                <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="button" v-if="!disable" @click="save()">Save</button>
                <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        <modal-select-genres />
        <modal-select-services />
        <modal-change-release />
    </section>
</template>

<script>
import ModalSelectGenres from "./Includes/ModalSelectGenres";
import ModalSelectServices from "./Includes/ModalSelectServices";
import ModalChangeRelease from "./Includes/ModalChangeRelease";
import SingleRelease from "./Releases/SingleRelease";
import SingleMember from "./Members/SingleMember";
import Auth from "../../../../helpers/Auth";

export default {
    props:['user'],
    components:{
        ModalChangeRelease,
        ModalSelectGenres,
        ModalSelectServices,
        SingleRelease,
        SingleMember,
    },
    data(){
        return {
            disable: false,
            url: `/${this.user.username}/Save/Profile`,
            imageReleases:'/images/profile/default.png',
            imageData: '/images/profile/default.png',
            profile_information:{
                profile_type: '',
                title: 'Select Title',
                artistic_name: '',
                about_you: '',
                genres: [],
                services: [],
                social_media: {
                    Youtube: '',
                    Twitch: '',
                    Instagram: '',
                    Facebook: '',
                    Twitter: '',
                    TikTok: '',
                    LinkedIn: '',
                    SnapChat: '',
                    SoundCloud: '',
                    Bandcamp: '',
                    Spotify: '',
                }
            },
            current_members:[],
            past_members:[],
            releases_information: [],
            addWork: false,
            addWorkName: '',
            worked_with:[],
        }
    },
    mounted(){
        this.initializeVariable()
        Auth.initialize()

        if(this.profile_information.profile_type == ''){
            this.$toasted.show('Please add Profile Title and Type if you would like to post your content!', {
                position: "bottom-right",
                duration : 4000,
                className: "p-4 notification bg-primary",
                keepOnHover: true
            })
        }
    },
    methods:{
        initializeVariable(){
            if (this.user.profile_information) {
                this.url = `/${this.user.username}/Edit/Profile`
                this.profile_information = this.user.profile_information

                this.profile_information.genres = this.user.profile_information.genres ? this.user.profile_information.genres.split(",") : []
                this.profile_information.services = this.user.profile_information.services ? this.user.profile_information.services.split(",") : []
                this.profile_information.social_media = this.user.profile_information.social_media != null ? JSON.parse(this.user.profile_information.social_media) : {Youtube: '', Twitch: '', Instagram: '', Facebook: '', Twitter: '', TikTok: '', LinkedIn: '', SnapChat: '', SoundCloud: '', Bandcamp: '', Spotify: '',}

        	    this.profile_information.members.map(val =>{
                    if (val.member_type === 'current') {
                        this.current_members.push(val)
                    }
                    if (val.member_type === 'past') {
                        this.past_members.push(val)
                    }
                })
                this.releases_information = this.user.profile_information.releases
                this.worked_with = this.user.profile_information.worked_with
            }
        },
        async addedWork(event){
            event.preventDefault()
            if(this.addWorkName == '') return false
            let work = {
                name: this.addWorkName,
                id: null
            }
            await this.saveWorkedWith(work)
        },
        addRelease(){
            this.releases_information.push({
                id: null,
                album_name:'',
                artistic_name:'',
                genre:'',
                image:'/images/default-releases.png',
                label:'',
                release_date:''
            })
        },
        addMember(type){
            if (type == 'current') {
                this.current_members.push({
                    id: null,
                    member_type: type,
                    member_name:"",
                    link_profile:'',
                    role_instrument:'',
                })
            }
            if (type == 'past') {
                this.past_members.push({
                    id: null,
                    member_type: type,
                    member_name:"",
                    link_profile:'',
                    role_instrument:'',
                })
            }
        },
        async save(){
            this.disable = true

            if(!this.validateData()){
                this.disable = false
                return false
            }

            let data_send =  {
                profile_information: this.profile_information,
                members_information: this.current_members.concat(this.past_members),
                releases_information: this.releases_information,
                worked_with_information: this.worked_with
            }
            await axios.post(this.url, data_send).then(res => {
                if (res.data.updated || res.data.saved) {
                    this.disable = false
                    this.$toasted.show('Your profile information has been updated successfully!', {
                        position: "bottom-right",
                        duration : 4000,
                        className: "p-4 notification bg-primary",
                        keepOnHover: true
                    })
                    window.location.replace(`/${Auth.state.username}/Profile`)
                }
                if (res.data.saved) {
                    this.url =`/${this.user.username}/Edit/Profile`
                }
            }).catch(err => {
                this.disable = false
            })
        },
        showModalSelectGenres(){
            $('#ModalSelectGenres').modal('show')
        },
        showModalSelectServices(){
            $('#ModalSelectServices').modal('show')
        },
        validateData(){
            let validate = true

            if(this.profile_information.profile_type == "") validate = false;
            if(this.profile_information.title == "Select Title") validate = false;
            if(this.current_members.length > 0){
                this.current_members.map(member =>{
                    if(member.member_name == '' || member.role_instrument == '') {
                        swal({
                            text: 'Please fill out the fields marked with (*) to add the current members',
                            className: 'swal-alert',
                            buttons: [false,'Ok'],
                            dangerMode: true,
                        })
                        validate = false
                    }
                })
            }
            if (this.past_members.length > 0){
                this.past_members.map(past =>{
                    if (past.member_name == '' || past.role_instrument == '') {
                        swal({
                            text: 'Please fill out the fields marked with (*) to add the past members',
                            className: 'swal-alert',
                            buttons: [false, 'Ok'],
                            dangerMode: true,
                        })
                        validate = false
                    }

                })
            }
            if(this.releases_information.length > 0){
                this.releases_information.map(release =>{
                    if(release.genre == '' || release.album_name == '') {
                        swal({
                            text: 'Please fill out the fields marked with (*) to add the release',
                            className: 'swal-alert',
                            buttons: {
                                cancel: false,
                                confirm: 'Ok'
                            },
                            dangerMode: true,
                        })
                        validate = false
                    }
                })
            }

            return validate
        },

        async saveWorkedWith(work, index){
            await axios.post(`/${this.user.username}/WorkWith/save`, work).then(res =>{
                if(res.data.save){
                    this.worked_with.push({
                        name: res.data.workWith.name,
                        id: res.data.workWith.id
                    })
                    this.addWorkName = ''
                }
            }).catch(err =>{
                console.log(err)
            })

        },
        async deleteWorkWith(work){
            await axios.post(`/${this.user.username}/WorkWith/delete/${work.id}`, this.user).then(res => {
                let index = _.findIndex(this.worked_with, function(o) { return o.id == work.id; });
                this.worked_with.splice(index, 1)
                this.$toasted.show('Your profile information has been updated successfully!', {
                    position: "bottom-right",
                    duration : 4000,
                    className: "p-4 notification bg-primary",
                    keepOnHover: true
                })
            })
        }

    }
}
</script>
