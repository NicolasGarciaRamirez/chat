<template>
    <section>
        <div class="d-flex flex-column my-2 content img-fluid" v-if="post.resource">
            <div class="my-3">
                {{ post.description }}
            </div>
            <video :src="`${post.resource}`" controls  v-if="post.resource_type == 'video'" style="width:900px" />
            <div :id="'waveform'+post.token" v-if="post.resource_type == 'audio'" style="width:900px"></div>
            <div class="d-flex flex-row text-center justify-content-center" v-if="post.resource_type == 'audio'">
                <img src="/images/iconsplayer/Backward10sec-grey.svg" alt="" :id="`backward`+post.token" @click="backward(audio)" height="30" >
                <div :id="`play`+post.token"  @click="playAudio(audio)" >
                    <img src="/images/iconsplayer/Play-white.svg" alt="" class=" mx-3" height="33">
                </div>
                <img src="/images/iconsplayer/Forward10sec-grey.svg" alt="" @click="forward(audio)" height="30">
            </div>
        </div>
        <comments :post="post" :view_comment="true" />
    </section>
</template>

<script>
import Comments from '../../stream/comments/Comments'
import WaveSurfer from 'wavesurfer.js'
export default {
    props:['post'],
    components:{
        Comments
    },
    mounted(){
        this.getStyleAudio()
        this.getPlaylist()
    },
    methods:{
        getPlaylist(){
            var playlist = WaveSurfer.playlist()
            
            playlist.load(this.post.resource)
            console.log(playlist)
        },
        getStyleAudio(){
            if (this.post.resource_type == 'audio') {
                var linGrad = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 650, 0);
                linGrad.addColorStop(0, '#ff0000'); 
                linGrad.addColorStop(1, 'white');
                var audio = WaveSurfer.create({
                    container: `#waveform`+this.post.token,
                    waveColor: 'gray',
                    barHeight: 1,
                    cursorColor: 'red',
                    cursorWidth: 0,
                    forceDecode: true,
                    hideScrollbar: true,
                    progressColor: linGrad,
                    responsive: true,
                    interact: true,
                });
                audio.load(this.post.resource)
                audio.setHeight(500)
                var duration = audio.getDuration()
                this.audio = audio
                audio.skip(duration)
            }
        },
        playAudio(audio){
            var duration = audio.getDuration()
            var current_time = audio.getCurrentTime()
            if (duration == current_time) {
                audio.stop()
                $(`#play`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)
                return false;
            }
            if(audio.isPlaying()){
                $(`#play`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

            }else if(!audio.isPlaying()){
                $(`#play`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Pause-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

            }
            audio.playPause()
        },
        backward(audio){
            audio.skipBackward(10)
        },
        forward(audio){
            audio.skipForward(10)
        },
    }
}
</script>