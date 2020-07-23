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
                                }"
                            ></cropper>
                            <div class="row p-4">
                                <div class="col col-sm text-left">
                                    <label class="font-weight-bold" >Use scroll or pinch to zoom</label>
                                </div>
                                <div class="col col-sm text-right">
                                    <button class="btn bg-primary text-white font-weight-bold" data-dismiss="modal" >Cancel</button>
                                    <button class="btn bg-fifth rounded-pill text-white font-weight-bold" v-if="!disable">Save</button>
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
        name: "ModalChangeRelease",
        data(){
            return {
                disable: false,
                image:'',
                coordinates: '',
                img:''
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
                this.resource = canvas.toDataURL()
            },
            pixelsRestriction() {
                return {
                    minWidth: 250,
                    minHeight: 250,
                    maxWidth: 1080,
                    maxHeight: 1080,
                }
            },
        }

    }
</script>

<style scoped>

</style>
