<template>
    <div>
        <b>Choose Thumbnail:</b>
        <div class="text-left mb-3" >
            <div>
                <div>
                    <label class="check-button">
                        <input type="radio" name="thumbnail" value="Use Random Snapshot" v-on:change="toggleSlowValidate('random-snapshot-movil')" v-model="video.appearance">
                        <span><b class="ml-1">Use Random Snapshot</b></span>
                    </label>
                </div>
                <div id="random-snapshot-movil" :style="(video.appearance == 'random-snapshot-movil' ) ? '' : 'display: none;'">
                </div>
            </div>
            <div>
                <div>
                    <label class="check-button">
                        <input type="radio" name="thumbnail" value="Choose From Video" v-on:change="toggleSlowValidate('from-video-movil')" v-model="video.appearance" >
                        <span><b class="ml-1">Choose From Video</b></span>
                    </label>
                </div>
                <div id="from-video-movil" :style="(video.appearance == 'from-video-movil' ) ? '' : 'display: none;'">
                    <div id="video-element-canvas">
                        <video style="position: absolute; opacity: 0" id="main-video-movile" muted @loadedmetadata="loadedmetadata" @timeupdate="getImages"  autoplay>
                            <source type="video/mp4">
                        </video>
                    </div>
                    <div :class="`preview-video movile ${video.images.length >= 20 ? 'p-3' : 'd-none'}`">
                        <div class="preview-video__item-img" id="preview-imgs" >
                            <img :src="img" v-for="(img, index) in video.images" :key="index" :class="(index/2) === 0 ? 'd-none' : ''">
                        </div>
                        <div class="preview-video__content" id="preview">
                            <input type="range" min="0" max="200" value="0" steps="0.1" id="preview-input-movile">
                            <canvas id="video-canvas-movile" class="preview-video__divider movile animate__animated animate__fadeOut"></canvas>
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
                        <input type="radio" name="thumbnail" value="Upload Thumbnail" v-on:change="toggleSlowValidate('upload-thumbnail-movil')" v-model="video.appearance" >
                        <span><b class="ml-1">Upload Thumbnail</b></span>
                    </label>
                </div>
                <div id="upload-thumbnail-movil" :style="(video.appearance == 'upload-thumbnail' ) ? '' : 'display: none;'">
                    <div class="text-center">
                        <label class="btn btn-outline-light rounded-pill mb-0">
                            Upload Thumbnail
                            <input id="input-thumbnail-movil" name="img" type="file" accept=".jpg, .png, .jpeg" class="d-none" @change="previewImageThumbnail()"/>
                        </label>
                        <div class="upload-thumbnail movil p-3">
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
                show:false,
                replace_caption: false,
                video: {
                    canvas: null,
                    ctx: null,
                    content: null,
                    thumbnail1: null,
                    appearance: null,
                    images: []
                }
            }
        },
        methods:{
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
            loadThumbnail(){
                this.video.content = document.querySelector("#main-video-movile");
                this.video.content.setAttribute('src', URL.createObjectURL(this.file.resource))

                this.video.canvas = document.querySelector('#video-canvas-movile')
                this.video.ctx = this.video.canvas.getContext("2d")

                this.video.content.load()
            },
            toggleSlowValidate(item){
                $('.appearance-option-show').slideUp()
                $('.appearance-option-show').removeClass()
                $(`#${item}`).addClass('appearance-option-show')
                $(`#${item}`).slideDown()
                switch(item){
                    case 'random-snapshot-movil':
                        this.video.content.currentTime = Math.floor( (Math.random() * this.video.content.duration ) + 1 )
                        this.getImages()
                        break
                    case 'from-video-movil':
                        this.video.content.currentTime = Math.floor( (Math.random() * this.video.content.duration ) + 1 )
                        this.loadPreviewVideo()
                        break
                    // case 'Choose From Video']:

                }
            },
            previewImageThumbnail(){
                let input = document.getElementById('input-thumbnail-movil')
                this.$parent.post.thumbnail = input.files[0]
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = (e) => {
                        this.video.thumbnail1 = e.target.result;
                        if(document.querySelector('#upload-thumbnail-movil img')){
                            document.querySelector('.upload-thumbnail-img').setAttribute('src',e.target.result )
                        }else{
                            let img = document.createElement('img')
                            img.setAttribute('src',e.target.result )
                            img.classList.add('upload-thumbnail-img', 'w-100')
                            document.querySelector('.upload-thumbnail.movil').appendChild(img)
                        }
                        if(this.video.appearance == 'upload-thumbnail-movil'){
                            this.toggleSlow('upload-thumbnail-movil')
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            },
            loadPreviewVideo(){
                const inputSlider = document.querySelector("#preview-input-movile");
                let durationVideo =  this.video.content.duration
                inputSlider.setAttribute('max', durationVideo)

                const slideValue = document.querySelector(".preview-video__divider.movile");
                inputSlider.oninput = (()=>{
                    document.querySelector('.preview-video.movile').classList.remove('mb-3')
                    document.querySelector('.preview-video.movile').style.marginBottom = '180px'

                    let value = inputSlider.value;
                    let porcentage = (value / durationVideo) * 100
                    slideValue.dataset.time = value;
                    slideValue.style.left = porcentage + "%";
                    slideValue.style.transform  = `translateX(-${porcentage}%)`
                    slideValue.classList.remove("animate__fadeOut");
                    slideValue.classList.add("animate__fadeIn");


                    this.video.content.currentTime = value
                });
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
            toggleSlow(item){
                $(`#${item}`).addClass('slide-show')
                $(`#${item}`).slideToggle()
            },
            loadedmetadata(){
                this.video.canvas.width = this.video.content.videoWidth;
                this.video.canvas.height = this.video.content.videoHeight;
            },
        },

        watch:{
            show(){
                this.$parent.$refs.Video
            }
        }
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
