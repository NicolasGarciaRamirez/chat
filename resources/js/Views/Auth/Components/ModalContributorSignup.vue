<template>
    <div class="modal fade modal-register" role="dialog" aria-labelledby="ModalContributorSignup" aria-hidden="true"
         id="ModalContributorSignup">
        <div class="modal-dialog modal-dialog-centered register" role="document">
            <div class="modal-content modal-border-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-content modal-border-white ">
                    <div class="p-0 border-danger">
                        <img src="/images/contributor-signup.jpeg" alt="" class="img-fluid index">
                        <div class="bg-third flex-column text-white p-4 text-center content">
                            <h2 class="font-weight-bold">CONTRIBUTOR</h2><br>
                            <h2 class="c-fifth font-weight-bold m-0">FREE</h2>
                            <h5 class="c-fifth font-weight-bold m-0">UNTIL YOU START EARNING MONEY FROM USERS</h5>
                            <small class="c-fifth font-weight-bold m-0">(You don’t pay until you earn)</small><br><br>
                            <small class="my'2">It will be $6.99/m thereafter </small>
                            <div class="bg-thrid divider my-3 "></div>
                            <div class="align-items-start">
                                <img src="/images/icons/success.svg" alt="" class="float-left m-3">
                                <p class="text-left ">
                                    Full access to the stream and all social
                                    activities such as live streaming, posting
                                    content, interacting with users, and
                                    financially supporting Contributors.
                                </p>
                            </div>
                            <div>
                                <img src="/images/icons/success.svg" alt="" class="float-left m-3">
                                <p class="text-left my-3">
                                    Unlock the SUPPORT & REWARD buttons
                                    so that users can financially support you
                                </p>
                            </div>
                            <div>
                                <img src="/images/icons/success.svg" alt="" class="float-left m-3">
                                <p class="text-left ">
                                    0% Commision (Noisesharks doesn’t take
                                    a cut when you get supported or rewarded)
                                </p>
                            </div>
                            <button class="btn bg-fifth text-white my-3 font-weight-bold rounded-pill" @click="showModalForm">Become a Contributor</button>
                        </div>
                    </div>
                </div>
            </div>
            <modal-contributor-form />
        </div>
    </div>
</template>

<script>
import ModalContributorForm from './ModalContributorForm'
export default {
    components:{
        ModalContributorForm
    },
    methods:{
        showModalForm(){
            $('#ModalContributorForm').modal('show')
        }
    }
}
</script>
