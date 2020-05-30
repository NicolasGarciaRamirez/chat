<template>
    <div class="d-flex flex-row mb-5" style="flex-grow: 4">
        <div style="width: 180px">
            <label :for="`imgRelease${index}`">
                <img class="img-fluid pr-3" :src="release_update.image"/>
            </label>
            <input type="file" :id="`imgRelease${index}`" name="imageRelease" class="form-control d-none" :ref="`imageRelease${index}`" v-on:change="previewImage" />
            <button type="button" class="btn text-white rounded-pill bg-fifth w-90" @click="deleteRelease(index)">
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
    </div>
</template>

<script>
    export default {
        props: ['release', 'index'],
        data(){
            return{
                release_update: {},
                image: null
            }
        },
        mounted() {
            this.release_update = this.release
        },
        methods:{
            previewImage(event) {
                this.image = event.target.files[0]
                this.release_update.image = URL.createObjectURL(this.image);

                var image = new FormData()
                append('image', this.image, this.image.name)

                this.release.image = image
            },
            deleteRelease(index){
                var self = this
                self.$parent.releases_information.splice(index, 1)
            }
        }
    }
</script>
