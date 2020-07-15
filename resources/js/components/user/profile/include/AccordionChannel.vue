<template>
    <section class="container-fluid edit-channel" ref="AccordionChannel">
        <div id="accordionChannel" class="accordion">
            <form>
                <div class="card">
                    <div class="card-header bg-black" id="headingOne">
                        <h2 class="mb-0 d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                Why Support Channel? (Contributors Only)
                            </button>
                            <i class="fas fa-angle-down text-white"></i>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionChannel">
                        <div class="card-body bg-black text-center">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor</button>
                            <p class="text-white">It’s <b>FREE!!</b> you only start paying when you start earining money from supporters (You don’t pay unless you earn)</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingTwo">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                Edit Monthly Goal (Contributors Only)
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionChannel">
                        <div class="card-body bg-black text-center">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor </button>
                            <p class="text-white">It’s <b>FREE!!</b> you only start paying when you start earining money from supporters (You don’t pay unless you earn)</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingThree">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                Edit Tiers (Contributors Only)
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse " aria-labelledby="headingThree" data-parent="#accordionChannel">
                        <div class="card-body bg-black text-center">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor </button>
                            <p class="text-white">It’s <b>FREE!!</b> you only start paying when you start earining money from supporters (You don’t pay unless you earn)</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingFourth">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseFourth" aria-expanded="false" aria-controls="collapseFourth">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Supporters (Contributors Only)
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseFourth" class="collapse " aria-labelledby="headingFourth" data-parent="#accordionChannel">
                        <div class="card-body bg-black text-center">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor </button>
                            <p class="text-white">It’s <b>FREE!!</b> you only start paying when you start earining money from supporters (You don’t pay unless you earn)</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingFifth">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseFifth">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Rewards (Contributors Only)
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseFifth" class="collapse " aria-labelledby="headingFifth" data-parent="#accordionChannel">
                        <div class="card-body bg-black text-center">
                            <button type="button" class="m-2 btn bg-fifth text-white rounded-pill font-weight-bold" @click="showModalContributor">Become a Contributor </button>
                            <p class="text-white">It’s <b>FREE!!</b> you only start paying when you start earining money from supporters (You don’t pay unless you earn)</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black cursor-pointer" id="headingSix" @click="showModalRelathions('followers')">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <button type="button" class="btn btn-link text-white  font-weight-bold" >
                                View Followers
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingSeven">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Supporting
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse " aria-labelledby="headingSeven" data-parent="#accordionChannel">
                        <div class="card-body bg-black">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black" id="headingEight">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Rewarded
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseEight" class="collapse " aria-labelledby="headingEight" data-parent="#accordionChannel">
                        <div class="card-body bg-black">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-black cursor-pointer" id="headingNine" @click="showModalRelathions('following')">
                        <h2 class="mb-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            <button type="button" class="btn btn-link text-white font-weight-bold">
                                View Following
                            </button>
                            <i class="fas fa-angle-down text-white float-right"></i>
                        </h2>
                    </div>
                    <div id="collapseNine" class="collapse " aria-labelledby="headingNine" data-parent="#accordionChannel">
                        <div class="card-body bg-black">

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center text-center m-5">
                    <button class="btn rounded-pill bg-black text-white">Cancel</button>
                    <button class="btn rounded-pill text-white bg-fifth" type="submit">Save</button>
                </div>
            </form>
        </div>
        <modal-contributor />
        <modal-comming-contributor />
        <modal-relathions></modal-relathions>
    </section>
</template>

<script>
import ModalContributor from '../../../auth/include/ModalContributorSignup'
import ModalCommingContributor from '../../../ModalsCommingSoon/ModalContributor'
import ModalRelathions from "./ModalRelathions";

export default {
    props:['user'],
    components: {
        ModalContributor,
        ModalCommingContributor,
        ModalRelathions
    },
    data(){
        return {
            type_table: '',
            channel: {
                support: '',
                monthly_goal: '',
                tier_name: '',
                tier_amount: '',
                tier_description: ''
            }
        }
    },
    methods: {
        showModalRelathions(type){
            console.log(type)
            this.type_table = type
            $('#ModalRelathions').modal({
                backdrop: false,
                keyboard: true
            })
        },
        showModalContributor(){
            // $('#ModalContributorSignup').modal('show')
            $('#ModalContributor').modal('show')
        },
        save(){
            axios.post(`/User/Free/profile/save/${this.user}` , this.channel).then(res => {
                console.log(res)
            }).catch(err => {
                console.log(err)
            })
        }
    }


}
</script>
