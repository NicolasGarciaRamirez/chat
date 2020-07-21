<template>
    <section>
        <div class="modal fade modal-personal" tabindex="-1" role="dialog" aria-labelledby="ModalAlert" aria-hidden="true" id="ModalAlert">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="d-flex flex-column text-white">
                            <h5 class="font-weight-bold text-center">Choose A Title</h5>
                            <p class="text-center c-fourth my-3 ">
                                You must choose a Profile Type and Title in order for you to post your content!
                            </p>
                            <div class="divider c-fourth my-3"></div>
                            <h5 class="font-weight-bold text-left my-3">Please Choose Profile Type</h5>
                            <div class="row text-center checkbox my-3">
                                <div class="col-md">
                                    <input type="radio" name="" id="personProject" class="m-2" value="A Person or A Project" v-model="profile_information.profile_type" required>
                                    <label for="personProject"><span>A person or A Project</span></label>
                                </div>
                                <div class="col-md">
                                    <input type="radio" id="aBand" value="A Band" v-model="profile_information.profile_type" required>
                                    <label for="aBand"><span>A Band</span></label>
                                </div>
                            </div>
                            <h5 class="font-weight-bold text-left my-3">Please Choose Title</h5>
                            <div class="select text-center">
                                <select class="select-form font-weight-bold" v-model="profile_information.title">
                                    <option value="Select Title" selected>Select Profile Type</option>
                                    <optgroup  v-if="profile_information.profile_type == 'A Person or A Project'">
                                        <option value="Vlog Channel">Vlog Channel</option>
                                        <option value="Podcast">Podcast</option>
                                        <option value="Composer">Composer</option>
                                        <option value="Vocal Coach">Vocal Coach</option>
                                        <option value="Mixing Engineer">Mixing Engineer</option>
                                        <option value="Music Producer">Music Producer</option>
                                        <option value="Mastering Engineer">Mastering Engineer</option>
                                        <option value="Recording Engineer">Recording Engineer</option>
                                        <option value="Sound Designer">Sound Designer</option>
                                        <option value="Instrument Tutor">Instrument Tutor</option>
                                        <option value="Rapper">Rapper</option>
                                        <option value="Singer">Singer</option>
                                        <option value="Singer Songwriter">Singer Songwriter</option>
                                        <option value="Guitarist">Guitarist</option>
                                        <option value="Drummer">Drummer</option>
                                        <option value="Bassist">Bassist</option>
                                        <option value="Keyboardist">Keyboardist</option>
                                        <option value="DJ">DJ</option>
                                        <option value="Beatmaker">Beatmaker</option>
                                        <option value="Music Studio">Music Studio</option>
                                        <option value="Manager">Manager</option>
                                        <option value="A&R">A&R</option>
                                    </optgroup>
                                    <optgroup v-if="profile_information.profile_type == 'A Band'">
                                        <option value="Band">Band</option>
                                        <option value="Duet">Duet</option>
                                        <option value="Orchestra">Orchestra</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="divider c-fourth my-5"></div>
                            <div class="d-flex flex-row justify-content-end mb-2">
                                <button class="btn rounded-pill font-weight-bold text-white bg-primary mx-2" data-dismiss="modal">Cancel</button>
                                <button class="btn rounded-pill font-weight-bold text-white bg-fifth" data-dismiss="modal" @click="saveProfileInformation">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    export default {
        props:['user'],
        components:{

        },
        data(){
            return {
                profile_information:{
                    profile_type:'',
                    title:'',
                }
            }
        },
        mounted() {
            Auth.initialize()
        },
        methods:{
            saveProfileInformation(){
                axios.post(`/${Auth.state.username}/Update`, this.profile_information).then(res =>{
                    console.log(res)
                    if(res.data.updated){
                        this.$toasted.show('The profile information has been updated successfully!', {
                            position: "bottom-right",
                            duration : 4000,
                            className: "p-4 notification bg-primary",
                            keepOnHover: true
                        })
                    }
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
