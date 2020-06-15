<template>
    <section>
        <div class="img-activity bg-primary">
            <img :src="`${activity.resource}`" alt="activity" class="img-activity img-fluid" v-if="activity.resource_type == 'image'">
            <video :src="`${activity.resource}`" controls  width="350" height="200" style="max-height: 200px" v-if="activity.resource_type == 'video'" />
            <div :id="'waveform'+activity.token" v-if="activity.resource_type == 'audio'"></div>
            <div class="d-flex flex-row text-center justify-content-center" v-if="activity.resource_type == 'audio'">
                <img src="/images/iconsplayer/Backward10sec-grey.svg" alt="" class="cursor-pointer" :id="`backward`+activity.token" @click="backward(audio)" height="30" >
                <div :id="`play`+activity.token"  @click="playAudio(audio, isPlaying)" @change.prevent="getAudio" >
                    <img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">
                </div>
                <img src="/images/iconsplayer/Forward10sec-grey.svg" alt="" class="cursor-pointer" @click="forward(audio)" height="30">
            </div>
            <div class="d-flex align-items-center justify-content-center p-5" v-if="activity.resource_type == 'text'">{{ activity.description }}</div>
            <div>
                <a :href="`${activity.resource}`" class="no-underline">
                    <img src="/images/icons/word-document.svg" class="img-activity img-fluid p-3" style="width: 130px; margin-left: 106px;" v-if="activity.resource_type == 'docs'" />
                </a>
            </div>
        </div>
        <div style="overflow: auto; max-height: 68px;" v-if="activity.resource_type == 'image' || activity.resource_type == 'audio' || activity.resource_type == 'video'">
            <h5 class="m-1">{{ activity.description }}</h5>
        </div>
        <h3 v-if="activity.resource_type == 'docs'">
            <a :href="`${activity.resource}`" class="text-white">{{ activity.description }}</a>
        </h3>
        <div class="d-flex c-fourth my-3">
            <div :id="`voteUp`+activity.id" class="information cursor-pointer" @click="colorVote(vote_type == '' || vote_type == 'vote_down' || vote_type == 'unvote_down' ? vote_type = 'vote_up' : vote_type = 'unvote_up')"><img src="/images/icons/post-percentage-up.svg" alt=""><span>{{ votes.vote_up.length  }}</span></div>
            <div :id="`voteDown`+activity.id" class="information cursor-pointer" @click="colorVote(vote_type == '' || vote_type == 'vote_up' || vote_type == 'unvote_up' ? vote_type = 'vote_down' : vote_type = 'unvote_down')"><img src="/images/icons/post-percentage-down-grey.svg" alt=""><span>{{ votes.vote_down.length }}</span></div>
            <div :id="`lit`+activity.id" class="information cursor-pointer" @click="colorFlame(lit.like)" >
                <img src="/images/icons/post-flame.svg" height="22"><span>{{ activity.likes.length }}</span>
            </div>
            <div class="information cursor-pointer"><img src="/images/icons/post-up.svg" alt="">100</div>
            <div class="information cursor-pointer" v-if="activity.allow_download"><img src="/images/icons/post-down.svg" alt="">100</div>
        </div>
        <div class="d-flex justify-content-between c-fourth">
            <p>11K Views </p>
            <p>{{ activity.time_ago }}</p>
        </div>
        <modal-login />
    </section>
</template>

<script>
import Auth from '../../../helpers/Auth'
import ModalLogin from '../../auth/Login'
import WaveSurfer from 'wavesurfer.js';

