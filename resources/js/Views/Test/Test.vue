<template>
    <section>
        <div id="waveform"></div>
        <div class="d-flex flex-row text-center justify-content-center" >
            <img src="/images/iconsplayer/Backward10sec-grey.svg" alt="" class="cursor-pointer" @click="backward()" height="30" >
            <div @click="playAudio()" >
                <img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">
            </div>
            <img src="/images/iconsplayer/Forward10sec-grey.svg" alt="" class="cursor-pointer" @click="forward()" height="30">
        </div>
    </section>
</template>

<script>

import WaveSurfer from 'wavesurfer.js';
import PeakCache from 'wavesurfer.js/src/peakcache.js'

export default {
    data(){
        return {
            wavesurfer: {}
        }
    },
    mounted(){
        this.createAudioWave()
    },
    methods:{
        createAudioWave(){
            this.wavesurfer = WaveSurfer.create({
                container: '#waveform',
                waveColor: 'gray',
                barHeight: 0.8,
                cursorColor: 'red',
                cursorWidth: 0,
                responsive: true,
                interact: true,
                partialRender: true,
                progressColor: this.getGrad(),
            });
            this.wavesurfer.load('/images/post/audio/R67d1f2epE/c4ca4238a0b923820dcc509a6f75849bAUD-20161126-WA0004.mp3');
        },
        getGrad(){
            let linGrad = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 850, 0);
            linGrad.addColorStop(0, '#ff0000');
            linGrad.addColorStop(1, 'white');
            return linGrad
        },
        playAudio(){
            this.wavesurfer.play()
        },
        forward(){

        },
        backward(){

        }
    }
}
</script>
