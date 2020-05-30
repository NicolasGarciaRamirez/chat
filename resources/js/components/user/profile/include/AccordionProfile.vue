<template>
    <section class="container-fluid edit-profile">
        <form @submit.prevent="save">
            <div id="accordionProfile" class="accordion">
                <div class="card">
                    <div class="card-header bg-black" id="headingOne">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <button type="button" class="btn btn-link text-white">Profile Type</button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionProfile" >
                        <div class="card-body  bg-black">
                            <div class="row text-justify">
                                <div class="col-md-6">
                                    <input type="radio" id="personProject" value="A Person or A Project" v-model="profile_information.profile_type" required>
                                    <label>A person or A Project</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="aBand" value="A Band" v-model="profile_information.profile_type" required>
                                    <label>A Band</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingTwo">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <button type="button" class="btn btn-link collapsed text-white">Title</button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <div class="row text-justify ">
                                <div class="col text-center select">
                                    <select class="select-form" v-model="profile_information.title" required>
                                        <optgroup  v-if="profile_information.profile_type == 'A Person or A Project'">
                                            <option value="N/A">Select Title</option>
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
                                            <option value="N/A">Select Title</option>
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
                    <div class="card-header bg-black" id="headingThree">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <button class="btn btn-link collapsed text-white" type="button">
                                Artistic Name <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <input type="text" class="form-control mb-3" placeholder="Artistic Name" v-model="profile_information.artistic_name">
                            <input type="checkbox"> Use Artistic Name Instead of Personal Name
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingFourth">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="false" aria-controls="collapseFourth">
                            <button type="button" class="btn btn-link collapsed text-white">
                                About You
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseFourth" class="collapse" aria-labelledby="headingFourth" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <textarea class="form-control" cols="180" rows="10" placeholder="Write About You..." v-model="profile_information.about_you"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingFifth">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                            <button type="button"  class="btn btn-link collapsed text-white">
                                Members <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseFifth" class="collapse bg-black" aria-labelledby="headingFifth" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black text-center">
                            <div class="d-flex flex-row mb-4">
                                <h5>Current Members</h5>
                                <button type="button" class="bg-primary c-white  rounded-pill mx-5" v-on:click="addMember">Add Current Member</button>
                            </div>
                            <single-member v-for="(member, index) in members_information" :key="index" :member="member" :index="index" />
                            <div class="d-flex justify-content-between my-4">
                                <h5>Former Members</h5>
                                <button class="btn text-white-white rounded-pill">Add Former Member</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingSix">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <button type="button" class="btn btn-link collapsed text-white">
                                Releases <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse text-center bg-black" aria-labelledby="headingSix" data-parent="#accordionProfile">
                        <button type="button" class="bg-primary c-white rounded-pill" v-on:click="addRelease">Add Release</button>
                        <div id="releases" class="card-body d-flex text-white bg-black align-items-center flex-wrap">
                            <single-release v-for="(release, index) in releases_information" :key="index" :release="release" :index="index" />
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingSeven">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <button type="button" class="btn btn-link collapsed text-white">
                                Worked With <small>(If Applicable)</small>
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <div class="row">
                                <div class="col text-center">
                                    <button class="bg-primary text-white rounded-pill">Add Worked With</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingEight">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            <button type="button" class="btn btn-link collapsed text-white" >
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
                    <div class="card-header bg-black" id="headingNine">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            <button type="button" class="btn btn-link collapsed text-white">
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
                    <div class="card-header bg-black" id="headingTen">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                            <button type="button" class="btn btn-link collapsed text-white">
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
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Bandcamp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Spotify</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks profile" v-model="profile_information.social_media.Spotify">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center text-center m-5">
                <button class="btn rounded-pill bg-black text-white">Cancel</button>
                <button class="btn rounded-pill text-white bg-fifth" type="submit" v-if="!disable">Save</button>
                <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                </button>

            </div>
        </form>
        <modal-select-genres />
        <modal-select-services />

    </section>
</template>

<script>
import ModalSelectGenres from './ModalSelectGenres'
import ModalSelectServices from './ModalSelectServices'
import SingleRelease from "./SingleRelease";
import SingleMember from "./SingleMember";
export default {
    props:['user'],
    components:{
        ModalSelectGenres,
        ModalSelectServices,
        SingleRelease,
        SingleMember
    },
    data(){
        return {
            disable: false,
            url: `/${this.user.username}/Save/Profile`,
            imageReleases:'/images/profile/default.png',
            imageData: '/images/profile/default.png',
            profile_information:{
                profile_type: '',
                title: '',
                artistic_name: '',
                about_you: '',
                genres: [],
                services: [],
                social_media: {
                    Youtube: '',
                    Twitch: '',
                    Instagram: '',
                    Facebook: '',
                    TikTok: '',
                    LinkedIn: '',
                    SnapChat: '',
                    SoundCloud: '',
                    Bandcamp: '',
                    Spotify: '',
                }
            },
            members_information:[],
            releases_information: []
        }
    },
    mounted(){
       this.initializeVariable()
    },
    methods:{
        initializeVariable(){
            if (this.user.profile_information) {
                this.url = `/${this.user.username}/Edit/Profile`
                this.profile_information = this.user.profile_information
                this.profile_information.genres = this.user.profile_information.genres.split(",")
                this.profile_information.services = this.user.profile_information.services.split(",")
                this.profile_information.social_media = JSON.parse(this.user.profile_information.social_media)

                this.members_information = this.user.profile_information.members
                this.releases_information = this.user.profile_information.releases
            }

        },
        addRelease(){
            this.releases_information.push({
                album_name:'',
                artistic_name:'',
                genre:'',
                image:'/images/default.png',
                label:'',
                release_date:''
            })
        },
        addMember(){
            this.members_information.push({
                member_name:"",
                link_profile:'',
                role_instrument:'',
            })
        },
        async save(){
            this.disable = true

            var data = {
                profile_information: this.profile_information,
                members_information: this.members_information,
                releases_information: this.releases_information
            }
            await axios.post(this.url, data).then(res => {
                if (res.data.updated || res.data.saved) {
                    this.disable = false
                    alert('the personal information has been updated')
                    window.location.reload()
                }
                else{
                    console.log(res)
                }
            }).catch(err => {
                console.log(err)
            })
        },
        showModalSelectGenres(){
            $('#ModalSelectGenres').modal('show')
        },
        showModalSelectServices(){
            $('#ModalSelectServices').modal('show')
        }
    }
}
</script>
