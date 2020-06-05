<template>
  <section>
        <div class="modal fade modal-picture-profile" tabindex="-1" role="dialog" aria-labelledby="ModalChangeImageCover" aria-hidden="true" id="ModalChangeImageCover">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4">
                        <form @submit.prevent="save">
                            <input type="file" class="form-control my-2" @change="previewImage" />
                            <div class="my-2" v-if="imageData.length > 0">
                                <img class="preview" :src="imageData">
                            </div>
                            <div class="text-right">
                                <button class="btn bg-fifth mr-2 text-white" v-if="!disable" :disabled="imageData.length <= 0">save</button>
                                <button class="btn bg-third text-white" data-dismiss="modal">cancel</button>
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
    props:['user'],
    data(){
        return {
            disable: false,
            imageData:'',
            cover: ''
        }
    },
    methods:{
        previewImage(w) {
            this.cover = w.target.files[0]
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
            var cover = new FormData()
            cover.append('cover', this.cover, this.cover.name)
        
            axios.post(`/User/Edit/imageCover/${this.user.username}`, cover ).then(res => {
                if (res.data.updated){
                    this.disable = false
                    window.location.reload()
                }else{
                    alert('error')
                }
            }).catch(err =>{
                this.disable = false
            })
        }
    }
}
</script>