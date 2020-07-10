<template>
    <div class="d-flex flex-row text-center justify-content-center mb-5" style="flex-grow: 1">
        <div style="width: 13rem">
            <label :for="`imgRelease${index}`" @click="type_change_image = 'Releases'">
                <img class="img-fluid" src="/images/profile/default-releases.svg" style="width: 17rem"/>
            </label>
            <input type="file" :id="`imgRelease${index}`" name="imageRelease" accept=".jpg , .png , .jpge, .svg" class="form-control d-none" :ref="`imageRelease${index}`" v-on:change="showChangeImage" />
            <button type="button" class="btn text-white rounded-pill bg-fifth font-weight-bold" @click="deleteRelease(index)">
                Delete Release
            </button>
        </div>
        <div class="d-flex flex-column">
            <input type="text" class="form-control" placeholder="Artist Name" v-model='release_update.artistic_name' />
            <input type="text" class="form-control" placeholder="Album Name" v-model="release_update.album_name" />
            <input type="text" class="form-control" placeholder="Release Date" v-model="release_update.release_date"  />
            <input type="text" class="form-control" placeholder="Genre" v-model="release_update.genre" />
            <input type="text" class="form-control" placeholder="Label name" v-model="release_update.label" />
        </div>
        <modal-change-image></modal-change-image>
    </div>
</template>

<script>
    import ModalChangeImage from "./ModalChangeImage";
    export default {
        props: ['release', 'index'],
        components:{
            ModalChangeImage
        },
        data(){
            return{
                release_update: {},
                img:null,
                resource:'',
                type_change_image: 'Releases'
            }
        },
        mounted() {
            this.release_update = this.release
        },
        methods:{
            showChangeImage(w){
                let input = w.target;
                this.resource = w.target.files[0]
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.img = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                $('#ModalChangeImage').modal('show')
                // this.img = w.target.files[0]
            },
            deleteRelease(index){
                let self = this
                self.$parent.releases_information.splice(index, 1)
            }
        }
    }
</script>
