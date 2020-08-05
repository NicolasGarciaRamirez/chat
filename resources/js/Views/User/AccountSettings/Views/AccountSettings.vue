<template>
    <section>
        <div class="container-fluid account-settings">
            <h2 class="text-center my-5 font-weight-bold">Account Settings</h2>
            <div id="accordionAccountSettings" class="accordion">
                <div class="card">
                    <div class="card-header bg-black" id="headingOne">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <img class="icon" src="/images/icons/house.svg" />
                            <button type="button" class="btn btn-link text-white font-weight-bold">Account Overview</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="c-fourth flex-column d-flex justify-content-center mx-lg-5">
                                <div><label>Accont Type: </label><b class="c-fifth font-weight-bold mx-1">{{user.subscription_type}}</b></div>
                                <div><label>Joined: </label><b class="text-white mx-1">{{ user.created_at }}</b></div>
                                <div><label>Email: </label><b class="text-white mx-1">{{ user.email }}</b></div>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <button @click="showModalEditAccount" class="border-white font-weight-bold action text-white">Edit <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingTwo">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <img class="icon" src="/images/icons/user-pencil.svg" />
                            <button type="button" class="btn btn-link text-white font-weight-bold">Personal Details</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="c-fourth d-flex flex-column mx-lg-5">
                                <div><label>Name: </label><label class="text-white mx-1">{{ user.personal_information.full_name }}</label></div>
                                <div><label>Date of birth: </label><label class="text-white mx-1">{{ user.personal_information.date_of_birth }}</label></div>
                                <div><label>Gender: </label><label class="text-white mx-1">{{ user.personal_information.gender }}</label></div>
                                <div><label>Location: </label><label class="text-white mx-1">{{ user.personal_information.location }}</label></div>
                            </div>
                            <div class="d-flex justify-content-center my-2">
                                <button @click="showModalEditPersonalDetails" class="border-white font-weight-bold text-white action">Edit <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="user.subscription_type == 'CONTRIBUTOR'">
                    <div class="card">
                        <div class="card-header bg-black" id="headingSubscriptionSettings" @click="showModalGeneralCommingSoon">
                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseSubscriptionSettings" aria-expanded="false" aria-controls="collapseSubscriptionSettings">
                                <img class="icon" src="/images/icons/user-pencil.svg" />
                                <button type="button" class="btn btn-link text-white font-weight-bold">Subscription Settings</button>
                                <i class="fas fa-angle-up float-right"></i>
                            </h2>
                        </div>
                        <div id="collapseSubscriptionSettings" class="collapse"
                        aria-labelledby="headingSubscriptionSettings" data-parent="#accordionAccountSettings">
                            <div class="card-body bg-black">
                                <div class="c-fourth flex-column mx-5">
                                    <div><label>Amount :</label><label class="text-white">$7.99</label></div>
                                    <div><label>Subscription Started :</label><label class="text-white">Yes</label></div>
                                    <div><label>Subscription Start Date :</label><label class="text-white">16/11/2020</label></div>
                                    <div><label>Payment Cycle :</label><label class="text-white">the 1st of every month</label></div>
                                    <div><label>Payment Method :</label><label class="text-white">****1234 Bank Account</label></div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button @click="showModalSubscriptionEdit">Edit <i class="fas fa-pencil-alt rounded-pill ml-2 action"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" v>
                    <div class="card-header bg-black" id="headingThree">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <img class="icon" src="/images/icons/payment.svg" />
                            <button type="button" class="btn btn-link text-white font-weight-bold">Your Payments</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="row text-justify">
                                <div class="table-responsive mx-5">
