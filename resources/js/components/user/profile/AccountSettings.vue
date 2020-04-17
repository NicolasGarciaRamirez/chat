<template>
    <section>
        <div class="container-fluid account-settings">
            <h2 class="text-center my-5">Account Settings</h2>

            <div id="accordionAccountSettings" class="accordion">
                <div class="card">
                    <div class="card-header bg-black" id="headingOne">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <img class="icon" src="/images/icons/house.svg" />
                            <button type="button" class="btn btn-link text-white">Account Overview</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse"
                    aria-labelledby="headingOne" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="c-fourth flex-column mx-5">
                                <div><label>Accont Type :</label><b class="c-fifth">FREE</b></div>
                                <div><label>Joined :</label><b class="text-white">01/10/2019</b></div>
                                <div><label>Email :</label><b class="text-white">t.ghanamek@noisesharls.com</b></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button>Edit <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingTwo">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <img class="icon" src="/images/icons/user-pencil.svg" />
                            <button type="button" class="btn btn-link text-white">Personal Details</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse"
                    aria-labelledby="headingTwo" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="c-fourth flex-column mx-5">
                                <div><label>Name :</label><b class="text-white">Tarek Ghanamek</b></div>
                                <div><label>Date of birth :</label><b class="text-white">10/11/1993</b></div>
                                <div><label>Gender :</label><b class="text-white">Male</b></div>
                                <div><label>Location :</label><b class="text-white">London, U.K</b></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button>Edit <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingThree">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <img class="icon" src="/images/icons/payment.svg" />
                            <button type="button" class="btn btn-link text-white">Your Payments</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse"
                    aria-labelledby="headingThree" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="row text-justify">
                                <div class="table-responsive mx-5">
                                    <table class="table bg-black text-white">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>To Who?</th>
                                                <th>Amount</th>
                                                <th>Invoice</th>
                                                <th>Cancel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01/11/2019</td>
                                                <td>Support</td>
                                                <td><img /> Henrry cadbury</td>
                                                <td>$7.00</td>
                                                <td><img src="/images/icons/payment.svg" class="icon" /></td>
                                                <td>x</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingFourth">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="false" aria-controls="collapseFourth">
                            <img class="icon" src="/images/icons/change-password.svg" />
                            <button type="button" class="btn btn-link text-white">Change Password</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseFourth" class="collapse"
                    aria-labelledby="headingFourth" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="d-flex justify-content-center">
                                <button>Change Password <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingFifth">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                            <img class="icon" src="/images/icons/linked-social-media.svg" />
                            <button type="button" class="btn btn-link text-white">Linked Social Media</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseFifth" class="collapse"
                    aria-labelledby="headingFifth" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="d-flex flex-column text-center ">
                                <div>
                                    <img src="/images/facebook.svg" alt="" class="icon">
                                    <button class="btn btn-facebook">link With facebook</button>
                                </div>
                                <div>
                                    <img src="/images/twitter-blue.svg" alt="" class="icon">
                                    <button class="btn btn-twitter">Disconnect From Twitter</button>
                                </div>
                                <div>
                                    <img src="/images/google.svg" alt="" class="icon">
                                    <button class="btn btn-google">Link With Google</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingSix">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <img class="icon" src="/images/icons/linked-other-profile.svg" />
                            <button type="button" class="btn btn-link text-white">Linked Other Noisesharks Profiles</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse"
                    aria-labelledby="headingSix" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="flex-column">
                                <h3>Linked Other Noisesharks Proﬁles</h3>
                                <p>
                                    Link your personal proﬁle with the proﬁle of your band, vlog, podcast, or any other Noisesharks proﬁle
                                    that you are a part of.
                                </p>
                                <div class="d-flex justify-content-center">
                                    <form action="/" class="form-search">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Search profiles" autocomplete="none">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="cil-search"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>