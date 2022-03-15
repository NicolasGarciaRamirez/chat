<template>
  <section>
        <div class="modal fade modal-picture" tabindex="-1" role="dialog" aria-labelledby="ModalChangeImage" aria-hidden="true" id="ModalChangeImage">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.refreshCacheImage()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center">
                        <h4 class="font-weight-bold pb-3 px-3 pt-0 mb-0">Set {{$parent.type_change_image}} Image</h4>
                    </div>
                    <div class="d-flex text-center justify-content-center align-items-center">
                        <form enctype="multipart/form-data" @submit.prevent="save">
                            <cropper
                                classname="cropper"
                                :stencil-component="stencil"
                                :src="img"
                                @change="change"
                                :stencil-props="{
                                    handlers: {
                                        eastNorth: true,
                                        north: true,
                                        westNorth: true,
                                        west: true,
                                        westSouth: true,
                                        south: true,
                                        eastSouth: true,
                                        east: true,
                                    },
                                    scalable: true,
                                     aspectRatio: 23/6
                                }"
                                v-if="$parent.type_change_image === 'Cover'"
                            ></cropper>
                            <cropper
                                classname="cropper"
                                :stencil-component="stencil"
                                :src="img"
                                @change="change"
                                :stencil-props="{}"
                                v-if="$parent.type_change_image === 'Profile'"
                            ></cropper>
                            <div class="row p-3">
                                <div class="col col-sm text-left">
                                    <label class="font-weight-bold my-2">Use scroll or pinch to zoom in/out</label>
                                </div>
                                <div class="col col-sm text-right">
                                    <button class="btn" data-dismiss="modal" @click="$parent.refreshCacheImage">Cancel</button>
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
        Auth.initialize()
    },
    computed:{
        img(){
            if (this.$parent.type_change_image === 'Releases'){
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
        save(){
            Auth.setSession()
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
                        $('#ModalChangeImage').modal('hide')
                        this.$parent.refreshCacheImage()
                    }else{
                        alert('error')
                    }
                } catch (error) {
                    console.log(error)
                }
            }).catch(err =>{
                this.disable = false
                Auth.keepLogged(err.response.status)
            })
        },
    }
}
</script>
