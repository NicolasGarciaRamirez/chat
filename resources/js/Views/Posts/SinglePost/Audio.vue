<template>
    <div :id="`component-audio${post.token}`" class="d-flex flex-column content img-fluid" v-if="post.resource">
        <div :id="`waveform`+post.token" class="wave-form-main" @click="$parent.storeView" v-if="post.resource_type === 'audio'"></div>
        <div :id="`waveformcontrols${post.token}`" class="d-flex justify-content-center" v-if="post.resource_type === 'audio'">
            <div class="d-flex flex-row text-center justify-content-center ml-auto">
                <!-- atras --> <svg class="icon audio backward-icon"  :id="`backward`+post.token" @click="!$parent.user_auth_is_privacy ? '' : backward()" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M1,10.4c0.1-0.2,0.2-0.3,0.4-0.3h1.4c0.9-4.9,5-8.6,10-8.6C18.4,1.5,23,6.2,23,12s-4.6,10.5-10.2,10.5 c-3.6,0-7-2-8.8-5.2c-0.3-0.5-0.1-1,0.3-1.3s1-0.1,1.3,0.3c1.5,2.6,4.2,4.3,7.2,4.3c4.6,0,8.3-3.9,8.3-8.6s-3.7-8.6-8.3-8.6 c-4,0-7.3,2.9-8.1,6.7h1.4c0.2,0,0.3,0.1,0.4,0.3s0.1,0.4-0.1,0.5l-2.3,2.9C4,13.9,3.9,14,3.7,14c-0.1,0-0.3-0.1-0.4-0.2L1,10.9 C1,10.7,1,10.5,1,10.4z"/> <path d="M10.5,8.1h1.4v7.4H9.7v-4.9l-1.6,1.1v-2L10.5,8.1z"/> <path d="M13.7,14.7c-0.5-0.6-0.8-1.6-0.8-2.9s0.3-2.2,0.8-2.8C14.2,8.3,15,8,16,8c1,0,1.8,0.3,2.3,1 c0.5,0.6,0.8,1.6,0.8,2.8s-0.3,2.2-0.8,2.9c-0.5,0.6-1.3,0.9-2.3,0.9C15,15.6,14.2,15.3,13.7,14.7z M16.5,13.7 c0.1-0.1,0.2-0.3,0.3-0.6c0.1-0.3,0.1-0.7,0.1-1.2s0-0.9-0.1-1.2c-0.1-0.3-0.2-0.5-0.3-0.6c-0.1-0.1-0.3-0.2-0.5-0.2 c-0.2,0-0.4,0.1-0.5,0.2c-0.1,0.1-0.2,0.3-0.3,0.6c-0.1,0.3-0.1,0.7-0.1,1.2s0,0.9,0.1,1.2c0.1,0.3,0.2,0.5,0.3,0.6 c0.1,0.1,0.3,0.2,0.5,0.2C16.2,13.8,16.4,13.8,16.5,13.7z"/> </svg>
                <div>
                    <input @keydown.space="playAudio()" @keydown.up="morvolume()" @keydown.down="disvolume()" @keydown.left="backward()" @keydown.right="forward()" ref="inputPlay" style="position: absolute;width: 1px;background: #141414;z-index: -1;left: -19rem;">
                </div>
                <div :id="`play`+post.token"  @click="!$parent.user_auth_is_privacy ? '' : playAudio()">
                    <div v-if="!$parent.user_auth_is_privacy">
                        <svg class="icon audio" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M19.4,9.8h-1.1V7.1C18.2,3.8,15.5,1,12,1S5.7,3.8,5.7,7.1v2.7H4.6C4.2,9.8,4,10.1,4,10.4v12 C4,22.8,4.3,23,4.6,23h14.8c0.4,0,0.6-0.3,0.6-0.6V10.5C20.1,10.1,19.8,9.8,19.4,9.8z M13,17.2v2.5c0,0.2-0.2,0.4-0.4,0.4h-1.2 c-0.2,0-0.4-0.2-0.4-0.4v-2.5c-0.4-0.3-0.7-0.8-0.7-1.4c0-0.9,0.8-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7C13.7,16.3,13.4,16.9,13,17.2z M15.3,9.8H8.7V7.1c0-1.8,1.4-3.2,3.3-3.2s3.3,1.4,3.3,3.2V9.8z"/></svg>
                    </div>
                    <div v-else-if="$parent.user_auth_is_privacy" >
                        <!-- pausa --><svg class="icon audio" v-if="!pause" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M10.1,16.1H8.4c-0.3,0-0.5-0.2-0.5-0.5 V8.4c0-0.3,0.2-0.5,0.5-0.5h1.8c0.3,0,0.5,0.2,0.5,0.5v7.3C10.6,15.9,10.4,16.1,10.1,16.1z M15.6,16.1h-1.8 c-0.3,0-0.5-0.2-0.5-0.5V8.4c0-0.3,0.2-0.5,0.5-0.5h1.8c0.3,0,0.5,0.2,0.5,0.5l0,7.3C16.1,15.9,15.9,16.1,15.6,16.1z"/> </svg>
                        <!-- play --> <svg class="icon audio" v-if="pause" @click="$parent.storeView()" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M12,1C5.9,1,1,5.9,1,12s4.9,11,11,11s11-4.9,11-11S18.1,1,12,1z M9.3,17.1V6.9c0-0.2,0.2-0.3,0.3-0.2 l7.7,5.1c0.1,0.1,0.1,0.3,0,0.4l-7.7,5.1C9.4,17.4,9.3,17.3,9.3,17.1z"/> </svg>
                    </div>
                </div>
                <!-- adelante --><svg class="icon audio forward-icon" @click="!$parent.user_auth_is_privacy ? '' : forward()" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M23,10.4c-0.1-0.2-0.2-0.3-0.4-0.3h-1.4c-0.9-4.9-5-8.6-10-8.6C5.6,1.5,1,6.2,1,12s4.6,10.5,10.2,10.5 c3.6,0,7-2,8.8-5.2c0.3-0.5,0.1-1-0.3-1.3s-1-0.1-1.3,0.3c-1.5,2.6-4.2,4.3-7.2,4.3c-4.6,0-8.3-3.9-8.3-8.6s3.7-8.6,8.3-8.6 c4,0,7.3,2.9,8.1,6.7h-1.4c-0.2,0-0.3,0.1-0.4,0.3s-0.1,0.4,0.1,0.5l2.3,2.9c0.1,0.1,0.2,0.2,0.4,0.2c0.1,0,0.3-0.1,0.4-0.2 l2.3-2.9C23,10.7,23,10.5,23,10.4z"/> <path d="M7.5,8.1h1.4v7.4H6.7v-4.9l-1.6,1.1v-2L7.5,8.1z"/> <path d="M10.7,14.7c-0.5-0.6-0.8-1.6-0.8-2.9s0.3-2.2,0.8-2.8C11.2,8.3,12,8,13,8c1,0,1.8,0.3,2.3,1 c0.5,0.6,0.8,1.6,0.8,2.8s-0.3,2.2-0.8,2.9c-0.5,0.6-1.3,0.9-2.3,0.9C12,15.6,11.2,15.3,10.7,14.7z M13.5,13.7 c0.1-0.1,0.2-0.3,0.3-0.6c0.1-0.3,0.1-0.7,0.1-1.2s0-0.9-0.1-1.2c-0.1-0.3-0.2-0.5-0.3-0.6c-0.1-0.1-0.3-0.2-0.5-0.2 c-0.2,0-0.4,0.1-0.5,0.2c-0.1,0.1-0.2,0.3-0.3,0.6c-0.1,0.3-0.1,0.7-0.1,1.2s0,0.9,0.1,1.2c0.1,0.3,0.2,0.5,0.3,0.6 c0.1,0.1,0.3,0.2,0.5,0.2C13.2,13.8,13.4,13.8,13.5,13.7z"/> </svg>
            </div>
            <div class="text-right ml-auto">
                <!-- sound on --><svg class="icon audio" v-if="getMute" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <g> <path fill="#999999" d="M19.3,5.2c-0.3,0.3-0.3,0.7,0,0.9c1.6,1.6,2.5,3.7,2.5,5.9c0,2.2-0.9,4.3-2.5,5.9c-0.4,0.4-0.1,1.1,0.5,1.1c0.2,0,0.3-0.1,0.5-0.2C22,17,23,14.6,23,12c0-2.6-1-5-2.8-6.8C19.9,4.9,19.5,4.9,19.3,5.2L19.3,5.2z"/><path fill="#999999" d="M17.4,16.1c-0.3,0.3-0.3,0.7,0,0.9c0.3,0.3,0.7,0.3,0.9,0c1.3-1.3,2.1-3.1,2.1-5s-0.7-3.7-2.1-5c-0.3-0.3-0.7-0.3-0.9,0c-0.3,0.3-0.3,0.7,0,0.9c1.1,1.1,1.7,2.5,1.7,4.1S18.5,15,17.4,16.1z"/><path fill="#999999" d="M15.6,15.2c0.3,0.3,0.7,0.3,0.9,0c0.9-0.8,1.3-2,1.3-3.2s-0.5-2.3-1.3-3.2c-0.3-0.3-0.7-0.3-0.9,0c-0.3,0.3-0.3,0.7,0,0.9c0.6,0.6,0.9,1.4,0.9,2.3c0,0.9-0.3,1.7-0.9,2.3C15.4,14.5,15.4,14.9,15.6,15.2L15.6,15.2z"/><path fill="#999999" d="M1.6,7.3h2.6v9.4H1.6c-0.4,0-0.6-0.3-0.6-0.6V7.9C1,7.6,1.3,7.3,1.6,7.3z"/><path fill="#999999" d="M14.1,4.4v15.2c0,0.9-1,1.5-1.8,1.1L5.5,17V7l6.7-3.7C13.1,2.9,14.1,3.5,14.1,4.4L14.1,4.4z"/></g></svg>
                <!-- sound off--><svg class="icon audio" v-if="!getMute" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"><g><path fill="#999999" d="M15.5,15.6c0.3,0.3,0.7,0.3,0.9,0l2.7-2.7l2.7,2.7c0.3,0.3,0.7,0.3,0.9,0c0.3-0.3,0.3-0.7,0-0.9L20.1,12l2.7-2.7c0.3-0.3,0.3-0.7,0-0.9c-0.3-0.3-0.7-0.3-0.9,0l-2.7,2.7l-2.7-2.7c-0.3-0.3-0.7-0.3-0.9,0c-0.3,0.3-0.3,0.7,0,0.9l2.7,2.7l-2.7,2.7C15.3,15,15.3,15.4,15.5,15.6z"/><path fill="#999999" d="M1.6,7.3h2.6v9.4H1.6c-0.4,0-0.6-0.3-0.6-0.6V7.9C1,7.6,1.3,7.3,1.6,7.3z"/><path fill="#999999" d="M14.1,4.4v15.2c0,0.9-1,1.5-1.8,1.1L5.5,17V7l6.7-3.7C13.1,2.9,14.1,3.5,14.1,4.4L14.1,4.4z"/></g></svg>
            </div>
        </div>
    </div>
