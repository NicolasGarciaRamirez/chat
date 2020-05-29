<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalEditPersonalDetails" aria-hidden="true" id="ModalEditPersonalDetails">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4 justify-content-center px-5 pb-5">
                        <form @submit.prevent="update">
                            <div class="d-flex flex-column my-2">
                                <div class="d-flex flex-column ">
                                    <label class="font-weight-bold">First Name*:</label>
                                    <div class="d-flex flex-row justify-content-center">
                                        <input type="text" class="form-control w-75 my-2" placeholder="First Name" v-model="data.first_name">
                                    </div>
                                </div>
                                <div class="d-flex flex-column my-3">
                                    <label class="font-weight-bold">Last Name*:</label>
                                    <div class="d-flex flex-row justify-content-center">
                                        <input type="text" class="form-control w-75 my-2" placeholder="Last Name" v-model="data.last_name">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <label class="font-weight-bold">Date Of Birth:</label>
                                    <div class="d-flex flex-row justify-content-center">
                                        <input type="date" name="date" class="form-control w-75 my-2" v-model="data.date_of_birth">
                                    </div>
                                </div>
                                <div class="d-flex flex-column my-3">
                                    <label class="font-weight-bold ">Gender:</label>
                                    <div class="d-flex flex-row justify-content-center select my-2">
                                        <select name="gender" class="select-form text-white" v-model="data.gender">
                                            <option value="N/A">N/A</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <label class="font-weight-bold">Location:</label>
                                    <div class="d-flex flex-row justify-content-center">
                                        <input type="text" class="form-control w-75 my-2" placeholder="Location" v-model="data.location">
                                    </div>
                                </div>
                            </div>
                            <div style="border-top: 1px solid #262626"></div>
                            <div class="text-center my-3">
                                <button class="bg-primary border-0 rounded-pill">Cancel</button>
                                <button class="btn rounded-pill text-white bg-fifth font-weight-bold" type="submit" v-if="!disable">Save</button>
                                <button class="btn rounded-pill text-white bg-fifth" v-if="disable" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                </button>
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
        return {
            disable: false,
            data:{
                first_name:'',
                last_name:'',
                full_name: '',
                date_of_birth:'',
                gender:'',
                location:''
            }
        }
    },
    mounted(){
        this.getData()
    },
    methods:{
        getData(){
            this.data = this.user.personal_information
        },
        update(){
            this.disable = true
            this.data.full_name = this.data.first_name+' '+this.data.last_name
            axios.post(`/User/Settings/Personal/Update/${this.user.username}`, this.data).then(res => {
                if (res.data.updated) {
                    alert('Has been information updated')
                    window.location.reload()
                }
            }).catch(err =>{
                alert('Error')
                console.log(err)
            })
        }
    }

}
</script>