<!--                                    <table class="table bg-black text-white">-->
<!--                                        <thead>-->
<!--                                            <tr>-->
<!--                                                <th>Date</th>-->
<!--                                                <th>Type</th>-->
<!--                                                <th>To Who?</th>-->
<!--                                                <th>Amount</th>-->
<!--                                                <th>Invoice</th>-->
<!--                                                <th>Cancel</th>-->
<!--                                            </tr>-->
<!--                                        </thead>-->
<!--                                        <tbody>-->
<!--                                            <tr>-->
<!--                                                <td>01/11/2019</td>-->
<!--                                                <td>NS Free</td>-->
<!--                                                <td><img /> Henrry cadbury</td>-->
<!--                                                <td>$7.00</td>-->
<!--                                                <td><img src="/images/icons/payment.svg" class="icon" /></td>-->
<!--                                                <td><i class="fas fa-times-circle c-fifth pointer" @click="showModalCancel"></i></td>-->
<!--                                            </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="user.subscription_type === 'CONTRIBUTOR'">
                    <div class="card">
                        <div class="card-header bg-black" id="headingEarnings">
                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseEarnings" aria-expanded="false" aria-controls="collapseEarnings">
                                <img class="icon" src="/images/icons/change-password.svg" />
                                <button type="button" class="btn btn-link text-white font-weight-bold">Support Earnings</button>
                                <i class="fas fa-angle-up float-right"></i>
                            </h2>
                        </div>
                        <div id="collapseEarnings" class="collapse" aria-labelledby="headingEarnings" data-parent="#accordionAccountSettings">
                            <div class="card-body bg-black">
                                <div class="c-fourth flex-column mx-5">
                                    <div><label>Total Lifetime Earnings:</label><label class="text-white">$12,546.00</label></div>
                                    <div><label>Current Money In Pot:</label><label class="text-white">$600.00</label></div>
                                    <div><label>Money Released To You:</label><label class="text-white">The 3rd of every month.</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-black" id="headingFourth">
                            <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="false" aria-controls="collapseFourth">
                                <img class="icon" src="/images/icons/change-password.svg" />
                                <button type="button" class="btn btn-link text-white font-weight-bold">Reward Earnings</button>
                                <i class="fas fa-angle-up float-right"></i>
                            </h2>
                        </div>
                        <div id="collapseFourth" class="collapse" aria-labelledby="headingFourth" data-parent="#accordionAccountSettings">
                            <div class="card-body bg-black">
                                <div class="c-fourth flex-column mx-5">
                                    <div><label>Total Lifetime Rewards:</label><label class="text-white">$1005.00</label></div>
                                    <div><label>Total Rewards This Calendar Month:</label><label class="text-white">$65.00</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-black" id="headingSeven">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <img class="icon" src="/images/icons/change-password.svg" />
                            <button type="button" class="btn btn-link text-white font-weight-bold">Change Password</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse"
                    aria-labelledby="headingSeven" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="d-flex justify-content-center">
                                <button @click="showModalEditPassword" class="border-white font-weight-bold action">Change Password <i class="fas fa-pencil-alt rounded-pill ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingFifth">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                            <img class="icon" src="/images/icons/linked-social-media.svg" />
                            <button type="button" class="btn btn-link text-white font-weight-bold">Linked Social Media</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseFifth" class="collapse" aria-labelledby="headingFifth" data-parent="#accordionAccountSettings">
                        <div class="card-body bg-black">
                            <div class="d-flex flex-column text-center social-login">
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <img src="/images/icons/facebook.svg" alt="" class="icon">
                                    <a href="/auth/facebook" class="btn btn-social-media bg-facebook text-white rounded-pill font-weight-bold">{{ auth_facebook == 'FacebookProvider' ? 'Disconnect From Facebook'  : 'Link With Facebook' }}</a>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <img src="/images/icons/twitter.svg" alt="" class="icon">
                                    <a href="/auth/twitter" class="btn btn-social-media bg-twitter text-white rounded-pill font-weight-bold">{{ auth_twitter  == 'TwitterProvider' ? 'Disconnect From Twitter'  : 'Link With Twitter' }}</a>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <img src="/images/icons/google.svg" alt="" class="icon">
                                    <a href="/auth/google" class="btn btn-social-media c-fifth bg-white rounded-pill font-weight-bold">{{ auth_google == 'GoogleProvider' ? 'Disconnect From Google'  : 'Link With Google' }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingSix">
                        <h2 class="mb-0" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <img class="icon" src="/images/icons/linked-other-profile.svg" />
                            <button type="button" class="btn btn-link text-white font-weight-bold" @click="showModalGeneralCommingSoon">Linked Other Noisesharks Profiles</button>
                            <i class="fas fa-angle-up float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionAccountSettings">
<!--                        <div class="card-body bg-black">-->
<!--                            <div class="flex-column">-->
<!--                                <h3>Linked Other Noisesharks Proﬁles</h3>-->
<!--                                <p>-->
<!--                                    Link your personal proﬁle with the proﬁle of your band, vlog, podcast, or any other Noisesharks proﬁle-->
<!--                                    that you are a part of.-->
<!--                                </p>-->
<!--                                <div class="d-flex justify-content-center main-header bg-black">-->
<!--                                   <form action="/" class="header-form-search d-none d-md-block">-->
<!--                                        <div class="form-group m-0">-->
<!--                                            <div class="input-group">-->
<!--                                                <input class="form-control pl-4" type="text" placeholder="Search for posts, hashtags, etc..." autocomplete="none">-->
<!--                                                <div class="divider-vertical"></div>-->
<!--                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"-->
<!--                                                    width="17px" height="17px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve">-->
<!--                                                <path fill="#545454" d="M798.209,701.259c53.341-73.104,85.239-162.767,85.239-260.073c0-243.442-197.52-441.594-440.232-441.594-->
<!--                                                    C200.428-0.408,2.912,197.743,2.912,441.186c0,243.584,197.516,441.594,440.304,441.594c96.966,0,186.461-31.987,259.221-85.488-->
<!--                                                    l288.434,289.301l95.771-96.104L798.209,701.259z M443.216,746.904c-168.083,0-304.792-137.148-304.792-305.719-->
<!--                                                    s136.709-305.719,304.792-305.719c168.009,0,304.792,137.148,304.792,305.719S611.226,746.904,443.216,746.904"/>-->
<!--                                                </svg>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </form>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <modal-edit-account :user="user" />
        <modal-edit-password :user="user" />
        <modal-edit-personal-details :user="user" />
        <modal-cancel :user="user" />
        <modal-general-soon></modal-general-soon>
    </section>
</template>

<script>
import ModalEditAccount from "../Components/ModalEditAccount";
import ModalEditPassword from "../Components/ModalEditPassword";
import ModalEditPersonalDetails from "../Components/ModalEditPersonalDetails";
import ModalCancel from "../Components/ModalCancel";
import ModalGeneralSoon from "../../../CommingSoon/Components/GeneralCommingSoon";

export default {
    props:['user'],
    components:{
        ModalEditAccount,
        ModalEditPassword,
        ModalEditPersonalDetails,
        ModalCancel,
        ModalGeneralSoon
    },
    data(){
        return {
            auth_facebook : '',
            auth_twitter : '',
            auth_google : ''
        }
    },
    mounted(){
        if (this.user.social_auth) {
            this.user.social_auth.map(auth =>{
                if (auth.provider == 'FacebookProvider') {
                    this.auth_facebook = auth.provider
                }
                if (auth.provider == 'TwitterProvider') {
                    this.auth_twitter = auth.provider
                }
                if (auth.provider == 'GoogleProvider') {
                    this.auth_google = auth.provider
                }
            })
        }
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
        },
        showModalCancel(){
            $('#ModalCancel').modal('show')
        },
        showModalGeneralCommingSoon(){
            $('#ModalGeneralCommingSoon').modal('show')
        }
    }

}
</script>
