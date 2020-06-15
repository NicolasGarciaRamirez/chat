<template>
  <section>
        <div class="modal fade modal-picture-profile" tabindex="-1" role="dialog" aria-labelledby="ModalChangeImageProfile" aria-hidden="true" id="ModalChangeImageProfile">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="text-center">
                        <h2 class="font-weight-bold p-4">Change Image Profile</h2>
                    </div>
                    <div class="d-flex text-center">
                        <form @submit.prevent="save">
                            <div id="image">
                                <img :src="imageData" alt="img-profile"  width="800" height="300">
                            </div>
                            <input type="file" class="" id="img" @change="previewImage">
                            <div class="text-right p-4">
                                <button class="btn bg-primary text-white" data-dismis="modal">Cancel</button>
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
import Cropper from 'cropperjs'

export default {
    props:['user'],
    components:{

    },
    data(){
        return {
            disable: false,
            imageData: this.user.avatar,
            avatar: '',
        }
    },
    mounted(){
        // this.getImage()
    },
    methods:{
        async previewImage(w){
            this.avatar = w.target.files[0]
            
            var input = w.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
            await this.getImage(w)
            
        },
        async getImage(w){
            this.user.avatar = w.target.files[0]
            var element = $('#image img')

            const cropper = new Cropper(element[0],{
                aspectRatio : 5 / 9 ,
                autoCrop: true,
                // viewMode: 3,
                // dragMode: 'crop',
                // modal: true,
                // center: true,
                // highlight: true,
                // background: true,
            })
            console.log(cropper)
        },
        save(){
            this.disable = true
            var avatar = new FormData()
            avatar.append('avatar', this.avatar, this.avatar.name)
        
            axios.post(`/User/Edit/imageProfile/${this.user.username}`, avatar ).then(res => {
                try {
                    if (res.data.updated){
                        this.disable = false
                        Auth.remove()
                        Auth.set(res.data.user.token, res.data.user.username, res.data.user.avatar )
                        console.log(res)
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