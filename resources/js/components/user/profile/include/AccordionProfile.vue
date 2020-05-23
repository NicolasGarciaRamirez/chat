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
                                    <input type="radio" id="personProject" value="A Person or A Project" v-model="personal_information.profile_type">
                                    <label>A person or A Project</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="radio" id="aBand" value="A Band" v-model="personal_information.profile_type">
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
                                    <select name="title" class="select-form" v-model="personal_information.title">
                                        <optgroup  v-if="personal_information.profile_type == 'A Person or A Project'">
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
                                        <optgroup v-if="personal_information.profile_type == 'A Band'">
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
                    <div id="collapseSix" class="collapse text-center bg-black" aria-labelledby="headingSix" data-parent="#accordionProfile">
                        <button class="bg-primary c-white rounded-pill" >Add Release</button>
                        <div class="card-body d-flex flex-row text-white bg-black align-items-center justify-content-between">
                            <div class="d-flex flex-row">
                                <div class="d-flex flex-column">
                                    <label for="imgRelease">
                                        <img class="img-fluid pr-3" :src="imageData" height="190px" width="180px">
                                    </label>
                                    <input type="file" id="imgRelease" name="imageRelease" class="form-control d-none" ref="imageRelease" @change="previewImage">
                                  
                                </div>
                                <div class="d-flex flex-column">
                                    <input type="text" class="form-control" placeholder="Artist Name" v-model="personal_information.releases.artist_name">
                                    <input type="text" class="form-control" placeholder="Album Name" v-model="personal_information.releases.album_name">
                                    <input type="text" class="form-control" placeholder="Release Date" v-model="personal_information.releases.release_date" >
                                    <input type="text" class="form-control" placeholder="Genre" v-model="personal_information.releases.genre">
                                    <input type="text" class="form-control" placeholder="Label name" v-model="personal_information.releases.label">
                                    <!-- <input type="text" class="form-control" placeholder="Credits" v-model="personal_information.releases.credits"> -->
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
                            <div class="text-center select">
                                <select class="select-form" v-model="personal_information.services">
                                    <optgroup v-if="personal_information.title == 'Audio Engineering'">
                                        <option value="">Select Services</option>
                                        <option value="N/A">N/A</option>
                                        <option value="Audio Repairing">Audio Repairing</option>
                                        <option value="Broadcasting">Broadcasting</option>
                                        <option value="Consultation">Consultation</option>
                                        <option value="Equipment Repairing">Equipment Repairing</option>
                                        <option value="Live Stage Setup">Live Stage Setup</option>
                                        <option value="Live TV Audio Engineering">Live TV Audio Engineering</option>
                                        <option value="Mastering">Mastering</option>
                                        <option value="Mixing">Mixing</option>
                                        <option value="Podcasting">Podcasting</option>
                                        <option value="Post-Production">Post-Production</option>
                                        <option value="Radio Engineering">Radio Engineering</option>
                                        <option value="Recording">Recording</option>
                                        <option value="Song Re-Mixing">Song Re-Mixing</option>
                                        <option value="Studio Setup">Studio Setup</option>
                                    </optgroup>
                                    <optgroup v-if="personal_information.title == 'Music Production'">
                                        <option value="">Select Services</option>
                                        <option value="N/A">N/A</option>
                                        <oprion value="Beat Making">Beat Making</oprion>
                                        <oprion value="Drum Sampling">Drum Sampling</oprion>
                                        <oprion value="Editing (Bass Guitar)">Editing (Bass Guitar)</oprion>
                                        <oprion value="Editing (Drums)">Editing (Drums)</oprion>
                                        <oprion value="Editing (Guitar)">Editing (Guitar)</oprion>  
                                        <oprion value="Editing (Samples)">Editing (Samples)</oprion>
                                        <oprion value="Editing (Vocals)">Editing (Vocals)</oprion>
                                        <oprion value="MIDI Programming">MIDI Programming</oprion>
                                        <oprion value="Re-Amping (Bass Guitar)">Re-Amping (Bass Guitar)</oprion>
                                        <oprion value="Re-Amping (Drums)">Re-Amping (Drums)</oprion>
                                        <oprion value="Re-Amping (Guitar)">Re-Amping (Guitar)</oprion>
                                        <oprion value="Re-Amping (Samples)">Re-Amping (Samples)</oprion>
                                        <oprion value="Re-Sampling">Re-Sampling</oprion>
                                        <oprion value="Sampling">Sampling</oprion>
                                        <oprion value="Song Arranging">Song Arranging</oprion>
                                        <oprion value="Song Re-Arranging">Song Re-Arranging</oprion>
                                        <oprion value="Sound Design">Sound Design</oprion>
                                    </optgroup>
                                    <optgroup v-if="personal_information.title == 'Composing'">
                                        <option value="Advertisements Composing">Advertisements Composing</option>
                                        <option value="Anime Composing">Anime Composing</option>
                                        <option value="Cartoon Composing">Cartoon Composing</option>
                                        <option value="Film & Cinema Composing">Film & Cinema Composing</option>
                                        <option value="Social Media Videos Composing">Social Media Videos Composing</option>
                                        <option value="Trailers Composing">Trailers Composing</option>
                                        <option value="TV Series Composing">TV Series Composing</option>
                                        <option value="Video Games Composing">Video Games Composing</option>
                                        <option value="YouTube Videos Composing">YouTube Videos Composing</option>
                                    </optgroup>
                                    <optgroup v-if="personal_information.title == 'DJ'">
                                        <option value="Bars & Pubs">Bars & Pubs</option>
                                        <option value="Ceremonies">Ceremonies</option>
                                        <option value="Clubs">Clubs</option>
                                        <option value="Dj Remixing">Dj Remixing</option>
                                        <option value="Events (Live)">Events (Live)</option>
                                        <option value="Events (Pre-Recorded)">Events (Pre-Recorded)</option>
                                        <option value="House Parties">House Parties</option>
                                        <option value="Touring Hire (National)">Touring Hire (National)</option>
                                        <option value="Touring Hire (Overseas)">Touring Hire (Overseas)</option>
                                        <option value="Weddings">Weddings</option>
                                    </optgroup>
                                    <optgroup v-if="personal_information.title == 'Musicians'">
                                        <option value="Bars & Pubs">Bars & Pubs</option>
                                        <option value="Ceremonies">Ceremonies</option>
                                        <option value="Clubs">Clubs</option>
                                        <option value="Instruments Repair">Instruments Repair</option>
                                        <option value="Live Session (National)">Live Session (National)</option>
                                        <option value="Live Session (Overseas)">Live Session (Overseas)</option>
                                        <option value="Recording Session">Recording Session</option>
                                        <option value="Songwriting">Songwriting</option>
                                        <option value="Teacher (Face to Face)">Teacher (Face to Face)</option>
                                        <option value="Teacher (Online)">Teacher (Online)</option>
                                        <option value="Touring (National)">Touring (National)</option>
                                        <option value="Touring (Overseas)">Touring (Overseas)</option>
                                        <option value="Weddings">Weddings</option>
                                    </optgroup>
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
            imageReleases:'',
            imageData: '/images/profile/default.png',
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
                    image: '',
                    artist_name:'',
                    album_name:'',
                    genre:'',
                    release_date: '',
                    label:'',
                    // credits:''
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
        previewImage(event) {
            this.personal_information.releases.image = event.target.files[0]

            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        },
        getUser(){
            if (this.user.personal_information) {
                this.personal_information = this.user.personal_information
                this.personal_information.members = JSON.parse(this.user.personal_information.members)
                this.personal_information.releases = JSON.parse(this.user.personal_information.releases)
                this.personal_information.social_media = JSON.parse(this.user.personal_information.social_media)
            }
        },
        save(){
            axios.post(`/${this.user.username}/Edit/Profile/`, this.personal_information).then(res => {
                if (res.data.updated) {
                    alert('the personal information has been updated')
                    window.location.reload()
                }
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>
