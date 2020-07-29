<template>
    <section>
        <a :href="`/Post/${activity.token}`" class="no-underline text-white" target="_blank">
            <div class="img-activity bg-primary">
                <img :src="`${activity.resource}`" alt="activity" class="img-activity img-fluid" v-if="activity.resource_type == 'image'">
                <video :src="`${activity.resource}`" controls class="img-activity"  v-if="activity.resource_type == 'video'"  />
                <vue-wave-surfer :id="'waveform'+activity.token" :src="`${activity.resource}`" :options="options_audio" v-if="activity.resource_type === 'audio'" ref="surf"></vue-wave-surfer>
                <i class="fas fa-ellipsis-h text-white fa-2x mr-1 menu-activity"  id="dropdownMenuPost"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" v-if="showMenuPlaylist"></i>
                <div class="dropdown-menu bg-primary text-white p-2 menu-activity" aria-labelledby="dropdownMenuPost" v-if="!playlist">
                    <a :href="`/${user.username}/Post/get/${activity.token}`" class="dropdown-item">Go To Post</a>
                    <a href="#" class="dropdown-item link-post">Copy Link</a>
                    <a @click="view_post = false" class="dropdown-item">Hide Post</a>
                    <!-- <a href="#" class="dropdown-item">Report</a> -->
                    <div class="dropdown-item dropdown-submenu"  v-if="activity.resource_type == 'audio' || activity.resource_type == 'video'" @click="playlist = true">Add To Playlist</div>
                </div>
                <div class="ml-5 dropdown-menu bg-primary text-white p-2" v-if="playlist">
                    <div class="dropdown-item" @click="showModalNewPlaylist"> <i class="fas fa-plus-circle mr-2"></i> new playlist</div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item" v-for="(playlist, index) in user.playlists" :key="index" @click="addPostPlaylist(playlist)">{{ playlist.title }}</div>
                </div>
                <div class="d-flex align-items-center justify-content-center p-5" v-if="activity.resource_type == 'text'">
                    <span>{{descriptionLess}}</span>
                </div>
                <div class="img-activity" v-if="activity.resource_type == 'docs'">
                    <img :src="`${resource_extension === 'docx' ? '/images/documments/word-document.svg' : '' || resource_extension === 'pdf' ? '/images/documments/pdf-document.svg' : '' || resource_extension === 'xlsx' ? '/images/documments/excel-document.svg' : '' || resource_extension === 'pptx' ? '/images/documments/power-point-document.svg' : ''}`" v-if="resource_extension == 'pdf'" class="img-activity img-fluid p-3" style="width: 130px;"  />
                    <img :src="`${resource_extension === 'docx' ? '/images/documments/word-document.svg' : '' || resource_extension === 'pdf' ? '/images/documments/pdf-document.svg' : '' || resource_extension === 'xlsx' ? '/images/documments/excel-document.svg' : '' || resource_extension === 'pptx' ? '/images/documments/power-point-document.svg' : ''}`"  class="img-activity img-fluid p-3" style="width: 130px;"  v-else/>
                </div>
            </div>
        </a>
        <div v-if="!activity.replace_caption">
            <div v-if="activity.resource_type == 'image' || activity.resource_type == 'audio' || activity.resource_type == 'video'">
                <p class="m-1" v-if="activity.description">
                    <span v-if="showMore">{{description}}</span>
                    <span v-if="!showMore">{{descriptionLess}}</span>
                    <span class="c-fourth cursor-pointer mx-1 d-sm-down-none" @click="!showMore ? showMore = true : showMore = false" v-if="description.length > 50">{{!showMore ? 'See More...' : 'See Less'}}</span>
                </p>
            </div>
            <p v-if="activity.resource_type === 'docs' && activity.description">
                <a :href="`${activity.resource}`" class="text-white" v-if="resource_extension === 'pdf'">
                    <span v-if="showMore">{{description}}</span>
                    <span v-if="!showMore">{{descriptionLess}}</span>
                    <span class="c-fourth cursor-pointer mx-1 d-sm-down-none" @click="!showMore ? showMore = true : showMore = false" v-if="description.length > 50">{{!showMore ? 'See More...' : 'See Less'}}</span>
                </a>
                <label v-if="resource_extension !== 'pdf'">
                    <span v-if="showMore">{{description}}</span>
                    <span v-if="!showMore">{{descriptionLess}}</span>
                    <span class="c-fourth cursor-pointer mx-1 d-sm-down-none" @click="!showMore ? showMore = true : showMore = false" v-if="description.length > 50">{{!showMore ? 'See More...' : 'See Less'}}</span>
                </label>
            </p>
        </div>
        <div v-if="activity.replace_caption">
            <h5 class="font-weight-bold my-2">{{ activity.replace_caption }}</h5>
            <p v-if="activity.description">
                <a :href="`${activity.resource}`" class="text-white" v-if="activity.resource_type === 'docs' && resource_extension === 'pdf'">
                    <span v-if="showMore">{{description}}</span>
                    <span v-if="!showMore">{{descriptionLess}}</span>
                    <span class="c-fourth cursor-pointer mx-1 d-sm-down-none" @click="!showMore ? showMore = true : showMore = false" v-if="description.length > 50">{{!showMore ? 'See More...' : 'See Less'}}</span>
                </a>
                <label v-if="activity.resource_type === 'docs' && resource_extension !== 'pdf'">
                    <span v-if="showMore">{{description}}</span>
                    <span v-if="!showMore">{{descriptionLess}}</span>
                    <span class="c-fourth cursor-pointer mx-1 d-sm-down-none" @click="!showMore ? showMore = true : showMore = false" v-if="description.length > 50">{{!showMore ? 'See More...' : 'See Less'}}</span>
                </label>
            </p>
        </div>
        <div class="d-flex c-fourth my-3 justify-content-between px-3">
            <div :id="`voteUp`+activity.id" class="information cursor-pointer" @click="disable_vote_up ? '' : storeVoteUp(vote_type_up)"><img src="/images/icons/post-percentage-up.svg" alt=""><span>{{ votes.vote_up.length  }}</span></div>
            <div :id="`voteDown`+activity.id" class="information cursor-pointer" @click="disable_vote_down ? '' : storeVoteDown(vote_type_down)"><img src="/images/icons/post-percentage-down-grey.svg" alt=""><span>{{ votes.vote_down.length }}</span></div>
            <div :id="`lit`+activity.id" class="information cursor-pointer" @click="disable_like ? '' : storeLike(lit.like)" >
                <img src="/images/icons/post-flame.svg" height="22"><span>{{ activity.likes.length }}</span>
            </div>
            <div class="information cursor-pointer"><img src="/images/icons/post-share.svg" alt="" @click="showModalShare">{{activity.shares.length}}</div>
            <div class="information cursor-pointer" v-if="activity.allow_download">
                <a :href="`${activity.resource}`">
                    <img src="/images/icons/post-down.svg" alt="">
                </a>
            </div>
        </div>
        <div class="d-flex justify-content-between c-fourth">
            <p>{{activity.views.length }} {{activity.resource_type !== 'text' ? 'Plays' : 'Views'}}</p>
            <p>{{ activity.time_ago }}</p>
        </div>
    </section>
