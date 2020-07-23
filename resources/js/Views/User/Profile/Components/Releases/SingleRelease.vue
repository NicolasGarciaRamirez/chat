<template>
    <div class="d-flex flex-row text-center justify-content-center mb-5" style="flex-grow: 1">
        <div style="width: 13rem">
            <label :for="`imgRelease${index}`">
                <img class="img-fluid" :src="release_update.image"/>
            </label>
            <input type="file" :id="`imgRelease${index}`" name="imageRelease" accept=".jpg , .png , .jpeg, .svg" class="form-control d-none" :ref="`imageRelease${index}`" v-on:change="showChangeImage" />
            <button type="button" class="btn text-white rounded-pill bg-fifth font-weight-bold" @click="deleteRelease(index)">
                Delete Release
            </button>
        </div>
        <div class="d-flex flex-column c-fifth">
            <div class="d-flex flex-row">
                <input type="text" class="form-control" placeholder="Artist Name" v-model='release_update.artistic_name' /> <span class="mx-3">&nbsp</span>
            </div>
            <div class="d-flex flex-row">
                <input type="text" class="form-control" placeholder="Album Name" v-model="release_update.album_name" /> <span class="mx-3">*</span>
            </div>
            <div class="d-flex flex-row">
                <input type="text" class="form-control" placeholder="Release Date" v-model="release_update.release_date"  /> <span class="mx-3">&nbsp</span>
            </div>
            <div class="d-flex flex-row">
                <input type="text" class="form-control" placeholder="Genre" v-model="release_update.genre" /> <span class="mx-3">*</span>
            </div>
            <div class="d-flex flex-row">
                <input type="text" class="form-control" placeholder="Label name" v-model="release_update.label" /> <span class="mx-3">&nbsp</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['release', 'index'],
        data(){
            return{
                release_update: {},
                img:null,
                resource:'',
            }
        },
        mounted() {
            this.release_update = this.release
        },
        methods:{
            showChangeImage(w){
                let input = w.target;
                this.$parent.$children[2].image = w.target.files[0]
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.img = e.target.result;
                        this.$parent.$children[2].img = e.target.result
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                this.$parent.$children[2].type_change_image = 'Releases'
                this.$parent.$children[2].id_release = this.index
                $('#ModalChangeRelease').modal('show')
            },
            deleteRelease(index){
                let self = this
                self.$parent.releases_information.splice(index, 1)
            }
        }
    }
</script>
