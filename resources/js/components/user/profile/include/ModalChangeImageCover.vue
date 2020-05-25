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
                                <button class="btn bg-fifth mr-2 text-white" :disabled="imageData.length <= 0">save</button>
                                <button class="btn bg-third text-white" data-dismiss="modal">cancel</button>
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
            var cover = new FormData()
            cover.append('cover', this.cover, this.cover.name)
        
            axios.post(`/User/Edit/imageCover/${this.user.username}`, cover ).then(res => {
                if (res.data.updated){
                    window.location.reload()
                }else{
                    alert('error')
                }
            }).catch(err =>{

            })
        }
    }
}
</script>