<template>
    <section>
        <div class="d-flex flex-row">
            <div class="d-flex flex-column ml-3 content img-fluid" v-if="post.resource">
                <video :src="`${post.resource}`" v-if="post.resource_type == 'video'" height="200" width="200"/>
                <div :id="'waveformPlaylist'+post.token" v-if="post.resource_type == 'audio'" style="width:200px"></div>
            </div>
            <div class="d-flex flex-column pt-5 ml-3">
                <label class="font-weight-bold">{{ post.description }}</label>
                <label class="c-fourth">{{ post.time_ago }}</label>
                <div class="d-flex flex-row">
                    <div :id="`voteUp`+this.post.id" class="information cursor-pointer" @click="colorVote(vote_type == '' || vote_type == 'vote_down' || vote_type == 'unvote_down' ? vote_type = 'vote_up' : vote_type = 'unvote_up')"><img src="/images/icons/post-percentage-up.svg" alt="" height="22"><span class="c-fourth">{{ votes.vote_up.length  }}</span></div>
                    <div :id="`lit`+this.post.id" class="information cursor-pointer mx-3" @click="colorFlame(lit.like)" >
                        <img src="/images/icons/post-flame.svg" height="22"><span class="c-fourth">{{ post.likes ? post.likes.length : 0 }}</span>
                    </div>
                    <img src="/images/icons/post-comment.svg" alt="" height="22">
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Auth from '../../../helpers/Auth'
import WaveSurfer from 'wavesurfer.js'
export default {
    props:['post'],
    data(){
        return {
            lit:{
                like: 'like',
            },
            vote_type: '',
            vote:{
                type_vote : ''
            },
            votes:{
                vote_up:[],
                vote_down:[]
            },
        }
    },
    mounted(){
        this.getStyleAudio()
    },
    methods:{
        getStyleAudio(){
            if (this.post.resource_type == 'audio') {
                var linGrad = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 120, 0);
                linGrad.addColorStop(0, '#ff0000'); 
                linGrad.addColorStop(1, 'white');
                var audio = WaveSurfer.create({
                    container: `#waveformPlaylist`+this.post.token,
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
                audio.setHeight(200)
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
                $(`#playList`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)
                return false;
            }
            if(audio.isPlaying()){
                $(`#playList`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

            }else if(!audio.isPlaying()){
                $(`#playList`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Pause-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

            }
            audio.playPause()
        },
        backward(audio){
            audio.skipBackward(10)
        },
        forward(audio){
            audio.skipForward(10)
        },
        getLike() {
            if (this.post.likes) {
                this.post.likes.map(val => {
                    if (Auth.state.username == val.user.username ) {
                        $(`#lit`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="22">')
                        this.url = `/${Auth.state.username}/LitLike/unlike/${val.id}`
                        this.lit.like = 'unlike'
                    }
                })
            }
        },
        colorFlame(type){
            if (Auth.state.token) {
                if (type == 'like') {
                    $(`#lit`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="22">')
                    this.store(type)
                }
                if(type == 'unlike'){
                    $(`#lit`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-flame.svg" height="22">')
                    this.store(type)
                }
            }else{
                $('#ModalLogin').modal('show')
            }

        },
        getVote(){
            if (Auth.state.token) {
                if (this.post.votes) {
                    this.post.votes.map(vote => {
                        if (vote.type_vote == 'vote_up') {
                            this.votes.vote_up.push(vote)
                            $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                            $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                            this.vote_type = 'unvote_up'
                            this.vote.type_vote = 'unvote_up'
                        }
                        if(vote.type_vote == 'vote_down'){
                            this.votes.vote_down.push(vote)
                            $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                            $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                            this.vote_type = 'unvote_down'
                            this.vote.type_vote = 'unvote_down'
                        }
                    })
                }
            }else{
                if(this.post.votes){
                    this.post.votes.map(vote => {
                        if(vote.type === 'vote_up') this.votes.vote_up.push(vote)
                        if(vote.type === 'vote_down') this.votes.vote_down.push(vote)
                    })
                }
                //$('#ModalLogin').modal('show')
            }
        },
        colorVote(type){
            if (Auth.state.token) {
                if (type == 'vote_up') {
                    $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                    $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    this.vote.type_vote = 'vote_up'
                    this.store(type)
                }
                if (type == 'unvote_up') {
                    $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    this.vote.type_vote = 'unvote_up'
                    this.store(type)
                }
                if(type == 'vote_down'){
                    $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                    $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    this.vote.type_vote = 'vote_down'
                    this.store(type)
                }
                if (type == 'unvote_down') {
                    $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    this.vote.type_vote = 'unvote_down'
                    this.store(type)
                }
            }else{
                $('#ModalLogin').modal('show')
            }
        },
    }
}
</script>