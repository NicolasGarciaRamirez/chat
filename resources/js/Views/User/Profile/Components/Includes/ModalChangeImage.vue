<template>
  <section>
        <div class="modal fade modal-picture" tabindex="-1" role="dialog" aria-labelledby="ModalChangeImage" aria-hidden="true" id="ModalChangeImage">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center">
                        <h2 class="font-weight-bold p-4">Set {{$parent.type_change_image}} Image</h2>
                    </div>
                    <div class="d-flex text-center justify-content-center align-items-center">
                        <form enctype="multipart/form-data" @submit.prevent="save">
                            <cropper
                                classname="cropper"
                                :stencil-component="stencil"
                                :src="img"
                                @change="change"
                                :stencil-props="{
                                    handlers: {},
                                    scalable: false,
                                }"
                                :restrictions="pixelsRestriction"
                                v-if="$parent.type_change_image === 'Cover'"
                            ></cropper>
                            <cropper
                                classname="cropper"
                                :stencil-component="stencil"
                                :src="img"
                                @change="change"
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
                                v-if="$parent.type_change_image === 'Profile'"
                            ></cropper>
                            <div class="row p-4">
                                <div class="col col-sm text-left">
                                    <label class="font-weight-bold" >Use scroll or pinch to zoom</label>
                                </div>
                                <div class="col col-sm text-right">
                                    <button class="btn bg-primary text-white font-weight-bold" data-dismiss="modal" @click="windowReload">Cancel</button>
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
import Auth from "../../../../../helpers/Auth";

export default {
    components:{
        // Cropper
    },
    data(){
        return {
            disable: false,
            options: {

            },
            image:'',
            coordinates: ''
        }
    },
    mounted(){
    },
    computed:{
        img(){
            if (this.$parent.type_change_image === 'Releases'){
                console.log(this.$parent.type_change_image)
                return '/images/default.png'
            }else{
                return this.$parent.img
            }
        },
        stencil(){
            return this.$parent.type_change_image === 'Profile' ? 'circle-stencil' : 'rectangle-stencil'
        },
    },
    methods:{
        windowReload(){
            window.location.reload()
        },
        change({coordinates, canvas}) {
            this.coordinates = coordinates;
            this.resource = canvas.toDataURL()
        },
        pixelsRestriction() {
            return {
                maxWidth: 1080,
                maxHeight: 250,
            }
        },
        save(){
            this.disable = true
            let url = ''

            let request = new FormData()
            request.append('image', this.$parent.resource, this.$parent.resource.name)
            request.append('width', this.coordinates.width)
            request.append('height', this.coordinates.height)
            request.append('left', this.coordinates.left)
            request.append('top', this.coordinates.top)

            if (this.$parent.type_change_image === 'Profile') {
                url = `/User/Edit/Image/${this.$parent.user.username}/profile`
            }
            if (this.$parent.type_change_image === 'Cover') {
                url = `/User/Edit/Image/${this.$parent.user.username}/cover`
            }
            axios.post( url, request ).then(res => {
                try {
                    if (res.data.updated){
                        this.disable = false
                        Auth.remove()
                        Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar )
                        if (this.$parent.type_change_image === 'Profile') {
                            this.$parent.user.avatar = res.data.user.avatar
                        }
                        if(this.$parent.type_change_image === 'Cover'){
                            this.$parent.user.cover = res.data.user.cover
                        }
                        $('#ModalChangeImage').modal('toggle')
                        window.location.reload()
                    }else{
                        alert('error')
                    }
                } catch (error) {
                    console.log(error)
                }
            }).catch(err =>{
                this.disable = false
            })
        },
    }
}
</script>

<!--<style type="text/css">-->
<!--    .cropper{-->
<!--        max-width: 50rem !important;-->
<!--        min-width: 50rem !important;-->
<!--        max-height: 25rem !important;-->
<!--        min-height: 25rem !important;-->
<!--        background: #141414 !important;-->
<!--        @include media-break-point-->
<!--    }-->
<!--</style>-->