</template>

<script>
import Auth from "../../../../../helpers/Auth";
export default {
    props: ['activity','user'],
    data(){
        return {
            disable_like: false,
            disable_vote_up: false,
            disable_vote_down: false,
            showMore:false,
            dropdown: false,
            showMenuPlaylist: false,
            playlist: false,
            audio: '',
            lit:{
                like: 'like',
            },
            vote_type_up: 'vote_up',
            vote_type_down: 'vote_down',
            vote:{
                type_vote : ''
            },
            votes:{
                vote_up:[],
                vote_down:[]
            },
            link: '',
            options_audio:{
                waveColor: 'gray',
                barHeight: 0.8,
                cursorColor: 'red',
                cursorWidth: 0,
                forceDecode: true,
                hideScrollbar: true,
                responsive: true,
                interact: true,
                progressColor: this.getGrad(),
            },
        }
    },
    mounted(){
        Auth.initialize()
        this.getLike()
        this.getVote()
    },
    computed:{
        resource_extension() {
            if (this.activity.resource_type === 'docs'){
                let extension = this.activity.resource.split(".")
                return _.last(extension)
            }else{
                return 'not-document'
            }
        },
        descriptionLess(){
            if (this.activity.description){
                let text = this.activity.description
                let a = text.substr(0,50)
                return a
            }else{
                return ""
            }
        },
        description(){
            return this.activity.description
        }
    },
    methods: {
        showModalNewPlaylist(){
            $('#ModalPlaylist').modal('show')
        },
        showModalShare(){
            this.$parent.$children[2].post = this.activity
            $('#ModalShare').modal('show')
        },
        getGrad(){
            let linGrad = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 250, 0);
            linGrad.addColorStop(0, '#ff0000');
            linGrad.addColorStop(1, 'white');
            return linGrad
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
        storeLike(type){
            if (Auth.state.token) {
                let url = ''
                this.disable_vote_down = true
                this.disable_vote_up = true
                this.disable_like = true
                if (type == 'like') {
                    url =  `/${Auth.state.username}/LitLike/like/Post/${this.activity.id}`
                }
                if (type == 'unlike') {
                    if (this.activity.likes) {
                        this.activity.likes.map(value => {
                            if (Auth.state.username == value.user.username) {
                                url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                            }
                        })
                    }
                }
                axios.post(url, this.lit).then(res =>{
                    if (res.data.like) {
                        this.disable_vote_down = false
                        this.disable_vote_up = false
                        this.disable_like = false
                        this.lit.like = 'unlike'
                        this.activity.likes.push(res.data.like)
                        $(`#lit`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="22">')
                    }
                    if (res.data.unlike) {
                        this.disable_vote_down = false
                        this.disable_vote_up = false
                        this.disable_like = false
                        this.lit.like = 'like'
                        let indice = this.activity.likes.indexOf(res.data.like)
                        this.activity.likes.splice(indice, 1)
                        $(`#lit`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-flame.svg" height="22">')
                    }
                }).catch(err =>{
                    console.log(err)
                })
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        getVote(){
            if (Auth.state.token && Auth.state.token === this.$parent.user.token) {
                if (this.activity.votes) {
                    this.activity.votes.map(vote => {
                        if (vote.type_vote == 'vote_up') {
                            this.votes.vote_up.push(vote)
                            $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                            $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                            this.vote_type_up = 'unvote_up'
                            this.vote.type_vote = 'unvote_up'
                        }
                        if(vote.type_vote == 'vote_down'){
                            this.votes.vote_down.push(vote)
                            $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                            $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                            this.vote_type_down = 'unvote_down'
                            this.vote.type_vote = 'unvote_down'
                        }
                    })
                }
            }else{
                if (this.activity.votes) {
                    this.activity.votes.map(vote => {
                        if(vote.type_vote === 'vote_up') {this.votes.vote_up.push(vote)}
                        if(vote.type_vote === 'vote_down') {this.votes.vote_down.push(vote)}
                    })
                }
            }
        },
        storeVoteUp(type){
            if (Auth.state.token) {
                let request = ''
                this.disable_vote_up = true
                this.disable_vote_down = true
                this.disable_like = true
                if (type == 'vote_up') {
                    request = this.vote
                    this.vote.type_vote = 'vote_up'
                    this.url =  `/${Auth.state.username}/VotePost/VoteUp/${this.activity.id}`
                    if (this.votes.vote_down.length > 0) {
                        this.votes.vote_down.map(vote => {
                            axios.post(`/${Auth.state.username}/VotePost/UnVoteDown/${vote.id}`).then(res =>{
                                if(res.data.unvoteDown){
                                    this.vote_type_down = 'vote_down'
                                }
                            })
                        })
                    }
                }
                if (type == 'unvote_up') {
                    this.vote.type_vote = 'unvote_up'
                    if (this.votes.vote_up.length > 0) {
                        this.votes.vote_up.map(vote => {
                            this.url =  `/${Auth.state.username}/VotePost/UnVoteUp/${vote.id}`
                        })
                    }
                }

                axios.post(this.url, request).then(res => {
                    if (res.data.voteUp) {
                        this.disable_vote_up = false
                        this.disable_vote_down = false
                        this.disable_like = false
                        this.votes.vote_up.push(res.data.voteUp)
                        let indice = this.activity.votes.indexOf(res.data.voteUp)
                        this.votes.vote_down.splice(indice, 1)
                        this.vote.type_vote = 'unvote_up'
                        this.vote_type_up = 'unvote_up'

                        $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                        $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    }
                    if (res.data.unvoteUp) {
                        this.disable_vote_up = false
                        this.disable_vote_down = false
                        this.disable_like = false
                        let indice = this.activity.votes.indexOf(res.data.unvoteUp)
                        this.votes.vote_up.splice(indice, 1)
                        this.vote.type_vote = 'vote_up'
                        this.vote_type_up = 'vote_up'

                        $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                        $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    }

                })
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        storeVoteDown(type){
            if (Auth.state.token) {

                let request = ''
                this.disable_vote_down = true
                this.disable_vote_up = true
                this.disable_like = true
                if (type === 'vote_down'){
                    this.vote.type_vote = 'vote_down'
                    request = this.vote
                    this.url =  `/${Auth.state.username}/VotePost/VoteDown/${this.activity.id}`
                    if (this.votes.vote_up.length > 0){
                        this.votes.vote_up.map(vote =>{
                            if (Auth.state.username === vote.user.username) {
                                axios.post(`/${Auth.state.username}/VotePost/UnVoteUp/${vote.id}`).then(res =>{
                                    console.log(res)
                                    if(res.data.unvoteUp){
                                        this.vote_type_up = 'vote_up'
                                    }
                                }).catch(err =>{
                                    console.log(err)
                                })
                            }
                        })
                    }
                }
                if (type === 'unvote_down') {
                    this.vote.type_vote = 'unvote_down'
                    request = this.vote
                    if(this.votes.vote_down.length > 0){
                        this.votes.vote_down.map(vote =>{
                            if(Auth.state.username === vote.user.username){
                                this.url = `/${Auth.state.username}/VotePost/UnVoteDown/${vote.id}`
                            }
                        })
                    }

                }
                axios.post(this.url, request).then(res => {
                    if (res.data.voteDown) {
                        this.disable_vote_down = false
                        this.disable_vote_up = false
                        this.disable_like = false
                        this.votes.vote_down.push(res.data.voteDown)
                        let indice = this.activity.votes.indexOf(res.data.voteDown)
                        this.votes.vote_up.splice(indice, 1)
                        this.vote.type_vote = 'unvote_down'
                        this.vote_type_down = 'unvote_down'
                        $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                        $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    }
                    if (res.data.unvoteDown) {
                        this.disable_vote_down = false
                        this.disable_vote_up = false
                        this.disable_like = false
                        let indice = this.activity.votes.indexOf(res.data.unvoteDown)
                        this.votes.vote_down.splice(indice, 1)
                        this.vote.type_vote = 'vote_up'
                        this.vote_type_down = 'vote_down'
                        $(`#voteDown`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                        $(`#voteUp`+this.activity.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                    }
                })
            }else{
                $('#ModalLogin').modal('show')
            }
        },

        addPostPlaylist(playlist){
            axios.post(`/${Auth.state.username}/Channel/Playlist/add/playlist/${this.activity.id}/${playlist.id}`).then(res =>{
                if (res.data.saved) {
                    this.$toasted.show(`the post has been successfully added to the playlist `+playlist.title, {
                        position: "bottom-right",
                        duration : 4000,
                        className: "p-4 notification bg-primary",
                        keepOnHover: true
                    })
                }
            })
        },
    },
}
</script>
