<template>
    <div class="public-post desktop">
        <div id="carouselPublicPost" :class="`carousel slide`">
            <div class="carousel-inner">
                <div class="carousel-item active public-post__container " data-interval="10000000" >
                    <component-text  ref="Text"  :class="(post.resource_type == 'text') ? 'px-3' : 'd-none'" ></component-text>
                    <component-audio ref="Audio" :file="fileInput" :class="(post.resource_type == 'audio') ? 'pt-3 px-3' : 'd-none'"></component-audio>
                    <component-video ref="Video" :file="fileInput" :class="(post.resource_type == 'video') ? 'pt-3 ' : 'd-none'"></component-video>
                    <component-image ref="Image" :file="fileInput" :class="(post.resource_type == 'image') ? 'pt-3 px-3' : 'd-none'"></component-image>
                    <component-file  ref="File"  :file="fileInput" :class="(post.resource_type == 'docs') ? 'pt-3 ' : 'd-none'"></component-file >
                    <component-link  ref="Link"  :file="fileInput" :class="(post.resource_type === 'link') ? 'pt-3 ' : 'd-none'"></component-link>
                </div>
                <div class="carousel-item" v-if="post.resource_type == 'video'" data-interval="10000000">
                    <thumbnail ref="Thumbnail" class="px-3" :file="fileInput"></thumbnail>
                </div>
                <div class="carousel-item px-3"  v-if="post.resource_type != 'text'" data-interval="10000000">
                    <div class="text-center mb-2">
                        <b>Write Caption (Optional):</b>
                    </div>
                    <div class="content-checkbox" v-if="fileInput.resource != null" >
                        <div>
                            <label class="check-button">
                                <input type="checkbox"  v-on:change="toggleSlow('replace_caption_content')" v-model="replace_caption">
                                <span><b>Replace Caption with Title & Discription (YouTube Style)</b></span>
                            </label>
                        </div>
                    </div>
                    <div id="replace_caption_content" class="mb-2" v-if="replace_caption">
                        <input type="text" class="form-control " v-model="post.replace_caption" placeholder="Add title..">
                    </div>
                    <textarea class="form-control" rows="5" placeholder="Add Some value to the music industry..." id="textarea" v-model="post.description"></textarea>
                    <div class="checkbox" v-if="post.resource_type === 'image' || post.resource_type === 'docs'">
                        <label class="check-button">
                            <input type="checkbox" name="" id="allow_download" class="m-2"  v-model="post.allow_download">
                            <span><b>Allow Download</b></span>
                        </label>
                    </div>
                </div>
                <div class="carousel-item" data-interval="10000000">
                    <div class="filters mx-3">
                        <div class="mb-3">
                            <b class="mx-auto">Select Filters:</b>
                            <div class="fit-content">
                                <div class="dropdown mb-2 dropdown-sm">
                                    <div :class="`dropdown-btn  ${post.genre ? '' : 'dropdown-required'}`" id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <b> {{ post.genre ? (post.genre.length >= 10) ? post.genre.substring(0, 10) + '...' : post.genre : 'Select Genre' }} </b>
                                        <div class="icon">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdown">
                                        <div class="dropdown-item" @click="post.genre = 'Pop'">Pop</div>
                                        <div class="dropdown-item" @click="post.genre = 'Rap & Hip-Hop'">Rap & Hip-Hop</div>
                                        <div class="dropdown-item" @click="post.genre = 'EDM'">EDM</div>
                                        <div class="dropdown-item" @click="post.genre = 'Rock & Metal'">Rock & Metal</div>
                                        <div class="dropdown-item" @click="post.genre = 'Jazz & Blues'">Jazz & Blues</div>
                                        <div class="dropdown-item" @click="post.genre = 'Classical'">Classical</div>
                                        <div class="dropdown-item" @click="post.genre = 'Funk'">Funk</div>
                                        <div class="dropdown-item" @click="post.genre = 'World'">World</div>
                                        <div class="dropdown-item" @click="post.genre = 'Latin'">Latin</div>
                                        <div class="dropdown-item" @click="post.genre = 'LoFi'">LoFi</div>
                                        <div class="dropdown-item" @click="post.genre = 'Not Specific'">Not Specific</div>
                                    </div>
                                </div>
                                <div class="dropdown mb-2 dropdown-sm">
                                    <div :class="`dropdown-btn ${post.category ? '' : 'dropdown-required'}`" id="dropdownCategory"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <b> {{ post.category ? (post.category.length >= 10) ? post.category.substring(0, 10) + '...' : post.category : 'Select Topic' }} </b>
                                        <div class="icon">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdownCategory">
                                        <div class="dropdown-item" @click="post.category = 'Talking Music!'">Talking Music</div>
                                        <div class="dropdown-item" @click="post.category = 'Performances and Jams'">Performances & Jams</div>
                                        <div class="dropdown-item" @click="post.category = 'Production & Engineering'">Production & Engineering</div>
                                        <div class="dropdown-item" @click="post.category = 'Lessons and Tips'">Lessons & Tips</div>
                                        <div class="dropdown-item" @click="post.category = 'Vlogs'">Vlogs</div>
                                        <div class="dropdown-item" @click="post.category = 'Instruments/Gear'">Instruments & Gear</div>
                                        <div class="dropdown-item" @click="post.category = 'Music Podcasts'">Music Podcasts</div>
                                        <div class="dropdown-item" @click="post.category = 'Releases'">Releases</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr >
                        <div class="pb-3">
                            <b class="mx-auto">Select Exclusivity:</b>
                            <div class="dropdown fit-content dropdown-sm ">
                                <div class="dropdown-btn mb-0" id="dropdownEveryone"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b> {{ post.privacy ? post.privacy : 'Everyone' }} </b>
                                    <div class="icon">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <g id="Layer_2-2"> <path d="M1.4,6h21.2c0.3,0,0.5,0.4,0.3,0.7L12.3,17.8c-0.2,0.2-0.4,0.2-0.6,0L1.1,6.7C0.9,6.4,1,6,1.4,6z"/> </g> </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu " aria-labelledby="dropdownEveryone">
                                    <div class="dropdown-item" @click="post.privacy = 'Everyone'">Everyone</div>
                                    <div class="dropdown-item" @click="post.privacy = 'Followers'">Followers Only</div>
                                    <div v-if="auth.username && user.channel_information">
                                        <div class="dropdown-item" v-for="(tier, index) in user.channel_information.tiers" :key="index" @click="post.privacy = tier.name">{{ tier.name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-interval="10000000">
                    <div class="px-3">
                        <div class="mb-3 mx-3">
                            <div class="public-post__content--share-redes">
                                <div class="share-redes">
                                    <span class="share-redes--title">Also Post On:</span>
                                    <div class="share-redes__content">
                                        <div :class="`share-redes__icon ${facebook_active ? 'active' : ''}`" @click="facebook_active = (!facebook_active)" facebook>
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M9.9,23h2.6c0.6,0,1.1-0.5,1.1-1.1V13c0-0.6,0.5-1.1,1.1-1.1h1.2c0.6,0,1-0.4,1.1-1c0.1-0.4,0.1-0.9,0.2-1.4 c0.1-0.7-0.4-1.3-1.1-1.3h-1.2c-0.6,0-1.1-0.5-1.1-1.1V5.7c0.1-0.5,0.5-0.9,1.1-0.9h1.5c0.6,0,1.1-0.5,1.1-1.1V2.1 C17.5,1.5,17,1,16.4,1h-2.4C8.9,1,9,4.7,9,5.3v1.9c0,0.6-0.5,1.1-1.1,1.1H7.6C7,8.3,6.5,8.8,6.5,9.4v1.3c0,0.6,0.5,1.1,1.1,1.1h0 c0.6,0,1.1,0.5,1.1,1.1v8.8C8.8,22.5,9.3,23,9.9,23z"/> </svg>
                                        </div>
                                        <div :class="`share-redes__icon ${twitter_active ? 'active' : ''}`" @click="twitter_active = (!twitter_active)" twitter>
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M22.4,5.2c-0.1,0-0.2,0.1-0.3,0.1c-0.7,0.2-0.7-0.1-0.2-0.6C22,4.5,22.2,4.3,22.4,4c0.4-0.6,0-0.8-0.6-0.6 c-0.2,0.1-0.5,0.2-0.7,0.3c-0.6,0.2-1.6-0.1-2.1-0.5c-0.7-0.5-1.6-0.7-2.5-0.7c-1.3,0-2.4,0.5-3.3,1.4c-0.9,0.9-1.4,2.1-1.4,3.4 c0,0.2,0,0.4,0,0.6c0,0.3-0.5,0.5-1.1,0.4C9.2,8.1,7.8,7.6,6.5,6.9C5.2,6.2,4,5.4,3,4.3C2.5,3.8,1.9,3.9,1.7,4.5 C1.6,4.9,1.5,5.4,1.5,5.8c0,0.8,0.2,1.6,0.6,2.3C2.3,8.4,2.5,8.7,2.8,9c0.4,0.5,0.4,0.8-0.2,0.6c-0.6-0.2-1-0.4-1-0.4s0,0,0,0 c0,1.2,0.4,2.2,1.1,3.1c0.4,0.5,0.9,1,1.5,1.2C4.7,13.8,5,14,4.7,14.1c-0.2,0-0.4,0-0.6,0c-0.1,0-0.3,0-0.4,0 c-0.2,0-0.3,0.5,0.1,1.1C4,15.6,4.4,16,4.8,16.4c0.5,0.4,1,0.6,1.5,0.8c0.7,0.2,0.8,0.5,0.2,0.9c-1.5,0.9-3.1,1.3-4.8,1.3 c-0.2,0-0.4,0-0.6,0c-0.3,0-0.1,0.3,0.5,0.6c1.9,1,3.9,1.5,6.1,1.5c1.7,0,3.2-0.3,4.7-0.8c1.5-0.5,2.7-1.3,3.8-2.2 c1-0.9,1.9-1.9,2.7-3.1c0.8-1.2,1.3-2.4,1.7-3.7c0.4-1.3,0.6-2.6,0.6-3.9c0-0.1,0-0.2,0-0.3c0-0.2,0.4-0.6,0.9-1.1 c0.2-0.2,0.4-0.4,0.6-0.7C23.2,5.2,23,5,22.4,5.2z"/> </svg>
                                        </div>
                                        <div :class="`share-redes__icon ${reddit_active ? 'active' : ''}`" @click="reddit_active = (!reddit_active)" reddit>
                                            <svg id="Bold" enable-background="new 0 0 24 24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><path d="m21.325 9.308c-.758 0-1.425.319-1.916.816-1.805-1.268-4.239-2.084-6.936-2.171l1.401-6.406 4.461 1.016c0 1.108.89 2.013 1.982 2.013 1.113 0 2.008-.929 2.008-2.038s-.889-2.038-2.007-2.038c-.779 0-1.451.477-1.786 1.129l-4.927-1.108c-.248-.067-.491.113-.557.365l-1.538 7.062c-2.676.113-5.084.928-6.895 2.197-.491-.518-1.184-.837-1.942-.837-2.812 0-3.733 3.829-1.158 5.138-.091.405-.132.837-.132 1.268 0 4.301 4.775 7.786 10.638 7.786 5.888 0 10.663-3.485 10.663-7.786 0-.431-.045-.883-.156-1.289 2.523-1.314 1.594-5.115-1.203-5.117zm-15.724 5.41c0-1.129.89-2.038 2.008-2.038 1.092 0 1.983.903 1.983 2.038 0 1.109-.89 2.013-1.983 2.013-1.113.005-2.008-.904-2.008-2.013zm10.839 4.798c-1.841 1.868-7.036 1.868-8.878 0-.203-.18-.203-.498 0-.703.177-.18.491-.18.668 0 1.406 1.463 6.07 1.488 7.537 0 .177-.18.491-.18.668 0 .207.206.207.524.005.703zm-.041-2.781c-1.092 0-1.982-.903-1.982-2.011 0-1.129.89-2.038 1.982-2.038 1.113 0 2.008.903 2.008 2.038-.005 1.103-.895 2.011-2.008 2.011z"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr >
                        <div class="checkbox mx-3">
                            <label class="check-button mb-3">
                                <input type="checkbox" id="copyright" class="m-2" v-model="copyright" > <!-- v-model="post.copyright" -->
                                <span><b class="ml-1">I consent that this content is my original work and is not infringing any copyright.</b></span>
                            </label>
                        </div>
                        <hr >
                        <div class="text-right">
                            <a href="#" class="btn btn-link text-light" v-on:click="confirmResetData()" v-if="editPost"><b>Cancel</b></a>
                            <button :class="`btn btn-red rounded-pill ${ (!editPost) ? 'disabled':'' }`" type="submit" :disabled="!editPost||loading" v-on:click.prevent="store()">
                                <b v-if="!loading">Post</b>
                                <div class="spinner-border spinner-border-sm text-white" role="status" v-else>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <alert-upload-meter ref="alertUploadMeter"></alert-upload-meter>
        <alert-maximum-size></alert-maximum-size>
        <modal-share/>
    </div>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import text from './includes/Text';
    import audio from './includes/Audio';
    import image from './includes/Image';
    import document from './includes/Document';
    import Link from "./includes/Link";
    import video from './movil/Includes/video';
    import Thumbnail from './movil/Includes/Thumbnail';

    import AlertMaximumSize from "../Components/AlertMaximumSize";
    import Share from "./includes/Share";


    export default {
        props:['user', 'type'],
        components:{
            'component-text'  : text,
            'component-audio' : audio,
            'component-video' : video,
            'component-image' : image,
            'component-file'  : document,
            'component-link'  : Link,
            'modal-share'     : Share,
            Thumbnail,
            Auth,
            AlertMaximumSize
        },
        data(){
            return {
                loading: false,
                editPost: false,
                componentActive: null,
                auth : Auth.state,
                fileInput: {},
                replace_caption: false,
                post:{},
                controlsPost:{
                    prev: true,
                    next: false
                },
                copyright: null, /* Creado como testing */
                facebook_active: false,
                twitter_active: false,
                reddit_active: false,
            }
        },
        mounted(){
            this.changeTypePost(this.type)

            let post = this
            $('#carouselPublicPost').on('slid.bs.carousel', function (e) {
                post.controlsPost.prev = $('.carousel-item:first-child').hasClass('active')
                post.controlsPost.next = $('.carousel-item:last-child').hasClass('active')
            })
        },
        methods:{
            async store(){

                if(!this.auth.token){
                    $('#ModalLogin').modal('show')
                    return false

                }else if(this.post.genre === '' || this.post.category === ''){
                    $('.dropdown-required').removeClass('animate__animated animate__flash')

                    swal({
                        text: 'Please select a genre and topic',
                        className: 'swal-alert',
                        buttons: [false, 'Ok'],
                        dangerMode: true,
                    })
                    .then((res) => {
                        $('.dropdown-required').addClass('animate__animated animate__flash')
                    })
                    return false
                }else if(!this.copyright){
                    swal({
                        text: 'You must consent that you´re not infringing any copyright in order for you to publish your content.',
                        className: 'swal-alert',
                        buttons: [false, 'Ok'],
                        dangerMode: true,
                    })
                }

                if(this.loading) { return false} /* evita que se repita el metodo */

                this.loading = true
                await Auth.setSession()

                let imagePost = new FormData();

                if(!this.componentActive.store()){
                    alert('error')
                    return false
                }

                imagePost.append('resource_type', this.post.resource_type)
                imagePost.append('description', this.post.description)
                imagePost.append('genre', this.post.genre)
                imagePost.append('category', this.post.category)
                imagePost.append('privacy', this.post.privacy)

                /* Si tiene Archivo multimedia */
                if (this.post.resource != null && this.post.resource_type !== 'text') {
                    this.post.resource_type !== 'link'
                        ? imagePost.append('resource', this.post.resource, this.post.resource.name)
                        : imagePost.append('resource', this.post.resource)
                    if(this.post.resource_type === 'link'){
                        imagePost.append('link', this.post.link)
                        imagePost.append('domain', this.post.domain)
                        imagePost.append('link_info', JSON.stringify(this.post.link_info))
                    }
                    imagePost.append('allow_download', this.post.allow_download)
                    imagePost.append('replace_caption', this.post.replace_caption)
                    imagePost.append('appearance', this.post.appearance)

                    if(this.post.resource_type === 'video'){
                        this.$refs.Thumbnail.store()
                        let video = this.$refs.Thumbnail.video
                        this.post.thumbnail ? imagePost.append('thumbnail', this.post.thumbnail, this.post.thumbnail.name) : imagePost.append('thumbnail', video.thumbnail1, video.thumbnail1.name)
                    }
                }

                // esto se deberia poner en un helper para no tener que modificar datos en dos componentes diferentes //
                let upload_meter = this.$refs.alertUploadMeter
                upload_meter.source = axios.CancelToken.source();
                let self = this

                await axios.post(`/${this.auth.username}/Post/store`, imagePost, {
                    cancelToken: upload_meter.source.token,
                        headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress (e) {
                        let progress = Math.round(((e.loaded * 100.0) / e.total) + 10);
                        upload_meter.display = true
                        upload_meter.weight = self.getValuesUploadMeter(e.total)
                        upload_meter.load = self.getValuesUploadMeter(e.loaded)
                        upload_meter.porcentage = progress
                        if(progress === 100){
                            upload_meter.status = 'success'
                        }else{
                            upload_meter.status = 'btn'
                        }
                    }
                }).then(res =>{
                    if (!res.data.valid){
                        this.loading = false
                        $('#ModalAlert').modal('show')
                        return false
                    }

                    if (!res.data.saved) {
                        this.loading = false
                    }else{
                        if(this.facebook_active || this.twitter_active || this.reddit_active){
                            $('#ModalShared').modal('show')
                            this.$refs.sharePosting.post = res.data.post
                        }
                        this.$toasted.show('Content Published Successfully!', {
                            position: "bottom-right",
                            duration : 4000,
                            className: "notification",
                            keepOnHover: true
                        })

    
                        if(res.data.credit_first_video){
                            swal('success', "You've earned $5 in credit for uploading your first video", 'success');
                        }

                        if(res.data.credit_post_week){
                            swal('success', "You've earned $1 in credit for uploading your first post of the week", 'success');
                        }

                        setTimeout(function(){
                            window.location.replace('/')
                        }, 200)
                    }
                }).catch(err => {
                    if(err.data){
                        this.loading = false
                        swal({
                            text: 'han ocurred problem '+this.post.resource_type + ':(',
                            className: 'swal-alert',
                            buttons: [false, 'Ok'],
                            dangerMode: true,
                        })
                        $('.swal-footer').addClass('text-center')
                    }
                })
            },
            changeTypePost(post){
                if(this.editPost){
                    swal({
                        title: "Are you sure?",
                        text: "Changes made may not be saved.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if(willDelete) {
                            this.componentActive.reset()
                            this.changeComponentActive(post)
                        }
                    })
                    return true
                }
                this.changeComponentActive(post)
                this.$root.$refs.navFooter.setVars(true, 'post')
                this.controlsPost.publicPost = true
                $('.carousel-item').removeClass('active')
                $('.carousel-item:first-child').addClass('active')
            },
            async changeTypeIfLink(post){
                if(post === 'link'){
                    this.post.resource_type = post
                    this.fileInput.resource_type = post
                    this.componentActive = this.$refs.Link
                    this.editPost = true
                }
            },
            changeComponentActive(post){
                this.resetData()
                this.post.resource_type = post
                this.fileInput.resource_type = post
                switch(post){
                    case 'text':
                        this.componentActive = this.$refs.Text
                        break;
                    case 'audio':
                        this.fileInput.accept =  ".mp3"
                        this.componentActive = this.$refs.Audio
                        break;
                    case 'video':
                        this.fileInput.accept =  "video/*"
                        this.componentActive = this.$refs.Video
                        break;
                    case 'image':
                        this.fileInput.accept =  ".jpg, .png, .jpeg"
                        this.componentActive = this.$refs.Image
                        break;
                    case 'docs':
                        this.fileInput.accept =  ".pdf, .docx, .xlsx, .pptx"
                        this.componentActive = this.$refs.File
                        break;
                    case 'link':
                        this.componentActive = this.$refs.Link
                        break;
                }
                this.editPost = false
                let input_file_movil = $('#input-file-movil')
                input_file_movil.attr('accept', this.fileInput.accept)
                if(this.post.resource_type !== "text" && this.post.resource_type !== "link"){
                    input_file_movil.click()
                }
            },
            confirmResetData(){
                swal({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.componentActive.reset()
                        this.resetData()
                        $('#input-file-movil').val('')
                        window.location.replace('/')
                    }
                    return false
                });
            },
            resetData(){
                this.replace_caption = false
                this.editPost = false
                this.fileInput = {
                    accept: '',
                    resource: null,
                    extension: null,
                    name: null,
                }
                this.post = {
                    replace_caption: '',
                    allow_download: false,
                    description: '',
                    resource: null,
                    resource_type: 'text',
                    genre: '',
                    category: '',
                    privacy: 'Everyone',
                    appearance: '', /* solo funciona en el video */
                    thumbnail: '', /* solo video => /images/default-video.svg*/
                    link: '',
                    domain: '',
                    link_info: {},
                }
                this.controlsPost = {
                    publicPost: false,
                    prev: true,
                    next: false
                }
                // $('body').css({ position: "relative" })

            },
            saveFile(event){
                if(event.target.files[0].size > 209715200){
                    $("#AlertMaximumSize").modal('show')
                    return false
                }
                if(event.target.files.length > 0){
                    this.post.resource = event.target.files[0]
                    this.fileInput.name = (event.target.files[0].name.split('.')).shift()
                    this.fileInput.extension = (event.target.files[0].name.split('.')).pop()
                    var input = event.target;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = (e) => {
                            this.editPost = true
                            this.fileInput.resource = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                        if(this.post.resource_type === 'video'){
                            this.fileInput.resource = event.target.files[0]
                            if(this.componentActive.loadVideo()){
                                this.$refs.Thumbnail.loadThumbnail()
                            }
                        }

                    }
                }else{
                    this.resetData()
                }
            },
            changeFileInput(){
                // this.componentActive.btnShow = false
                if(this.post.resource_type != "text") {
                    $('#input-file-movil').val('')
                    $('#input-file-movil').click()
                }
            },
            toggleSlow(item){
                this.post.replace_caption = ''
                $(`#${item}`).addClass('slide-show')
                $(`#${item}`).slideToggle()
            },
            close(){
                this.controlsPost.publicPost = false
                this.$parent.close()
                $('body').css({ position: "relative" })
            },
            //esta funcion tambien esta en otro componente duplicado se debe colocar en el helper//
            getValuesUploadMeter(bytes, decimals = 2){
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + '' + sizes[i];
            },
        }
    }
</script>

<style lang="scss" scoped>

</style>
