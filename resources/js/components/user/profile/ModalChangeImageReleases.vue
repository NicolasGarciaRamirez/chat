<template>
    <section>
        <div class="modal fade modal-picture" tabindex="-1" role="dialog" aria-labelledby="ModalChangeImageReleases" aria-hidden="true" id="ModalChangeImageReleases">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center">
                        <h2 class="font-weight-bold p-4">Set Release Image</h2>
                    </div>
                    <div class="d-flex text-center justify-content-center align-items-center">
                        <form enctype="multipart/form-data" @submit.prevent="save">
                            <cropper
                                classname="cropper"
                                :src="img"
                                @change="change"
                            ></cropper>
                            <div class="text-right p-4">
                                <button class="btn bg-primary text-white font-weight-bold" data-dismiss="modal">Cancel</button>
                                <button class="btn bg-fifth rounded-pill text-white font-weight-bold" v-if="!disable">Save</button>
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
        props:[''],
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
            console.log(
                this.$parent
            )
        },
        computed:{
            img(){
                return this.$parent.img
            },
            stencil(){
                return 'rectangle-stencil'
            },
        },
        methods:{
            change({coordinates, canvas}) {
                this.coordinates = coordinates;
                this.resource = canvas.toDataURL()
            },
            save(){

            }
        }
    }
</script>

