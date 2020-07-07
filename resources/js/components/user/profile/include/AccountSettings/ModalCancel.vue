<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalCancel" aria-hidden="true" id="ModalCancel">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center p-5">
                        <form @submit.prevent="update">
                            <div class="d-flex flex-column">
                                <p>
                                    Are you sure you would like to stop being a Contributor?<br><br>
                                    By going ahead you wil lose all contributor rights and your earnings from your supporters! <br><br>
                                    You will become a free user where you will still be able to  post content but without making it exclusinve!
                                </p>
                                <div style="border-top: 1px solid #262626"></div>
                                <div class="text-center my-3 d-flex flex-row">
                                    <button class="bg-primary border-0 rounded-pill">No Stay A Contributor</button>
                                    <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="submit" v-if="!disable">Stop Beign a Contributor</button>
                                    <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
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
export default {
    props:['user'],
    data(){
        return{
            disable: false
        }
    },
    methods: {
        update(){
            this.disable = true
            axios.post(`/User/Settings/Update/${this.user.username}`, this.user).then(res =>{
                if (res.data.updated) {
                    alert('Has been update Information')
                    this.disable = false
                    window.location.reload()
                }
            }).catch(err =>{
                this.disable = false
                alert('Error')
                console.log(err)
            })
        }
    },
}
</script>