export default {
    props: ['activity'],
    components:{
        ModalLogin
    },
    data(){
        return {
            audio: '',
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
            link: ''
        }
    },
    mounted(){
        Auth.initialize()
        this.getStyleAudio()
        this.getLike()
        this.getVote()
    },
    methods: {
        getStyleAudio(){
            if (this.activity.resource_type == 'audio') {
                var audio = WaveSurfer.create({
                    container: `#waveform`+this.activity.token,
                    waveColor: 'gray',
                    barHeight: 1,
                    cursorColor: 'linear-gradient(90deg, rgba(255,0,0,0.7511379551820728) 0%, rgba(255,87,87,1) 48%, rgba(255,255,255,1) 100%);',
                    cursorWidth: 0,
                    forceDecode: true,
                    hideScrollbar: true,
                    progressColor: 'red',
                    responsive: true
                });
                audio.load(this.activity.resource)
                audio.setHeight(200)
                this.audio = audio
            }
        },
        playAudio(audio){
            var duration = audio.getDuration()
            var current_time = audio.getCurrentTime()
            if (duration == current_time) {
                audio.stop()
                $(`#play`+this.activity.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)
                return false;
            }
            if(audio.isPlaying()){
                $(`#play`+this.activity.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

            }else if(!audio.isPlaying()){
                $(`#play`+this.activity.token+` img`).replaceWith(`<img src="/images/iconsplayer/Pause-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

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
            if (Auth.state.username) {
                if (this.activity.likes) {
                    this.activity.likes.map(val => {
                        if (Auth.state.username == val.user.username ) {
                            $(`#lit`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="22">')
                            this.url = `/${Auth.state.username}/LitLike/unlike/${val.id}`
                            this.lit.like = 'unlike'
                        }
                    })
                }
            }
        },
        colorFlame(type){
            if (Auth.state.username) {
                if (type == 'like') {
                    $(`#lit`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="22">')
                    this.store(type)
                }
                if(type == 'unlike'){
                    $(`#lit`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-flame.svg" height="22">')
                    this.store(type)
                }
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        getVote(){
            if (this.activity.votes) {
                this.activity.votes.map(vote => {
                    if (vote.type_vote == 'vote_up') {
                        this.votes.vote_up.push(vote)
                        $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                        $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                        this.vote_type = 'unvote_up'
                        this.vote.type_vote = 'unvote_up'
                    }
                    if(vote.type_vote == 'vote_down'){
                        this.votes.vote_down.push(vote)
                        $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                        $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                        this.vote_type = 'unvote_down'
                        this.vote.type_vote = 'unvote_down'
                    }
                })
            }
        },
        colorVote(type){
            if (Auth.state.username) {
                if (type == 'vote_up') {
                    $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                    $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    this.vote.type_vote = 'vote_up'
                    this.store(type)
                }
                if (type == 'unvote_up') {
                    $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    this.vote.type_vote = 'unvote_up'
                    this.store(type)
                }
                if(type == 'vote_down'){
                    $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                    $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    this.vote.type_vote = 'vote_down'
                    this.store(type)
                }
                if (type == 'unvote_down') {
                    $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    this.vote.type_vote = 'unvote_down'
                    this.store(type)
                }
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        store(type){
            var request =''
            if (type == 'unlike') {
                request = this.lit
                if (this.activity.likes) {
                    this.activity.likes.map(value => {
                        if (Auth.state.username == value.user.username) {
                            this.url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                        }
                    })
                }
            }
            if (type == 'like') {
                request = this.lit
                this.url =  `/${Auth.state.username}/LitLike/like/Post/${this.activity.id}`
            }
            if (type == 'vote_up') {
                request = this.vote
                this.url =  `/${Auth.state.username}/VotePost/VoteUp/${this.activity.id}`
                if (this.votes.vote_down) {
                    this.votes.vote_down.map(vote => {
                        this.url =  `/${Auth.state.username}/VotePost/VoteUp/${this.activity.id}/${vote.id}`
                    })
                }
            }
            if (type == 'unvote_up') {
                if (this.votes.vote_up) {
                    this.votes.vote_up.map(vote => {
                        this.url =  `/${Auth.state.username}/VotePost/UnVoteUp/${vote.id}`
                    })
                }
            }
            if (type == 'vote_down'){
                request = this.vote
                this.url =  `/${Auth.state.username}/VotePost/VoteDown/${this.activity.id}`
                if (this.votes.vote_up){
                    this.votes.vote_up.map(vote =>{
                        if (Auth.state.username == vote.user.username) {
                            this.url = `/${Auth.state.username}/VotePost/VoteDown/${this.activity.id}/${vote.id}`
                        }
                    })
                }
            }
            if (type == 'unvote_down') {
                if (this.votes.vote_down) {
                    this.votes.vote_down.map(vote =>{
                        this.url = `/${Auth.state.username}/VotePost/UnVoteDown/${vote.id}`
                    })
                }
            }
            axios.post(this.url, request).then(res =>{
                if (res.data.like) {
                    console.log(res.data)
                    this.lit.like = 'unlike'
                    this.activity.likes.push(res.data.like)
                }
                if (res.data.unlike) {
                    this.lit.like = 'like'
                    let indice = this.activity.likes.indexOf(res.data.like)
                    this.activity.likes.splice(indice, 1)
                }
                if (res.data.voteUp) {
                    this.votes.vote_up.push(res.data.voteUp)
                    let indice = this.activity.votes.indexOf(res.data.voteUp)
                    this.votes.vote_down.splice(indice, 1)
                    this.vote.type_vote = 'unvote_up'
                }
                if (res.data.unvoteUp) {
                    let indice = this.activity.votes.indexOf(res.data.unvoteUp)
                    this.votes.vote_up.splice(indice, 1)
                    this.vote.type_vote = 'vote_up'
                }
                if (res.data.voteDown) {
                    this.votes.vote_down.push(res.data.voteDown)
                    let indice = this.activity.votes.indexOf(res.data.voteDown)
                    this.votes.vote_up.splice(indice, 1)
                    this.vote.type_vote = 'unvote_down'
                }
                if (res.data.unvoteDown) {
                    let indice = this.activity.votes.indexOf(res.data.unvoteDown)
                    this.votes.vote_down.splice(indice, 1)
                    this.vote.type_vote = 'vote_up'
                }
            }).catch(err =>{
                console.log(err)
            })
        }
    },
}
</script>