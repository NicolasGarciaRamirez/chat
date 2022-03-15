<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalSuccessMail" aria-hidden="true" data-backdrop="static" id="ModalSuccessMail">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <h3 class="text-center mx-auto mb-0"><b class="c-seven">Fantastic! <br>We’ve recieved your application </b></h3>
                    <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body border-0 py-0">
                    <p>We are recieving tons of applications at the moment, and we
                        would like to keep it steady so that our growth stays healthy!</p>

                    <p>We will contact you as soon your invite becomes ready!</p>
                    <div>
                        <p class="text-center or c-white text-and-dividers mb-0">⏰ While you wait</p>
                    </div>
                    <div class="invitation-table">
                        <div class="mb-2 invitation-table_row">
                             <p class="invitation-table_left">🦈</p>
                             <p class="invitation-table_right">Create a free account and enjoy discovering and
                             supporting other Noisesharks</p>
                        </div>
                        <div class="mb-2 invitation-table_row">
                            <p class="invitation-table_left">📺</p>
                            <p class="invitation-table_right">Start uploading your content so that you have a strong
                            channel once you recieve your invitation and become a
                            contributor!</p>
                        </div>
                        <div class="mb-2 invitation-table_row">
                           <p class="invitation-table_left">📢</p>
                           <p class="invitation-table_right">Invite your friends to discover Noisesharks and apply for
                           invitations!</p>
                        </div>
                        <div class="mb-2 invitation-table_row">
                           <p class="invitation-table_left">💖</p>
                           <p class="invitation-table_right">Choose to Opt-in and support our startup! If you believe in
                            our misson to change how music content is consumed,
                            then best way to support Noisesharks is by choosing to
                            pay the refundabe $10 joining fee which will let you skip
                            the invitation process.
                            We will refund your joining fee in full within 30 days if you
                            decideed to stop being a contributor! Just email
                            <strong>support@noisesharks.com</strong></p>
                        </div>  
                    </div>    
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-bg-degrad rounded-pill my-3 mx-auto w-14rem" @click="redirect('/Register/Contributor/Percentage')">Support Noisesharks</button>
                    </div>
                </div>
                <div class="divider w-75"></div>
                <div class="modal-footer border-0 pt-0 pb-3">
                    <div class="d-flex flex-row justify-content-end align-items-center">
                        <button type="button" class="btn " data-dismiss="modal" aria-label="Close">Close</button>
                        <button type="button" class="btn bg-fifth rounded-pill px-2 w-10rem" @click="redirect('/Register/Free')">Create a free profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalSuccessMail",
        data(){
            return {

            }
        },
        methods:{
            redirect(url){
                window.location.replace(url)
            }
        }
    }
</script>

<style scoped>

</style>
