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
                    <div class="modal-body justify-content-center px-5 py-0">
                    <h4 class="mb-3 text-center font-weight-bold">Personal Details</h4>
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
                                    <div class="dropdown mb-2 dropdown-sm mx-auto" >
                                        <div :class="`dropdown-btn border-0 py-2 ${data.gender ? '' : 'dropdown-required'}`" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 303px">
                                            <b> {{ data.gender ? (data.gender.length >= 10) ? data.gender.substring(0, 10) + '...' : data.gender : 'Gender:' }} </b>
                                            <div class="icon">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                            </div>
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdown">
                                            <div class="dropdown-item" @click="data.gender = 'N/A'">N/A</div>
                                            <div class="dropdown-item" @click="data.gender = 'Male'">Male</div>
                                            <div class="dropdown-item" @click="data.gender = 'Female'">Female</div>
                                            <div class="dropdown-item" @click="data.gender = 'Other'">Other</div>
                                        </div>
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
                            <div class="text-right my-3">
                                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
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
import Auth from "../../../../helpers/Auth";

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
        Auth.initialize()
    },
    methods:{
        getData(){
            this.data = this.user.personal_information
        },
        async update(){
            await Auth.setSession()
            this.disable = true
            this.data.full_name = this.data.first_name+' '+this.data.last_name
            axios.post(`/User/Settings/Personal/Update/${this.user.username}`, this.data).then(res => {
                if (res.data.updated) {
                    this.$parent.user.personal_information = this.data
                    this.disable = false
                    $('#ModalEditPersonalDetails').modal('toggle')
                    this.$toasted.show('Details Updated Successfully!', {
                        position: "bottom-right",
                        duration : 40000,
                        className: "notification",
                        keepOnHover: true,
                        action: {
                            text:'x',
                            onClick:(e, toast) => {
                                toast.goAway(0);
                            }
                        }
                    })
                }
            }).catch(err =>{
                this.disable = false
                swal('Error')
                Auth.keepLogged(err.response.status)
            })
        }
    }

}
</script>
