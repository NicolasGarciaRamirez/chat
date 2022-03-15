<template>
    <div>
        <div :class="`animate__animated ${(show) ? 'animate__fadeInUp' : 'd-none'} `">
            <div class="content-multimedia">
                <video id="preview-video" class="rounded-lg max-width m-3 shadow" controls controlsList="nodownload" preload>
                    <source type="video/mp4">
                </video>
                <a href="#" class="btn-close mr-3" v-on:click.prevent="selectVideo()">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.8,4.2c-4.3-4.3-11.3-4.3-15.6,0s-4.3,11.3,0,15.6s11.3,4.3,15.6,0S24.1,8.5,19.8,4.2z M15.6,16.6L12,13 l-3.6,3.6c-0.3,0.3-0.7,0.3-1,0c-0.3-0.3-0.3-0.7,0-1L11,12L7.4,8.4c-0.3-0.3-0.3-0.7,0-1c0.3-0.3,0.7-0.3,1,0L12,11l3.6-3.6 c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L13,12l3.6,3.6c0.3,0.3,0.3,0.7,0,1C16.3,16.8,15.8,16.8,15.6,16.6z"/> </svg>
                </a>
            </div>
            <hr class="">
            <div :class="`mx-3 animate__animated ${show ? 'animate__fadeInUp' : 'd-none'}`">
                <div class="text-center">
                    <b>Write Caption (Optional):</b>
                </div>
                <div class="content-checkbox" >
                    <div>
                        <label class="check-button">
                            <input type="checkbox"  v-on:change="toggleSlow('replace_caption_video')" v-model="replace_caption">
                            <span><b class="ml-1">Replace Caption with Title & Discription (YouTube Style)</b></span>
                        </label>
                    </div>
                </div>
                <div id="replace_caption_video" class="slide-hide">
                    <input type="text" class="form-control mb-3" v-model="$parent.post.replace_caption" placeholder="Add title..">
                </div>
                <textarea class="form-control mb-3 bg-third px-3 " rows="5" placeholder="Add Some value to the music industry..." id="textarea" v-model="$parent.post.description" style="border-radius: 30px; resize: block;"></textarea>
            </div>
            <hr class="">
            <div class="mx-3 text-center">
                <b>Choose Thumbnail:</b>
                <div class="text-left mb-3">
                    <div>
                        <div>
                            <label class="check-button">
                                <input type="radio" name="thumbnail" value="Use Random Snapshot" v-on:change="toggleSlowValidate('random-snapshot')" v-model="video.appearance">
                                <span><b class="ml-1">Use Random Snapshot</b></span>
                            </label>
                        </div>
                        <div id="random-snapshot" :style="(video.appearance == 'random-snapshot' ) ? '' : 'display: none;'">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label class="check-button">
                                <input type="radio" name="thumbnail" value="Choose From Video" v-on:change="toggleSlowValidate('from-video')" v-model="video.appearance" >
                                <span><b class="ml-1">Choose From Video</b></span>
                            </label>
                        </div>
                        <div id="from-video" :style="(video.appearance == 'from-video' ) ? '' : 'display: none;'">
                            <div id="video-element-canvas">
                                <video style="position: absolute; opacity: 0" id="main-video" muted @timeupdate="getImages" @loadedmetadata="loadedmetadata" autoplay>
                                    <source type="video/mp4">
                                </video>
                            </div>
                            <div :class="`preview-video ${video.images.length >= 20 ? 'mt-3 mb-3' : 'd-none'}`">
                                <div class="preview-video__item-img" id="preview-imgs" >
                                    <img :src="img" v-for="(img, index) in video.images" :key="index" :class="(index/2) === 0 ? 'd-none' : ''">
                                </div>
                                <div class="preview-video__content" id="preview">
                                    <input type="range" min="0" max="200" value="0" steps="0.1" id="preview-input">
                                    <canvas id="video-canvas" class="preview-video__divider animate__animated animate__fadeOut"></canvas>
                                </div>
                            </div>
                            <div class="text-center" v-if="video.images.length < 20">
                                <button class="btn " type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <label class="check-button">
                                <input type="radio" name="thumbnail" value="Upload Thumbnail" v-on:change="toggleSlowValidate('upload-thumbnail')" v-model="video.appearance" >
                                <span><b class="ml-1">Upload Thumbnail</b></span>
                            </label>
                        </div>
                        <div id="upload-thumbnail" :style="(video.appearance == 'upload-thumbnail' ) ? '' : 'display: none;'">
                            <div class="text-center">
                                <label class="btn btn-outline-light rounded-pill mb-0">
                                    Upload Thumbnail
                                    <input id="input-thumbnail" name="img" type="file" accept=".jpg, .png, .jpeg" class="d-none" @change="previewImageThumbnail()"/>
                                </label>
                                <div class="upload-thumbnail mx-auto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props:['file'],
        data(){
            return {
                video: {
                    images: []
                },
                show: null,
                replace_caption: null
            }
        },
        mounted(){
            $('.slide-hide').slideUp()
            $('.slide-hide').removeClass('slide-hide')
        },
        methods:{
            selectVideo(){
                this.$parent.confirmResetData('video')
            },
            reset(){
                if(document.querySelector('.upload-thumbnail img')){
                    document.querySelector('.upload-thumbnail').removeChild(document.querySelector('.upload-thumbnail img'))
                }
                $('.appearance-option-show').slideUp()
                $('.appearance-option-show').removeClass()
                this.video.ctx.clearRect(0, 0, 0, 0);
                this.show = false,
                this.replace_caption = false
                this.video = {
                    canvas: null,
                    ctx: null,
                    content: null,
                    thumbnail1: null,
                    appearance: null,
                    images: []
                }
                return true
            },
            previewImageThumbnail(){
                let input = document.getElementById('input-thumbnail')
                this.$parent.post.thumbnail = input.files[0]
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.video.thumbnail1 = e.target.result;
                        $('.upload-thumbnail').addClass('my-3')
                        if(document.querySelector('#upload-thumbnail img')){
                            document.querySelector('.upload-thumbnail-img').setAttribute('src', this.video.thumbnail1 )
                        }else{
                            let img = document.createElement('img')
                            img.setAttribute('src', this.video.thumbnail1 )
                            img.classList.add('upload-thumbnail-img','mb-3', 'w-100')
                            document.querySelector('.upload-thumbnail').appendChild(img)
                        }


                        if(this.video.appearance == 'upload-thumbnail'){
                            this.toggleSlow('upload-thumbnail')
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            },
            loadVideo(){
                // load preview
                let _previewVideo = document.querySelector("#preview-video");
                document.querySelector("#preview-video source").setAttribute('src', URL.createObjectURL(this.file.resource))
                // load Thumbnail
                this.video.canvas = document.querySelector('#video-canvas')
                this.video.ctx = this.video.canvas.getContext("2d")

                this.video.content = document.querySelector('#main-video')
                document.querySelector("#main-video source").setAttribute('src', URL.createObjectURL(this.file.resource))
                this.video.content.load()
                _previewVideo.load()
                this.show = true
            },
            loadPreviewVideo(){
                const inputSlider = document.querySelector("#preview-input");
                let durationVideo =  this.video.content.duration
                inputSlider.setAttribute('max', durationVideo)

                const slideValue = document.querySelector(".preview-video__divider");
                inputSlider.oninput = (()=>{
                    document.querySelector('.preview-video').classList.remove('mb-3')
                    document.querySelector('.preview-video').style.marginBottom = '200px'

                    let value = inputSlider.value;
                    let porcentage = (value / durationVideo) * 100
                    slideValue.dataset.time = value;
                    slideValue.style.left = porcentage + "%";
                    slideValue.style.transform  = `translateX(-${porcentage}%)`
                    slideValue.classList.remove("animate__fadeOut");
                    slideValue.classList.add("animate__fadeIn");


                    this.video.content.currentTime = value
                });
                // inputSlider.onblur = (()=>{
                //     slideValue.classList.remove("animate__fadeIn");
                //     slideValue.classList.add("animate__fadeOut");
                //     document.querySelector('.preview-video').style.marginBottom = '1rem'

                // });
            },
            getImages(){
                this.video.ctx.drawImage(this.video.content, 0, 0,this.video.content.videoWidth,this.video.content.videoHeight);
                let toData = this.video.canvas.toDataURL()
                this.video.thumbnail1 = toData
                if(this.video.images.length <= 30) {
                    this.video.images.push(toData)
                    return true
                }else {
                    this.video.content.pause()
                }
            },
            loadedmetadata(){
                this.video.canvas.width = this.video.content.videoWidth;
                this.video.canvas.height = this.video.content.videoHeight;
            },
            toggleSlowValidate(item){
                $('.appearance-option-show').slideUp()
                $('.appearance-option-show').removeClass()
                $(`#${item}`).addClass('appearance-option-show')
                $(`#${item}`).slideDown()
                switch(item){
                    case 'random-snapshot':
                        this.video.content.currentTime = Math.floor( (Math.random() * this.video.content.duration ) + 1 )
                        this.getImages()
                        break
                    case 'from-video':
                        this.video.content.currentTime = Math.floor( (Math.random() * this.video.content.duration ) + 1 )
                        this.loadPreviewVideo()
                        break
                    // case 'Choose From Video']:

                }
            },
            store(){
                let thumbnail = this.video.thumbnail1.split('data:image/png;base64,')
                const contentType = 'image/png';
                const b64Data = thumbnail[1];

                if(this.video.appearance !== 'Upload Thumbnail'){
                    this.video.thumbnail1 = this.b64toBlob(b64Data, contentType);
                }
                return true
            },
            b64toBlob(b64Data, contentType='', sliceSize=512){
                const byteCharacters = atob(b64Data);
                const byteArrays = [];
                for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                    const slice = byteCharacters.slice(offset, offset + sliceSize);
                    const byteNumbers = new Array(slice.length);
                    for (let i = 0; i < slice.length; i++) {
                        byteNumbers[i] = slice.charCodeAt(i);
                    }
                    const byteArray = new Uint8Array(byteNumbers);
                    byteArrays.push(byteArray);
                }
                const blob = new Blob(byteArrays, {type: contentType});
                return blob;
            },
            toggleSlow(item){
                $(`#${item}`).addClass('slide-show')
                $(`#${item}`).slideToggle()
            }
        },
    }
</script>

<style lang="scss" scoped>
    video,
    canvas{
        outline: none;
        max-height: 200px;
        width: auto;
    }
    .upload-thumbnail {
        padding-top: calc(100vh - 600px);
        max-width: 250px;
        max-height: 200px;
        margin:  auto;
        overflow: hidden;
        .upload-thumbnail-img{
            object-fit: contain;
            width: 	100%;
        }
    }
</style>
