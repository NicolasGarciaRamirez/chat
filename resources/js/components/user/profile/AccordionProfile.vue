<template>
    <section class="container-fluid edit-profile">
        <div id="accordionProfile" class="accordion">
            <div class="card">
                <div class="card-header bg-black" id="headingOne">
                    <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <button type="button" class="btn btn-link text-white">Profile Type</button>
                        <i class="fas fa-angle-down text-white"></i>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionProfile" >
                    <div class="card-body  bg-black">
                        <div class="row text-justify">
                            <div class="col-md-6">
                                <input type="checkbox">
                                <label>A person or A Project</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox">
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
                                <select name="" class="form-control">
                                    <option value="">Select Title</option>
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
                        <input type="text" class="form-control mb-3" placeholder="Artistic Name">
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
                        <textarea class="form-control" cols="180" rows="10" placeholder="Write About You..." ></textarea>
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
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between my-4">
                            <h5>Former Members</h5>
                            <button class="btn text-white-white rounded-pill">Add Former Member</button>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control mb-2" placeholder="Member Name">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Role/Instrument">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Link to noisesharks profile">
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
                    <div class="card-body text-white bg-black">

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
                            <select name="" class="form-control">
                                <option value="">Select A Genre</option>
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
                            <select name="" class="form-control">
                                <option value="">Select Services</option>
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
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Twitch</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Instagram</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Facebook</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">TikTok</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">LinkedIn</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">SnapChat</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">SoundCloud</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Bandcamp</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">Spotify</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="Link to Noisesharks proﬁle">
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
    </section>
</template>

<script>
export default {
    mounted(){
        this.accordion()
    },
    methods:{
        accordion(){
		},
    }
}
</script>
