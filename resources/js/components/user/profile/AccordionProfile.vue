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
                                    <input type="checkbox" v-model="personal_information.profile_type">
                                    <label>A person or A Project</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="checkbox" v-model="personal_information.profile_type">
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
                                <div class="col text-center">
                                    <select name="title" class="select-form" v-model="personal_information.title">
                                        <option value="">Select Title</option>
                                        <option value="Person">Person</option>
                                        <option value="Band">Band</option>
                                        <option value="Company">Company</option>
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
                            <input type="text" class="form-control mb-3" placeholder="Artistic Name" v-model="personal_information.artistic_name"> 
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
                            <textarea class="form-control" cols="180" rows="10" placeholder="Write About You..." v-model="personal_information.about_you"></textarea>
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
                    <div id="collapseFifth" class="collapse" aria-labelledby="headingFifth" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black">
                            <h5 class="my-4">Current Members</h5>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.current_members.member_name_1">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.current_members.role_instrument_1">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.current_members.link_noisesharks_profile_1">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.current_members.member_name_2" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.current_members.role_instrument_2" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.current_members.link_noisesharks_profile_2" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.current_members.member_name_3" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.current_members.role_instrument_3" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.current_members.link_noisesharks_profile_3" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.current_members.member_name_4" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.current_members.role_instrument_4" />
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.current_members.link_noisesharks_profile_4" />
                                </div>
                            </div>
                            <div class="d-flex justify-content-between my-4">
                                <h5>Former Members</h5>
                                <button class="btn text-white-white rounded-pill">Former Member</button>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.former_members.member_name_1" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.former_members.role_instrument_1">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.former_members.link_noisesharks_profile_1" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.former_members.member_name_2" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.former_members.role_instrument_2" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.former_members.link_noisesharks_profile_2" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.former_members.member_name_3" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.former_members.role_instrument_3" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.former_members.link_noisesharks_profile_3" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control mb-2" placeholder="Member Name" v-model="personal_information.members.former_members.member_name_4 ">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Role/Instrument" v-model="personal_information.members.former_members.role_instrument_4" >
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Link to noisesharks profile" v-model="personal_information.members.former_members.link_noisesharks_profile_4" >
                                </div>
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
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionProfile">
                        <div class="card-body text-white bg-black align-items-center">
                            <div class="form-group row">
                                <label class="col-sm-1">Artist</label> 
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" v-model="personal_information.releases.artist">
                                </div>
                            </div>
                            <div class="form-group row my-3">
                                <label class="col-sm-1">Album</label> 
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" v-model="personal_information.releases.album">
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label class="col-sm-1">Genre</label> 
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" v-model="personal_information.releases.genre">
                                </div>
                            </div>    
                            <div class="form-group row my-3">
                                <label class="col-sm-1">Release Date</label> 
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" v-model="personal_information.releases.release_date" >
                                </div>
                            </div>    
                            <div class="form-group row">
                                <label class="col-sm-1">Label</label> 
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" v-model="personal_information.releases.label">
                                </div>
                            </div>    
                            <div class="form-group row my-3">
                                <label class="col-sm-1">Credits</label> 
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" v-model="personal_information.releases.credits">
                                </div>
                            </div>    
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
                                    <button class="btn bg-black text-white rounded-pill">Add Worked With</button>
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
                            <div class="text-center">
                                <select class="select-form" v-model="personal_information.genre" >
                                    <option value="">Select A Genre</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
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
                            <div class="text-center">
                                <select name="" class="select-form" v-model="personal_information.services">
                                    <option value="">Select Services</option>
                                    <option value="N/A">N/A</option>
                                </select>
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
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.Youtube">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Twitch</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.Twitch">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Instagram</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.Instagram">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Facebook</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.Facebook">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">TikTok</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.TikTok">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">LinkedIn</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.LinkedIn">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">SnapChat</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.SnapChat">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">SoundCloud</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.SoundCloud">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Bandcamp</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.Bandcamp">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2">Spotify</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle" v-model="personal_information.social_media.Spotify">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center text-center m-5">
                <button class="btn rounded-pill bg-black text-white">Cancel</button>
                <button class="btn rounded-pill text-white bg-fifth" type="submit">Save</button>
            </div>
        </form>
    </section>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            personal_information:{
                profile_type: '',
                title: '',
                artistic_name: '',
                about_you: '',
                members: {
                    current_members:{
                        member_name_1: '',
                        role_instrument_1:'',
                        link_noisesharks_profile_1:'',
                        member_name_2: '',
                        role_instrument_2:'',
                        link_noisesharks_profile_2:'',
                        member_name_3: '',
                        role_instrument_3:'',
                        link_noisesharks_profile_3:'',
                        member_name_4: '',
                        role_instrument_4:'',
                        link_noisesharks_profile_4:''
                    },
                    former_members:{
                        member_name_1: '',
                        role_instrument_1:'',
                        link_noisesharks_profile_1:'',
                        member_name_2: '',
                        role_instrument_2:'',
                        link_noisesharks_profile_2:'',
                        member_name_3: '',
                        role_instrument_3:'',
                        link_noisesharks_profile_3:'',
                        member_name_4: '',
                        role_instrument_4:'',
                        link_noisesharks_profile_4:''
                    }
                },
                releases: {
                    artist:'',
                    album:'',
                    genre:'',
                    release_date: '',
                    label:'',
                    credits:''
                },
                worked_with: '',
                genre: '',
                services: '',
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
            }
        }
    },
    mounted(){
        this.getUser()
    },
    methods:{
        getUser(){
            if (this.user.personal_information) {
                this.personal_information = this.user.personal_information
                this.personal_information.members = JSON.parse(this.user.personal_information.members)
                this.personal_information.releases = JSON.parse(this.user.personal_information.releases)
                this.personal_information.social_media = JSON.parse(this.user.personal_information.social_media)
            }
        },
        save(){
            axios.post(`/Profile/Edit/Update/${this.user.id}`, this.personal_information).then(res => {
                console.log(res)
                alert('the personal information has been updated')
                window.location.reload()
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
