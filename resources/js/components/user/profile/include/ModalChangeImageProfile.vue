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
                            <div >
                                <label for="img">
                                    <img :src="imageData" alt="img-profile" id="image-profile" width="800" height="300">
                                </label>
                            </div>
                            <input type="file" class="d-none" id="img" @change="previewImage">
                            <div class="d-flex flex-row">
                                <i class="fas fa-minus c-fourth"></i>
                                <input type="range" class="bg-fourth mx-2" />
                                <i class="fas fa-plus c-fourth"></i>
                            </div>
                            <div class="text-right p-4">
                                <button class="btn bg-primary text-white" data-dismis="modal">Cancel</button>
                                <button class="btn bg-fifth text-white" >Save</button>
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
            imageData: this.user.avatar,
            avatar: '',
        }
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
                // await this.getImage(w)
                reader.readAsDataURL(input.files[0]);
            }
            
        },
        async getImage(w){
            this.user.avatar = w.target.files[0]
            var element = $('#image-profile')
            console.log(element)

            const cropper = new Cropper(element[0],{
                autoCrop:true,
                ready() {
                    this.cropper.crop()
                },
            })
            
            console.log(cropper)
        },
        save(){
            var avatar = new FormData()
            avatar.append('avatar', this.avatar, this.avatar.name)
        
            axios.post(`/User/Edit/imageProfile/${this.user.username}`, avatar ).then(res => {
                try {
                    if (res.data.updated){
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

            })
        },
    }
}
</script>