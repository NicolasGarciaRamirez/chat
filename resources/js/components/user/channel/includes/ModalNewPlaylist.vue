<template>
    <div class="modal fade modal-playlist" tabindex="-1" role="dialog" aria-labelledby="ModalPlaylist" aria-hidden="true" id="ModalPlaylist">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4">
                    <h4 class="font-weight-bold text-white text-center p-2">Create New Playlist</h4>
                    <form @submit.prevent="save">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row">
                                <label for="input">
                                    <img :src="imageData" alt="" style="min-width: 200px; max-width: 200px">
                                </label>
                                <input type="file" class="d-none" id="input" @change="previewImage">
                                <div class="d-flex text-center align-items-center justify-content-center">
                                    <button class="btn text-white border rounded-pill font-weight-bold ml-3" >Upload Playlist Image</button>
                                </div>
                            </div>
                            <input type="text" placeholder="Playlist Name" class="form-control my-3" v-model="playlist.title">
                            <textarea  cols="30" rows="10" placeholder="About This Playlist" class="form-control bg-thrid border-0" v-model="playlist.about"></textarea>
                            <div class="text-right my-3">
                                <button class="btn rounded-pill text-white bg-primary font-weight-bold">
                                    cancel    
                                </button>
                                <button class="btn rounded-pill mx-2 text-white bg-fifth font-weight-bold">
                                    save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <modal-change-image :user="user" type="Playlist" /> -->
    </div>
</template>

<script>
import Auth from '../../../../helpers/Auth'
// import ModalChangeImage from '../../profile/include/ModalChangeImage'
export default {
    components:{
        // ModalChangeImage
    },
    data(){
        return {
            imageData: '/images/profile/default.svg',
            user:{
                avatar:''
            },
            playlist:{
                title: '',
                image: '',
                about: ''
            }
        }
    },
    mounted(){
        Auth.initialize()
    },
    methods:{
        async previewImage(w){
            this.playlist.image = w.target.files[0]
            var input = w.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        },
        showModalEditImage(){
            $('#ModalChangeImage').modal('show')
        },
        save(){

            var playlist = new FormData()
            playlist.append('image', this.playlist.image, this.playlist.image.name)
            playlist.append('title', this.playlist.title)
            playlist.append('about', this.playlist.about)

            axios.post(`/${Auth.state.username}/Channel/Playlist/store`, playlist).then(res =>{
                if (res.data.saved) {
                    this.$toasted.show('The playlist has been create successfully!', {
                        position: "bottom-right", 
                        duration : 4000,
                        className: "p-4 notification bg-primary",
                        keepOnHover: true
                    })
                    console.log(res)
                }
                console.log(res)
            }).catch(err =>{
                console.log(err)
            })
        }
    }
}
</script>