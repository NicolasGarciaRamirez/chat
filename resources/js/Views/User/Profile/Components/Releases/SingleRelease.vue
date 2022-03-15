<template>
        <div class="card border-0 releases">
            <div class="row no-gutters">
                <div class="col-12 col-md-4 px-0">
                    <div class="cross-center">
                        <label :for="`imgRelease${index}`" class="content-release text-center cross-center cursor-pointer" v-if=" release_update.image == '/images/default-releases.png'">
                            <h2 class="font-weight-bold">Add <br> Album Art</h2>
                            <svg  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path d="M21.8,10.8h-8.6V2.2C13.2,1.5,12.7,1,12,1s-1.2,0.5-1.2,1.2v8.6H2.2C1.5,10.8,1,11.3,1,12s0.5,1.2,1.2,1.2 h8.6v8.6c0,0.7,0.5,1.2,1.2,1.2s1.2-0.5,1.2-1.2v-8.6h8.6c0.7,0,1.2-0.5,1.2-1.2S22.5,10.8,21.8,10.8z"/> </svg>
                        </label>
                        <label :for="`imgRelease${index}`" class="text-center cursor-pointer" style="width: 200px; height: 200px;" v-else >
                            <img class="w-100 shadow" :src="release_update.image" style="object-fit: contain; border-radius: 0.6rem;" />
                        </label>

                        <input type="file" :id="`imgRelease${index}`" name="imageRelease" accept=".jpg , .png , .jpeg, .svg" class="form-control d-none" :ref="`imageRelease${index}`" v-on:change="showChangeImage" />
                        <button type="button" class="btn text-white rounded-pill bg-fifth font-weight-bold d-none d-md-block" @click="deleteRelease(index)">
                            Delete Release
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-8 px-0">
                    <div class="card-body p-0">
                        <div class="d-flex" style="margin-bottom: .6rem">
                            <input type="text" class="form-control mb-1" placeholder="Artist Name" v-model='release_update.artistic_name' />
                        </div>
                        <div class="d-flex" style="margin-bottom: .6rem">
                            <input type="text" class="form-control mb-1" placeholder="Album Name" v-model="release_update.album_name" />
                        </div>
                        <div class="d-flex" style="margin-bottom: .6rem">
                            <input type="text" class="form-control mb-1" placeholder="Release Date" v-model="release_update.release_date"  />
                        </div>
                        <div class="d-flex" style="margin-bottom: .6rem">
                            <input type="text" class="form-control mb-1" placeholder="Genre" v-model="release_update.genre" />
                        </div>
                        <div class="d-flex" style="margin-bottom: .6rem">
                            <input type="text" class="form-control mb-1" placeholder="Label name" v-model="release_update.label" />
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="button" class="btn text-white rounded-pill bg-fifth font-weight-bold d-md-none" @click="deleteRelease(index)">
                        Delete Release
                    </button>
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
            this.getChanges()
        },
        methods:{
            refreshCacheImage(){
                $(`#imgRelease${this.index}`).val('')
            },
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
                $('#ModalChangeRelease').modal({backdrop: "static"})
                this.$parent.showAlertChange()
            },
            deleteRelease(index){
                let self = this
                self.$parent.releases_information.splice(index, 1)
                this.$parent.showAlertChange()
            },
            getChanges(){
                let fields = [
                    "input[type='text']",
                    "input[type='file']"
                ]

                fields.forEach(field => {
                    $(field).on('change', (e) => {
                        this.$parent.showAlertChange()
                    })
                });
            },
        }
    }
</script>


<style lang="scss">
    .content-release{
        padding: 1rem;
        background: var(--third-color);
        border-radius: 0.6rem;
        box-shadow: 0 8px 18px rgba(0,0,0,0.75);
        color: var(--fourth-color);
        width: 195px;
        height: 195px;
        margin-bottom: 1rem;
        svg{
            fill: var(--fourth-color);
            width: 3rem;
        }
        &:hover{
            color: #fff;
        }
        svg{
            fill: #fff;
        }
    }
</style>