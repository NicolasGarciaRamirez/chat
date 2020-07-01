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
                        <h2 class="font-weight-bold p-4">Set Image {{ this.$parent.type_change_image }}</h2>
                    </div>
                    <div class="d-flex text-center justify-content-center align-items-center">
                        <form @submit.prevent="save">
                            <label for="img" class="text-center">
                                <img :src="imageData" alt="img-profile" id="img-profile" class="img-fluid cursor-pointer">
                            </label>
                            <input type="file" class="d-none" id="img" @change="previewImage">
                            <div class="text-right p-4">
                                <button class="btn bg-primary text-white" data-dismiss="modal">Cancel</button>
                                <button class="btn bg-fifth text-white" v-if="!disable">Save</button>
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
import Auth from '../../../../helpers/Auth'
import { Jcrop } from 'vue-jcrop';

export default {
    components:{
        Jcrop
    },
    data(){
        return {
            disable: false,
            imageData: this.$parent.user.avatar,
            resource: '',
            options:{
                multi: true,
                aspectRatio: 1
            },
            sel:{}
        }
    },
    mounted(){
       
    },
    methods:{
        async previewImage(w){
            this.resource = w.target.files[0]
            
            var input = w.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        },
        save(){
            this.disable = true
            var request = ''
            var url = ''
            if (this.$parent.type_change_image == 'Profile') {
                request = new FormData()
                request.append('image', this.resource, this.resource.name)
                url = `/User/Edit/imageProfile/${this.$parent.user.username}`
            }
            if (this.$parent.type_change_image == 'Cover') {
                request = new FormData()
                request.append('image', this.resource, this.resource.name)
                url = `/User/Edit/imageCover/${this.$parent.user.username}`
            }
            console.log(url)
            axios.post( url, request ).then(res => {
                try {
                    if (res.data.updated){
                        this.disable = false
                        Auth.remove()
                        Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar )
                        $('#ModalChangeImage').modal('toggle')
                        if (this.$parent.type_change_image == 'Profile') {
                            this.$parent.user.avatar = res.data.user.avatar
                        }
                        if(this.$parent.type_change_image == 'Cover'){
                            this.$parent.user.cover = res.data.user.cover
                        }
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