<template>
    <section >
        <form @submit.prevent="store" enctype="multipart/form-data">
            <div class="form-group post-form">
                <div class="bg-primary">
                    <textarea
                        class="form-control bg-primary"
                        rows="5"
                        placeholder="Add Some value to the music industry..."
                        id="textarea"
                        v-model="post.description"
                        v-if="!replace_caption"
                        >
                    </textarea>
                    <div class="image-preview" v-if="imageData.length > 0">
                
                        <img class="preview" :src="imageData" v-if="post.resource_type == 'image'">
                        <video :src="`${imageData}`" controls class="img-fluid" v-if="post.resource_type == 'video'" />
                        <audio :src="`${imageData}`" type=”audio/mp3″ controls v-if="post.resource_type == 'audio'" />
                        <img src="/images/icons/excel-document.svg" height="300" width="400" class="p-5" v-if="post.resource_type == 'docs'">
                    </div>
                </div>
                <div class="bg-primary post-footer d-flex justify-content-between align-items-center pr-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="img-upload">
                            <label for="input-sound">
                                <img  src="/images/icons/sound.svg" alt="">
                            </label>
                            <input id="input-sound" name="sound" type="file" accept=".mp3"  @change="previewImage" @click="post.resource_type = 'audio'">
                        </div>
                        <div class="img-upload">
                            <label for="input-video">
                                <img src="/images/icons/video-camera.svg" alt="">
                            </label>
                            <input id="input-video" name="video" type="file" accept=".mp4" @change="previewImage" @click="post.resource_type = 'video'">
                        </div>
                        <div class="img-upload">
                            <label for="input-image">
                                <img src="/images/icons/image.svg" alt=""   name="sound">
                            </label>
                            <input id="input-image" name="img" type="file" accept=".jpg, .png, .jpeg" @change="previewImage" @click="post.resource_type = 'image'"/>
                        </div>
                        <div class="img-upload pr-2">
                            <label for="input-docs">
                                <img src="/images/icons/paperclip.svg"  style="transform: translateX(-6px);">
                            </label>
                            <input id="input-docs" name="docs" type="file" accept=".pdf, .docx" @change="previewImage" @click="post.resource_type = 'docs'">
                        </div>

                        <a href="#">GO LIVE <span class="c-fifth ml-1">•</span></a>
                    </div>

                    <button class="btn bg-fifth text-white rounded-pill" type="submit" v-if="!loading" :disabled="post.category === '' && post.genre === ''">Post</button>
                    <button class="btn rounded-pill text-white bg-fifth" v-if="loading" disabled>
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    </button>

                </div>
                <div class="config-post  bg-primary">
                    <div class="d-flex flex-column"  >
                        <div class="checkbox" v-if="imageData.length > 0 && post.resource_type == 'audio' || post.resource_type == 'video' || post.resource_type == 'docs'">
                            <input type="checkbox" name="" id="replace_caption" class="m-2" v-model="replace_caption">
                            <label for="replace_caption"><span>Replace Caption with Title & Discription (YouTube Style)</span></label>
                        </div>
                        <div class="checkbox" v-if="imageData.length > 0 && post.resource_type == 'image' || post.resource_type == 'docs'">
                            <input type="checkbox" name="" id="allow_download" class="m-2" v-model="post.allow_download">
                            <label for="allow_download"><span>Allow Download</span></label>
                        </div>
                    </div>
                    <div class="d-flex flex-column" v-if="replace_caption">
                        <input type="text" class="form-control m-3" v-model="post.replace_caption" placeholder="Add title..">
                        <textarea class="form-control my-2 m-3" rows="5" placeholder="Add Some value to the music industry..." id="textarea" v-model="post.description"></textarea>
                    </div>
                    <div class="d-flex flex-row justify-content-start" v-if="post.description != '' || post.resource != ''">
                        <div class="select">
                            <select class="select-form m-2" v-model="post.genre" required>
                                <option value="">Select Genre</option>
                                <option value="Pop">Pop</option>
                                <option value="Rap & Hip-Jop">Rap & Hip-Jop</option>
                                <option value="EDM">EDM</option>
                                <option value="Rock & Metal">Rock & Metal</option>
                                <option value="Jazz & Blues">Jazz & Blues</option>
                                <option value="Classical">Classical</option>
                                <option value="Funk">Funk</option>
                                <option value="World">World</option>
                            </select>
                        </div>
                        <div class="select">
                            <select class="select-form m-2" v-model="post.category" required>
                                <option value="">Select Category</option>
                                <option value="Production & Engineering">roduction & Engineering</option>
                                <option value="Vlogs">logs</option>
                                <option value="Instruments">Instruments</option>
                                <option value="Podcasts">Podcasts</option>
                                <option value="Audio Clips">Audio Clips</option>
                            </select>
                        </div>
                        <div class="select">
                            <select class="select-form m-2">
                                <option value="">Everyone</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <posts :posts="posts_send" />
    </section>
</template>

<script>
    import Posts from "../stream/Posts";
    import Auth from "../../helpers/Auth"
    import VueHashtagTextarea from 'vue-hashtag-textarea/src/vue-hashtag-textarea'
    export default {
        props:['posts'],
        components:{
            Posts,
            VueHashtagTextarea
        },
        data(){
            return {
                option: {
                    textColor: 'white',
                    hashtagColor: '#ff0000',
                    placeholder: 'Add Some value to the music industry...',
                    font:'Encode Sans'
                },
                loading: false,
                replace_caption: false,
                allow_download: false,
                auth : Auth.state,
                imageData: "",
                post:{
                    replace_caption:"",
                    allow_download:"",
                    description: '',
                    resource: '',
                    resource_type: 'text',
                    genre:"",
                    category: "",
                },
                disable_save_post: true,
                posts_send: [],

            }
        },
        mounted(){
            Auth.initialize()
            this.posts_send = this.posts
        },
        methods:{
            previewImage(event) {
                this.post.resource = event.target.files[0]
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            },
            async store(){
                if (this.auth.token) {
                    this.loading = true
                    var imagePost = new FormData();
                    if (this.post.resource != '') {
                        imagePost.append('imagePost', this.post.resource, this.post.resource)
                        imagePost.append('allow_download', this.post.allow_download)
                        imagePost.append('replace_caption', this.post.replace_caption)
                    }
                    imagePost.append('resource_type', this.post.resource_type)
                    imagePost.append('description', this.post.description)
                    imagePost.append('genre', this.post.genre)
                    imagePost.append('category', this.post.category)

                    await axios.post(`/${this.auth.username}/Post/store`, imagePost).then(res =>{
                        if (res.data.saved) {
                            this.loading = false
                            this.initializeVariables()
                            this.posts_send.unshift(res.data.post)
                            $('html, body').animate({ scrollTop: 0 }, 'fast');
                            this.$toasted.show('The publication has been successfully published!', {
                                position: "bottom-right",
                                duration : 4000,
                                className: "p-4 notification bg-primary",
                                keepOnHover: true
                            })
                        }else{
                            this.loading = false
                        }
                    }).catch(err=>{
                        this.loading = false
                    })
                }else{
                    $('#ModalLogin').modal('show')
                }
            },
            initializeVariables(){
                this.post = {
                    replace_caption:"",
                    allow_download:"",
                    description:"",
                    image: null,
                    genre:"",
                    category: "",
                }
                this.replace_caption= false
                this.allow_download= false
                this.imageData= ""
            }
        }
    }
</script>
