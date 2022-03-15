<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalCancel" aria-hidden="true" id="ModalCancel">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <h3 class="ml-auto"><b>Downgrade Account?</b></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center p-3">
                        <form @submit.prevent="update">
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-start">
                                    <p>
                                        Are you sure you would like to stop being a Contributor? <br><br>
                                        By going ahead you wil lose all contributor rights and your earnings from your supporters! <br><br>
                                        You will become a free user where you will still be able to  post content but without making it exclusinve!
                                    </p>
                                </div>
                                <div style="border-top: 1px solid #262626"></div>

                                <div class="d-flex flex-row justify-content-end text-center my-3">
                                    <button type="button" class="btn border-0 rounded-pill" data-dismiss="modal">No Stay A Contributor</button>
                                    <button type="submit"  class="btn rounded-pill text-white bg-fifth font-weight-bold" v-if="!disable">Stop Beign a Contributor</button>
                                    <button type="button" class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Auth from "../../../../helpers/Auth";

export default {
    props:['user'],
    data(){
        return{
            disable: false
        }
    },
    mounted() {
        Auth.initialize()
    },
    methods: {
        update(){
            swal({
                title: 'Final Warning',
                text: 'You are about to downgrade from a contributor account to a free account,\n' +
                    'that will cancel all and any support that you are getting.\n' +
                    'Your posts and profile will no longer have the SUPPORT and REWARD buttons.',
                icon: 'warning',
                buttons: ['No, Stay A Contributor', 'Stop Beign A Contributor'],
                dangerMode: true
            }).then((willDelete)=>{
                if(willDelete){
                    Auth.setSession()
                    this.disable = true
                    this.user.contributor_type = 'FREE'
                    this.user.subscription_type = null
                    axios.post(`/User/Settings/Update/${this.user.username}`, this.user).then(res =>{
                        if (res.data.updated) {
                            swal('Has been update Information')
                            this.disable = false
                            window.location.reload()
                        }
                    }).catch(err =>{
                        this.disable = false
                        Auth.keepLogged(err.response.status)
                    })
                }
            })

        }
    },
}
</script>
