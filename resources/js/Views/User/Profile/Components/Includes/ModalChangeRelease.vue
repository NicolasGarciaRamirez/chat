<template>
    <section>
        <div class="modal fade modal-picture" tabindex="-1" role="dialog" aria-labelledby="ModalChangeRelease" aria-hidden="true" id="ModalChangeRelease">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.$children[id_release+3].refreshCacheImage()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center">
                        <h4 class="font-weight-bold pt-0 pb-3 px-3 mb-0">Set Releases Image</h4>
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
                                        eastNorth: false,
                                        north: false,
                                        westNorth: false,
                                        west: false,
                                        westSouth: false,
                                        south: false,
                                        eastSouth: false,
                                        east: false,
                                    },
                                    resize: false,
                                    scalable:false
                                }"
                                ref="cropper"
                            ></cropper>
                            <div class="row p-3">
                                <div class="col col-sm text-left">
                                    <label class="font-weight-bold my-2" >Use scroll or pinch to zoom in/out</label>
                                </div>
                                <div class="col col-sm text-right">
                                    <button class="btn" data-dismiss="modal" @click="$parent.$children[id_release+3].refreshCacheImage()">Cancel</button>
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
                id_release:'',
            }
        },
        computed:{
            stencil(){
                return  'rectangle-stencil'
            },
        },
        mounted() {
            Auth.initialize()
        },
        methods:{
            change({coordinates, canvas}) {
                this.coordinates = coordinates;
            },
            pixelsRestriction() {
                return {
                    maxWidth: 500,
                    maxHeight: 500,
                }
            },
            async saveCrop(){
                await Auth.setSession()
                this.disable = true
                let formData = new FormData()
                formData.append('image', this.image, this.image.name)
                formData.append('width', this.coordinates.width)
                formData.append('height', this.coordinates.height)
                formData.append('left', this.coordinates.left)
                formData.append('top', this.coordinates.top)

                await axios.post(`/${Auth.state.username}/imageRelease/save`, formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(res =>{
                    if (res.data.saved_image){
                        this.disable = false
                        this.$parent.releases_information[this.id_release].image = res.data.image_name
                        $('#ModalChangeRelease').modal('toggle')
                        this.$parent.$children[this.id_release+3].refreshCacheImage()
                    }else{
                        this.disable = false
                    }
                }).catch(err => {
                    this.disable = false
                    console.log(err)
                    Auth.keepLogged(err.response.status)
                })
            }
        }
    }
</script>
