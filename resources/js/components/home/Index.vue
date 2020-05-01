<template>
    <section >
        <form @submit.prevent="save" enctype="multipart/form-data">
            <div class="form-group post-form" v-if="auth">
                <div class="bg-primary">
                    <textarea  rows="5" class="form-control bg-primary" placeholder="Add Some value to the music industry..." v-model="post.description"></textarea>
                    <div class="image-preview" v-if="imageData.length > 0">
                        <img class="preview" :src="imageData">
                    </div>
                </div>
                <div class="bg-primary post-footer d-flex justify-content-between align-items-center pr-2">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="img-upload">
                            <label for="input-sound">
                                <img  src="/images/icons/sound.svg" alt="">
                            </label>
                            <input id="input-sound" name="sound" type="file" accept=".mp3">
                        </div>
                        <div class="img-upload">
                            <label for="input-video">
                                <img src="/images/icons/video-camera.svg" alt="">
                            </label>
                            <input id="input-video" name="sound" type="file" accept=".mp4">
                        </div>
                        <div class="img-upload">
                            <label for="input-image">
                                <img src="/images/icons/image.svg" alt=""   name="sound">
                            </label>
                            <input id="input-image" name="sound" type="file" accept=".jpg, .png, .jpeg" @change="previewImage" >
                        
                        </div>
                        <div class="img-upload">
                            <label for="input-docs">
                                <img src="/images/icons/paperclip.svg" alt="">
                            </label>
                            <input id="input-docs" name="sound" type="file" accept=".pdf, .docx">
                        </div>

                        <a href="#">GO LIVE <span class="c-fifth">•</span></a>
                    </div>
                    <button class="btn bg-fifth text-white rounded-pill" type="submit">POST</button>
                </div>
                <div class="config-post  bg-primary"  v-if="imageData.length > 0 ">
                    <div class="d-flex flex-column">
                        <div class="checkbox">
                            <input type="checkbox" name="" id="replace_caption" class="m-2" v-model="replace_caption">
                            <label for="replace_caption"><span>Replace Caption with Title & Discription (YouTube Style)</span></label>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" name="" id="allow_download" class="m-2" v-model="allow_download">
                            <label for="allow_download"><span>Allow Download</span></label>
                        </div>
                    </div>
                    <div class="d-flex flex" v-if="replace_caption">
                        <input type="text" class="form-control m-2" v-model="post.replace_caption" placeholder="Add title..">
                    </div>
                    <div class="d-flex flex my-2" v-if="allow_download">
                        <textarea type="text" class="form-control m-2" v-model="post.allow_download" placeholder="Add Description.."></textarea>
                    </div>
                    <div class="d-flex flex-row justify-content-start">
                        <select class="select-form m-2" v-model="post.genre">
                            <option value="">Select Genre</option>
                            <option value="Rock">Rock</option>
                        </select>
                        <select class="select-form m-2" v-model="post.category">
                            <option value="">Select Category</option>
                            <option value="Sax">sax</option>
                        </select>

                        <select class="select-form m-2" >
                            <option value="">Everyone</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <posts :posts="posts" />
    </section>
</template>

<script>
    import Posts from "../stream/Posts";
    export default {
        props:['posts'],
        data(){
            return {
                replace_caption: false,
                allow_download: false,
                auth : false,
                imageData: "",
                user: {},
                post:{
                    replace_caption:"",
                    allow_download:"",
                    description:"",
                    image: null,
                    genre:"",
                    category: "",
                }
            }
        },
        components:{
            Posts
        },
        mounted(){
            this.authCheck()
        },
        methods:{
            authCheck(){
                axios.post('/Auth/Check').then(res => {
                    this.auth = res.data.auth 
                    this.user = res.data.user
                })
            },
            previewImage(event) {
                this.post.image = event.target.files[0]

                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageData = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            },
            save(){
                var imagePost = new FormData();
                imagePost.append('imagePost', this.post.image)
                imagePost.append('imageName', this.post.image.name)
                imagePost.append('postDescription', this.post.description)
                imagePost.append('postGenre', this.post.genre)
                imagePost.append('postCategory', this.post.category)

                axios.post(`/Profile/Post/Save/${this.user.id}`, imagePost).then(res =>{
                    console.log(res)
                    window.location.reload()
                }).catch(err=>{
                    console.log(err)
                })
            }
        }
    }
</script>
