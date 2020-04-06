<template>
  <section>
      <div class="d-flex justify-content-around bg-black mt-5">
        <div >
            <h2 class="c-white">Personal Details <i class="fas fa-pencil-alt"></i></h2>
            <label>Name: Thamek</label><br>
            <label>Gender: Male</label><br>
            <label>Location: asd</label><br>
            <label>Email: asd@gmail.com</label>
        </div>
        <div >
            <h2 class="c-white">Subscription</h2><br>
            <label>Acount Type: <span class="c-fifth">CONTRIBUTOR</span></label><br>
            <a href="#" class="btn bg-black text-white border rounded-pill">Account Setings <i class="fas fa-cog ml-2"></i></a>
        </div>
      </div>

      <div id="accordionExample">
        <div class="m-5">
          <div class="row">
            <div class="col">
                <div class="card border">
                    <div class="card-header bg-black border" id="headingOne">
                        <h2 class="mb-0">
                            <a class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                              Profile Type
                            </a>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample" >
                        <div class="card-body  bg-black">
                          <div class="row text-justify">
                            <div class="col text-right">
                              <input type="checkbox" id="pop">
                              <label for="pop"><span>A person or A Project</span></label>
                              
                            </div>
                            <div class="col">
                              A Band
                            </div>
                          </div>
                          
                        </div>
                    </div>
                </div> 
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingTwo">
                  <h2 class="mb-0">
                    <a class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Title
                    </a>
                    <i class="fas fa-angle-down text-white float-right"></i>

                  </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    <div class="row text-justify ">
                      <div class="col text-center">
                        <select name="" class="forms-text">
                          <option value="">asd</option>
                          <option value="">asd</option>
                          <option value="">asd</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Artistic Name <small>(If Applicable)</small>
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    <input type="text" class="bg-primary forms-text"><br>
                     Use Artistic Name Instead of Personal Name <label></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingFourth">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="false" aria-controls="collapseFourth">
                      About You
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseFourth" class="collapse" aria-labelledby="headingFourth" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    <textarea class="bg-primary rounded form-control" cols="190" rows="10" placeholder="Write About You..." ></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingFifth">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                      Members <small>(If Applicable)</small>
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseFifth" class="collapse" aria-labelledby="headingFifth" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    <div class="row">
                      <div class="col">
                        <h5>Current Members</h5>
                        <input type="text" class="forms-text" placeholder="Member Name">
                        <input type="text" class="forms-text" placeholder="Role/Instrument">
                        <input type="text" class="forms-text" placeholder="Link to noisesharks profile">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <input type="text" class="forms-text" placeholder="Member Name">
                        <input type="text" class="forms-text" placeholder="Role/Instrument">
                        <input type="text" class="forms-text" placeholder="Link to noisesharks profile">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <input type="text" class="forms-text" placeholder="Member Name">
                        <input type="text" class="forms-text" placeholder="Role/Instrument">
                        <input type="text" class="forms-text" placeholder="Link to noisesharks profile">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col mt-2">
                        <h5>Former Members</h5>
                        <input type="text" class="forms-text" placeholder="Member Name">
                        <input type="text" class="forms-text" placeholder="Role/Instrument">
                        <input type="text" class="forms-text" placeholder="Link to noisesharks profile">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <input type="text" class="forms-text" placeholder="Member Name">
                        <input type="text" class="forms-text" placeholder="Role/Instrument">
                        <input type="text" class="forms-text" placeholder="Link to noisesharks profile">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col">
                        <input type="text" class="forms-text" placeholder="Member Name">
                        <input type="text" class="forms-text" placeholder="Role/Instrument">
                        <input type="text" class="forms-text" placeholder="Link to noisesharks profile">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingSix">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      Releases <small>(If Applicable)</small>
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    
                      <div class="row">
                        <div class="col text-center">
                          <button class="btn bg-black text-white border rounded-pill">Add Release</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <img src="/images/profile.png" alt="album">
                        </div>
                        <div class="col">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                        </div>
                        <div class="col">
                          <img src="" alt="">
                        </div>
                        <div class="col">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                          <input type="text" class="forms-text">
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingSeven">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                      Worked With <small>(If Applicable)</small>
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    <div class="row">
                      <div class="col text-center">
                        <button class="btn bg-black text-white border rounded-pill">Add Worked With</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingEight">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                      Genre <small>(If Applicable)</small>
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    <div class="row">
                      <div class="col text-center">
                        <select name="" class="forms-text" >
                          <option value="">Select A Genre</option>
                          <option value="Female">Female</option>
                          <option value="Male">Male</option>
                          <option value="asd">asd</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingNine">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                      Services <small>(If Applicable)</small>
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                    <div class="ro">
                      <div class="col text-center">
                        <select name="" class="forms-text">
                          <option value="">asd</option>
                          <option value="">asd</option>
                          <option value="">asd</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card border">
                <div class="card-header bg-black" id="headingTen">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                      Social Media  <small>(If Applicable)</small>
                    </button>
                    <i class="fas fa-angle-down text-white float-right"></i>
                  </h2>
                </div>
                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                  <div class="card-body text-white bg-black">
                   <div class="d-flex flex-row align-items-center justify-content-start bd-highlight mb-1">
                    <div class="p-2 bd-highlight text-left">
                      Youtube
                    </div>
                    <div class="p-2 bd-highlight text-right">
                       <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                    </div>
                  </div>
                   <div class="d-flex flex-row align-items-center justify-content-start bd-highlight mb-1">
                     <div class="p-2 bd-higlight text-left">
                       Twitch
                      </div>
                     <div class="p-2 bd-higlight">
                       <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                     </div>
                   </div>
                   <div class="d-flex flex-row align-items-center justify-content-start bd-highlight mb-1">
                     <div class="p2 bd-higlight">
                       Instagram
                     </div>
                     <div class="p2 bd-higlight">
                       <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                     </div>
                   </div>
                   <div class="row">
                     <div class="col">
                       Facebook
                       <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                     </div>
                   </div>
                   <div class="row">
                     <div class="col">
                       TikTok
                       <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                     </div>
                   </div>
                   <div class="row">
                     <div class="col">
                      LinkedIn
                      <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                     </div>
                   </div>
                   <div class="row">
                     <div class="col">
                      SnapChat
                      <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-2 d-flex flex-justify-content">
                       <div class="col">
                          SoundCloud
                       </div>
                       <div class="col text-right">
                        <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                       </div>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-2 d-flex flex-justify-content">
                       <div class="col">
                        Spotify
                       </div>
                       <div class="col text-right">
                        <input type="text" class="forms-text text-right" placeholder="Link to Noisesharks proﬁle">
                       </div>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-2 d-flex flex-justify-content">
                       <div class="col">
                        Bandcamp
                       </div>
                       <div class="col">
                        <input type="text" class="forms-text" placeholder="Link to Noisesharks proﬁle">
                       </div>
                     </div>
                   </div>
                  </div>
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
      $(document).ready(function(){
          $(".collapse.show").each(function(){
              $(this).prev(".card-header").find(".fas").addClass("fa-angle-up").removeClass("fa-angle-down");
          });
          
          $(".collapse").on('show.bs.collapse', function(){
              $(this).prev(".card-header").find(".fas").removeClass("fa-angle-down").addClass("fa-angle-up");
          }).on('hide.bs.collapse', function(){
              $(this).prev(".card-header").find(".fas").removeClass("fa-angle-up").addClass("fa-angle-down");
          });
      });
    }
  }
}
</script>