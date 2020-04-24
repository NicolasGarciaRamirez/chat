<template>
    <div class="modal fade register" role="dialog" aria-labelledby="ModalContributorSingup" aria-hidden="true" id="ModalContributorSingup">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white ">
                <div class="p-0">
                   <div class="bg-third flex-column text-white border-danger p-4 text-center content">
                        <h4 class="mt-5">CONTRIBUTOR</h4><br>
                        <h2 class="c-fifth">FREE</h2>
                        <h5 class="c-fifth">UNTIL YOU START EARNING MONEY FROM USERS</h5>
                        <small class="c-fifth my-3">(You don’t pay until you earn)</small><br>
                        <small>It will be $6.99/m thereafter </small>
                        <div class="divider my-3"></div>
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
                        <button class="btn bg-fifth text-white my-3" @click="showModalForm">BECOME A CONTRIBUTOR</button>
                    </div>
                </div>
            </div>
        </div>
        <modal-contributor-form />
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