</template>

<style scoped>
    svg{
        cursor: pointer;
        fill: #9999;
        margin-right: 0.5rem;
    }
    svg:hover{
        fill: #fff;
    }
    svg:active{
        opacity: 0.8;
        transform:scale(.9);
    }
    .forward-icon:active{
        transform:rotate(15deg) scale(.9) ;
    }
    .backward-icon:active{
        transform:rotate(-15deg) scale(.9) ;
    }
</style>
<script>
    import WaveSurfer from "wavesurfer.js";
    import FilterPost from "../../../helpers/FilterPost";

    export default {
        name: "Audio",
        props:['post', 'user'],
        data(){
            return {
                duration: '',
                current_time: '',
                wavesurfer: {},
                wave: '',
                audio: '',
                position: '',
                pause: true,

            }
        },
        computed:{
            getMute(){
                if(this.audio){
                    return this.audio.getMute()
                }else{
                     return false
                }
            }
        },
        created(){
            this.wave = this.generatePeak()
            this.createAudioWave()
        },
        updated() {
            this.createAudioWave()
        },
        mounted(){
            swal('estamos trabajando para mejorar tu experiencia!')
            this.position = $(`#component-audio${this.post.token}`).position()
            let self = this
            $(`#post-${this.post.token} .wave-form-main`).html('')
            this.generatePeak()
            this.createAudioWave()
            if(this.wavesurfer){
                this.wavesurfer.on('finish', () => {
                    this.pause = true
                    this.wavesurfer.stop()
                })
                if(this.wavesurfer.loaded){

                    if(window.innerWidth > 768){
                        this.$refs.inputPlay.focus()
                    }
                }
            }
        },
        destroyed() {
            if(this.post.resource_type === 'audio'){
                this.wave = this.generatePeak()
                this.createAudioWave()
            }
        },
        methods:{
            createAudioWave(){
                if(!this.wavesurfer.loaded){
                    $(`#post-${this.post.token} .wave-form-main`).html('')
                    let wave = document.querySelector(`#waveform${this.post.token}`)

                    if (!wave) {
                        return false;
                    }
                    this.wavesurfer = WaveSurfer.create({
                        container: wave,
                        backend: 'MediaElement',
                        waveColor: '#999999',
                        barHeight: 0.8,
                        cursorColor: 'red',
                        cursorWidth: 0,
                        responsive: true,
                        interact: true,
                        progressColor: this.getGrad(),
                    });

                    this.wavesurfer.song = `${this.post.resource}`
                    this.wavesurfer.backend.peaks = this.wave
                    this.wavesurfer.drawBuffer();
                    this.wavesurfer.loaded = false;
                    this.wavesurfer.setMute(true)
                }
            },
            getGrad(){
                let linGrad = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 1500, 0);
                linGrad.addColorStop(0, '#ff0035');
                linGrad.addColorStop(1, 'white');
                return linGrad
            },
            generatePeak(){
                let peak = []
                for(let i = 0;  i<1000; i++){peak.push(Math.random() * (0.2999 - 0.0001) + 0.0001)}
                return peak
            },
            pauseAudio(){
                // console.log(this.audio)
                // let prom = this.audio.pause()
                // console.log(prom)
            },
            focus(){
                this.$refs.inputPlay.focus()
            },
            muted(){
                this.wavesurfer.setMute(true)
            },
            playAudio(){

                if(window.innerWidth >= 768){
                    this.$refs.inputPlay.focus()
                }
                if(!this.wavesurfer.loaded){
                    this.wavesurfer.loadMediaElement(this.wavesurfer.song, this.wavesurfer.backend.peaks, false, this.wavesurfer.getDuration());
                    this.wavesurfer.loaded = true
                }

                this.audio = this.wavesurfer
                this.audio.setMute(true)
                this.duration = this.audio.getDuration()
                this.current_time = this.audio.getCurrentTime()

                while (this.duration === this.current_time) {
                    this.audio.play()
                    this.storeView()
                    return
                }
                this.pause = this.audio.isPlaying()
                this.audio.playPause()

                $('video').not(this).each(function(index, video){
                    video.pause()
                })
                // let self = this
                // $('audio').not(this).each(function(index, audio){
                //     // audio.pause()
                //     $(`#play`+self.post.token).click()
                // })
                // $('iframe').not(this).each(function(index, iframe){
                //     iframe.pause()
                // })

            },
            backward(){
                if(window.innerWidth > 768){
                    this.$refs.inputPlay.focus()
                }
                this.audio.skipBackward(10)
            },
            forward(){
                if(window.innerWidth > 768){
                    this.$refs.inputPlay.focus()
                }
                this.audio.skipForward(10)
            },
            disvolume(){
                if(window.innerWidth > 768){
                    this.$refs.inputPlay.focus()
                }
                let volume = 0
                this.audio.setVolume(volume + 0.1)
            },
            morvolume(){
                if(window.innerWidth > 768){
                    this.$refs.inputPlay.focus()
                }
                let volume = 1
                this.audio.setVolume(volume - 0.1)
            },
        }
    }
</script>

