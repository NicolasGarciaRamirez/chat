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
                                <div><label>Accont Type :</label><b class="c-fifth">{{user.subscription_type}}</b></div>
                                <div><label>Joined :</label><b class="text-white">{{ user.created_at }}</b></div>
                                <div><label>Email :</label><b class="text-white">{{ user.email }}</b></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button @click="showModalEditAccount">Edit <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
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
                                <div><label>Name :</label><label class="text-white">{{ user.personal_information.full_name }}</label></div>
                                <div><label>Date of birth :</label><label class="text-white">{{ user.personal_information.date_of_birth }}</label></div>
                                <div><label>Gender :</label><label class="text-white">{{ user.personal_information.gender }}</label></div>
                                <div><label>Location :</label><label class="text-white">{{ user.personal_information.location }}</label></div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button @click="showModalEditPersonalDetails">Edit <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
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
                                <button @click="showModalEditPassword">Change Password <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
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
                    <div id="collapseFifth" class="collapse" aria-labelledby="headingFifth" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="d-flex flex-column text-center social-login">
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <img src="/images/icons/facebook.svg" alt="" class="icon">
                                    <a class="btn btn-social-media bg-facebook text-white rounded-pill font-weight-bold">link With facebook</a>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <img src="/images/icons/twitter.svg" alt="" class="icon">
                                    <a class="btn btn-social-media bg-twitter text-white rounded-pill font-weight-bold">Disconnect From Twitter</a>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <img src="/images/icons/google.svg" alt="" class="icon">
                                    <a class="btn btn-social-media c-fifth bg-white rounded-pill font-weight-bold">Link With Google</a>
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
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="flex-column">
                                <h3>Linked Other Noisesharks Proﬁles</h3>
                                <p>
                                    Link your personal proﬁle with the proﬁle of your band, vlog, podcast, or any other Noisesharks proﬁle
                                    that you are a part of.
                                </p>
                                <div class="d-flex justify-content-center main-header bg-black">
                                   <form action="/" class="header-form-search d-none d-md-block">
                                        <div class="form-group m-0">
                                            <div class="input-group">
                                                <input class="form-control pl-4" type="text" placeholder="Search for posts, hashtags, etc..." autocomplete="none">
                                                <div class="divider-vertical"></div>
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="17px" height="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve">
                                                <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594
                                                    C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488
                                                    l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719
                                                    s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>
                                                </svg>
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
        <modal-edit-account :user="user" />
        <modal-edit-password :user="user" />
        <modal-edit-personal-details :user="user" />

    </section>
</template>

<script>
import ModalEditAccount from './include/AccountSettings/ModalEditAccount'
import ModalEditPassword from './include/AccountSettings/ModalEditPassword'
import ModalEditPersonalDetails from './include/AccountSettings/ModalEditPersonalDetails'

export default {
    props:['user'],
    components:{
        ModalEditAccount,
        ModalEditPassword,
        ModalEditPersonalDetails
    },
    methods:{
        showModalEditAccount(){
            $('#ModalEditAccount').modal('show')
        },
        showModalEditPersonalDetails(){
            $('#ModalEditPersonalDetails').modal('show')
        },
        showModalEditPassword(){
            $('#ModalEditPassword').modal('show')
        }
    }

}
</script>
