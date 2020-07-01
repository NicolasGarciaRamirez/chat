<template>
    <section>
        <form @submit.prevent="store" enctype="multipart/form-data">
            <div class="form-group post-form">
                <div class="bg-primary">
                    <textarea
                        class="form-control bg-primary"
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
                        <img src="/images/icons/excel-document.svg" heigth="300" width="400" class="p-5" v-if="post.resource_type == 'docs'">
                    </div>
                </div>
                <div class="bg-primary post-footer d-flex justify-content-between align-items-center pr-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="img-upload">
                            <label for="input-sound" class="cursor-pointer">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="2px" y="0px"
                                    viewBox="0 0 663 351" style="enable-background:new 0 0 663 351;" xml:space="preserve" width="40" heigth="auto">
                                <path  :class="post.resource_type == 'audio' ? 'active' : 'svg-fourth'" d="M371.9,346.2c-6,0-11.4-3.1-13-7.6L286.9,151l-66.4,104c-2.2,3.4-6.5,5.7-11.4,5.9c-5.1,0.3-9.5-1.6-12.1-4.7
                                    l-50.5-59.3H17.7c-7.5,0-13.7-4.8-13.7-10.7s6.1-10.7,13.7-10.7H154c4.6,0,8.8,1.8,11.4,4.8l41.5,48.7l71.3-111.6
                                    c2.4-3.9,7.7-6.4,13.4-5.8c5.6,0.4,10.2,3.4,11.9,7.6l65.8,172.3l71-278.1c1.3-5.1,7.3-9,13.9-8.6c6.6,0.2,12.3,4.2,13,9.5l25,176.8
                                    l37-14.5c1.9-0.7,4-1.1,6.1-1.1h109c7.5,0,13.7,4.8,13.7,10.7s-6.1,10.7-13.7,10.7H538.6L487,217.1c-4,1.6-8.7,1.5-12.6-0.2
                                    s-6.5-4.7-7-8.2L449.8,85l-64.5,252.7c-1.3,4.8-6.5,8.3-12.8,8.6C372.3,346.2,372.1,346.2,371.9,346.2z"/>
                                </svg>
                            </label>
                            <input id="input-sound" name="sound" type="file" accept=".mp3"  @change="previewImage" @click="post.resource_type = 'audio'">
                        </div>
                        <div class="img-upload">
                            <label for="input-video" class="cursor-pointer">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 1430 1080" style="enable-background:new 0 0 1430 1080;" xml:space="preserve" width="30" heigth="auto">
                                <path :class="post.resource_type == 'video' ? 'active': 'svg-fourth'" d="M1430,519.5l-340.77,135.01V472.52H975.54c69.65-49.52,113.69-121.97,113.69-202.51
                                    C1089.23,121.1,938.93,0,754.11,0C600.88,0,471.46,83.18,431.56,196.53c-45.69-37.92-109.6-61.53-180.16-61.53
                                    C112.74,135.01,0,225.83,0,337.51c0,51.83,24.23,99.15,64.18,135.01H0V1080h1089.23V897.97L1430,1032.97V519.5z M754.11,67.5
                                    c138.61,0,251.29,90.82,251.29,202.51c0,111.69-112.69,202.51-251.29,202.51c-138.67,0-251.4-90.82-251.4-202.51
                                    C502.7,158.33,615.44,67.5,754.11,67.5z M532.66,472.52h-94.14c16.15-14.5,29.75-30.96,40.21-48.79
                                    C494.25,441.66,512.37,458.07,532.66,472.52z M83.84,337.51c0-74.46,75.13-135.01,167.57-135.01c92.34,0,167.51,60.55,167.51,135.01
                                    c0,74.46-75.17,135.01-167.51,135.01C158.96,472.52,83.84,411.97,83.84,337.51z M1005.4,1012.5H83.84V539.98h921.56V1012.5z
                                    M1346.16,924.57l-256.93-101.84v-92.97l256.93-101.84V924.57z"/>
                                </svg>
                            </label>
                            <input id="input-video" name="video" type="file" accept=".mp4" @change="previewImage" @click="post.resource_type = 'video'">
                        </div>
                        <div class="img-upload">
                            <label for="input-image" class="cursor-pointer">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 1430 1080" style="enable-background:new 0 0 1430 1080;" xml:space="preserve" width="25" heigth="auto">
                                <g>
                                    <g>
                                        <g>
                                            <path :class="post.resource_type == 'image' ? 'active': 'svg-fourth'" d="M0,0v1080h1430V0H0z M1330.23,987.43H99.77V867.78l282.67-262.33l266.02,246.83l399.09-370.24l282.67,262.28
                                                V987.43z M1330.23,613.41l-282.67-262.28L648.47,721.38L382.44,474.55L99.77,736.82V92.57h1230.45V613.41z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path :class="post.resource_type == 'image' ? 'active': 'svg-fourth'" d="M648.47,185.15c-82.51,0-149.66,62.3-149.66,138.86c0,76.56,67.15,138.86,149.66,138.86
                                                c82.51,0,149.66-62.31,149.66-138.86C798.12,247.45,730.98,185.15,648.47,185.15z M648.47,370.3c-27.5,0-49.89-20.77-49.89-46.29
                                                c0-25.52,22.38-46.29,49.89-46.29s49.89,20.76,49.89,46.29C698.35,349.53,675.97,370.3,648.47,370.3z"/>
                                        </g>
                                    </g>
                                </g>
                                </svg>
                            </label>
                            <input id="input-image" name="img" type="file" accept=".jpg, .png, .jpeg" @change="previewImage" @click="post.resource_type = 'image'"/>
                        </div>
                        <div class="img-upload">
                            <label for="input-docs" class="cursor-pointer">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 1430 1080" style="enable-background:new 0 0 1430 1080;" xml:space="preserve"  width="30" heigth="auto">
                                    <g>
                                        <path :class="post.resource_type == 'docs' ? 'active': 'svg-fourth'" stroke="#535353" stroke-width="0.25" stroke-miterlimit="10"  d="M712.5,1080C507.1,1080,340,952.62,340,796.04V205.98h87.67v590.06c0,119.75,127.77,217.16,284.83,217.16
                                            s284.83-97.41,284.83-217.16V205.98c0-76.74-81.89-139.18-182.6-139.18c-100.68,0-182.59,62.44-182.59,139.18v590.06
                                            c0,33.79,36.06,61.25,80.36,61.25c44.31,0,80.31-27.46,80.31-61.25V205.98h87.65v590.06c0,70.64-75.33,128.06-167.96,128.06
                                            c-92.68,0-167.96-57.42-167.96-128.06V205.98C544.54,92.43,665.7,0,814.73,0C963.73,0,1085,92.43,1085,205.98v590.06
                                            C1085,952.62,917.87,1080,712.5,1080z"/>
                                    </g>
                                </svg>
                            </label>
                            <input id="input-docs" name="docs" type="file" accept=".pdf, .docx" @change="previewImage" @click="post.resource_type = 'docs'">
                        </div>

                        <a href="#">GO LIVE <span class="c-fifth ml-1">•</span></a>
                    </div>
                  
                    <button class="btn bg-fifth text-white rounded-pill" type="submit" v-if="!loading && !imageData && !post.description" :disabled="post.category === '' && post.genre === ''">Post</button>
                </div>
                <div class="config-post  bg-primary ">
                    <div class="d-flex flex-column"  >
                        <div class="checkbox" v-if="imageData.length > 0 && post.resource_type == 'audio' || post.resource_type == 'video' || post.resource_type == 'docs'">
                            <input type="checkbox" name="" id="replace_caption" class="m-2" v-model="replace_caption">
                            <label for="replace_caption"><span class="c-fourth font-weight-bold">Replace Caption with Title & Discription (YouTube Style)</span></label>
                        </div>
                        <div class="checkbox" v-if="imageData.length > 0 && post.resource_type == 'image' || post.resource_type == 'docs'">
                            <input type="checkbox" name="" id="allow_download" class="m-2" v-model="post.allow_download">
                            <label for="allow_download"><span class="c-fourth font-weight-bold">Allow Download</span></label>
                        </div>
                    </div>
                    <div class="d-flex flex-column" v-if="replace_caption">
                        <input type="text" class="form-control m-3 w-auto" v-model="post.replace_caption" placeholder="Add title..">
                        <textarea class="form-control my-2 m-3 w-auto" rows="5" placeholder="Add Some value to the music industry..." id="textarea" v-model="post.description"></textarea>
                    </div>
                    <div class="d-flex flex-row justify-content-between" v-if="post.description != '' || post.resource != ''">
                        <div class="d-flex flex-row">
                            <div class="select">
                                <select class="select-form m-2 font-weight-bold" v-model="post.genre" required>
                                    <option value="">Select Genre</option>
                                    <option value="Pop">Pop</option>
                                    <option value="Rap & Hip-Hop">Rap & Hip-Hop</option>
                                    <option value="EDM">EDM</option>
                                    <option value="Rock & Metal">Rock & Metal</option>
                                    <option value="Jazz & Blues">Jazz & Blues</option>
                                    <option value="Classical">Classical</option>
                                    <option value="Funk">Funk</option>
                                    <option value="World">World</option>
                                </select>
                            </div>
                            <div class="select">
                                <select class="select-form m-2 font-weight-bold" v-model="post.category" required>
                                    <option value="">Select Category</option>
                                    <option value="Production & Engineering">roduction & Engineering</option>
                                    <option value="Vlogs">logs</option>
                                    <option value="Instruments">Instruments</option>
                                    <option value="Podcasts">Podcasts</option>
                                    <option value="Audio Clips">Audio Clips</option>
                                </select>
                            </div>
                        </div>
                        <div  class="d-flex flex-row">
                            <div class="d-flex flex-row float-right justify-content-between align-items-center">
                                <div class="select">
                                    <select class="select-form m-2 font-weight-bold">
                                        <option value="">Everyone</option>
                                    </select>
                                </div>
                                <div class="mx-2">
                                    <button class="btn bg-fifth text-white rounded-pill mr-2" type="submit" v-if="!loading" :disabled="post.category === '' && post.genre === ''">Post</button>
                                    <button class="btn rounded-pill text-white bg-fifth" v-if="loading" disabled>
                                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <posts :posts="order_post" ref="posts"/>
    </section>
</template>

<script>
    import Posts from "../stream/Posts";
    import Auth from "../../helpers/Auth"
    import VueHashtagTextarea from 'vue-hashtag-textarea/src/vue-hashtag-textarea'
    export default {
        name: "Index",
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
                order_post: [],
                all_post: []

            }
        },
        mounted(){
            Auth.initialize()
            this.all_post = this.posts
            this.orderPost()
        },
        methods:{
            addClassActive(){
                $('svg path').addClass('active')
            },
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
                        imagePost.append('resource', this.post.resource, this.post.resource)
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
                            this.order_post.unshift(res.data.post)
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
            orderPost(){
                this.order_post = _.orderBy(this.all_post, ['score'], ['desc'])
            },
            filterPost(genre, category){
                this.all_post = this.posts

                if(genre.length > 0){
                    this.all_post = _.filter(this.all_post, (v) => _.indexOf(genre, v.genre) !== -1)
                }

                if(category.length > 0) {
                    this.all_post = _.filter(this.all_post, (v) => _.indexOf(category, v.category) !== -1)
                }

                this.orderPost()
            },
            initializeVariables(){
                this.post = {
                    replace_caption:"",
                    allow_download:"",
                    description:'',
                    resource: '',
                    resource_type : 'text',
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
