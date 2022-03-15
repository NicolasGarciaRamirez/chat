<template>
    <div>
        <div class="content-multimedia text-center px-3">
            <a href="" class="btn content-icon btn-outline-light rounded-pill m-auto " v-on:click.prevent="selectImage()">
                Upload Video
                <div class="icon">
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M23,12c0-6.1-4.9-11-11-11S1,5.9,1,12s4.9,11,11,11S23,18.1,23,12z M10.7,17.9c-0.4,0-0.7-0.3-0.7-0.7 v-4.4H7.9c-0.6,0-1-0.7-0.6-1.2l4.1-5.2c0.3-0.4,0.9-0.4,1.2,0l4.1,5.2c0.4,0.5,0,1.2-0.6,1.2H14v4.4c0,0.4-0.3,0.7-0.7,0.7H10.7 L10.7,17.9z"/> </svg>
                </div>
            </a>
            <video id="preview-video-movil" class="etiqueta-video rounded-lg max-width my-3" controls controlsList="nodownload" preload>
                <source type="video/mp4">
            </video>
            <a href="" class="btn-close" v-on:click.prevent="$parent.confirmResetData('video')">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.8,4.2c-4.3-4.3-11.3-4.3-15.6,0s-4.3,11.3,0,15.6s11.3,4.3,15.6,0S24.1,8.5,19.8,4.2z M15.6,16.6L12,13 l-3.6,3.6c-0.3,0.3-0.7,0.3-1,0c-0.3-0.3-0.3-0.7,0-1L11,12L7.4,8.4c-0.3-0.3-0.3-0.7,0-1c0.3-0.3,0.7-0.3,1,0L12,11l3.6-3.6 c0.3-0.3,0.7-0.3,1,0c0.3,0.3,0.3,0.7,0,1L13,12l3.6,3.6c0.3,0.3,0.3,0.7,0,1C16.3,16.8,15.8,16.8,15.6,16.6z"/> </svg>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props:['file'],
        mounted() {
            this.$parent.changeFileInput()
        },
        methods:{
            selectImage(){
                this.$parent.changeFileInput()
            },
            loadVideo(){
                // // load preview
                // let _previewVideo = document.querySelector("#preview-video-movil");
                // document.querySelector("#preview-video-movil source").setAttribute('src', URL.createObjectURL(this.file.resource))

                let _previewVideo = document.getElementsByClassName('etiqueta-video')[0];
                document.querySelector(".etiqueta-video source").setAttribute('src',  URL.createObjectURL(this.file.resource));

                _previewVideo.load();

                $("body").addClass('loading');

                _previewVideo.addEventListener('progress', function() {
                    var start = this.buffered.start(0);
                    var end = this.buffered.end(0);

                    $("body").removeClass('loading');
                });


                return true
            },
            reset(){
                return true
            },
            store(){
                return true
                // let thumbnail = this.video.thumbnail1.split('data:image/png;base64,')
                // const contentType = 'image/png';
                // const b64Data = thumbnail[1];

                // if(this.video.appearance !== 'Upload Thumbnail'){
                    // this.video.thumbnail1 = this.b64toBlob(b64Data, contentType);
                // }
                // return true
            },
        }
    }
</script>

<style lang="scss" scoped>
    video,
    canvas{
        outline: none;
        width: 100%;
    }
</style>
