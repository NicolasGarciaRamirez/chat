<template>
  <section>
        <div class="modal fade modal-picture-profile" tabindex="-1" role="dialog" aria-labelledby="ModalChangeImageProfile" aria-hidden="true" id="ModalChangeImageProfile">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-4">
                        <input type="file" class="form-control" @change="previewImage" />
                        <div class="image-preview" v-if="imageData.length > 0">
                            <img class="preview" :src="imageData">
                        </div>
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
            imageData:''
        }
    },
    methods:{
        previewImage(event) {
            this.user.avatar = event.target.files[0]
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
            console.log(this.imageData)
        },
    }
}
</script>