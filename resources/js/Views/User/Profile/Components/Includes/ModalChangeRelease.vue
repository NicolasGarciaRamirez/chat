<template>
    <section>
        <div class="modal fade modal-picture" tabindex="-1" role="dialog" aria-labelledby="ModalChangeRelease" aria-hidden="true" id="ModalChangeRelease">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center">
                        <h2 class="font-weight-bold p-4">Set Releases Image</h2>
                    </div>
                    <div class="d-flex text-center justify-content-center align-items-center">
                        <form enctype="multipart/form-data" >
                            <cropper
                                classname="cropper"
                                :stencil-component="stencil"
                                :src="img"
                                @change="change"
                                :restrictions="pixelsRestriction"
                                :stencil-props="{
                                    handlers: {
                                        eastNorth: true,
                                        north: false,
                                        westNorth: true,
                                        west: false,
                                        westSouth: true,
                                        south: false,
                                        eastSouth: true,
                                        east: false,
                                    },
                                    resize: false
                                }"
                                ref="cropper"
                            ></cropper>
                            <div class="row p-4">
                                <div class="col col-sm text-left">
                                    <label class="font-weight-bold" >Use scroll or pinch to zoom</label>
                                </div>
                                <div class="col col-sm text-right">
                                    <button class="btn bg-primary text-white font-weight-bold" data-dismiss="modal" >Cancel</button>
                                    <button type="button" class="btn bg-fifth rounded-pill text-white font-weight-bold" v-if="!disable" @click="saveCrop">Save Crop</button>
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
    import Auth from "../../../../../helpers/Auth";

    export default {
        name: "ModalChangeRelease",
        data(){
            return {
                disable: false,
                image:'',
                coordinates: '',
                img:'',
                id_release:''
            }
        },
        computed:{
            stencil(){
                console.log(this.$parent)
                return  'rectangle-stencil'
            },
        },
        methods:{
            change({coordinates, canvas}) {
                this.coordinates = coordinates;
            },
            pixelsRestriction() {
                return {
                    minWidth: 350,
                    minHeight: 350,
                    maxWidth: 350,
                    maxHeight: 350,
                }
            },
            async saveCrop(){
                let formData = new FormData()
                formData.append('image', this.image, this.image.name)
                formData.append('width', this.coordinates.width)
                formData.append('height', this.coordinates.height)
                formData.append('left', this.coordinates.left)
                formData.append('top', this.coordinates.top)

                await axios.post(`/${Auth.state.username}/imageRelease/save`, formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(res =>{
                    console.log(res)
                    if (res.data.saved_image){
                        this.$parent.releases_information[this.id_release].image = res.data.image_name
                        $('#ModalChangeRelease').modal('toggle')
                    }
                }).catch(err => {
                    console.log(err)
                })

            }
        }
    }
</script>

<style scoped>

</style>
