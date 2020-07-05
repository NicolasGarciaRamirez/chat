<template>
    <section class="post mt-3" v-if="view_post" v-on:click="onScroll">
        <div class="post-head bg-primary d-md-flex align-items-start justify-content-between p-3"  >
            <div class="d-flex justify-content-between align-items-center post-user-actions order-md-2">
                <div :id="`follow`+post.token" @click="colorFollow(follow_type)">
                    <button type="button" class="bg-primary align-items-right border-white">FOLLOW
                        <img src="/images/icons/star.svg" class="c-fifth ml-2 ">
                    </button>
                </div>
                <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger d-sm-down-none " @click="showModalSupport">SUPPORT
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="23px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-2">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M775.617,0.807c-91.897,0-177.902,44.438-234.538,118.658C484.384,45.246,398.382,0.807,306.482,0.807
                        C140.316,0.807,5.113,143.518,5.113,319.004c0,137.825,77.957,297.373,231.784,474.343
                        c118.566,136.343,247.543,241.941,284.236,271.054l19.945,15.792l19.889-15.792c36.693-29.112,165.67-134.653,284.237-271.054
                        c153.823-176.912,231.84-336.519,231.84-474.343C1077.045,143.518,941.842,0.807,775.617,0.807"/>
                    </svg>
                </button>
                <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger d-sm-down-none " @click="showModalReward">REWARD
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="15px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-2">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M1078.159,1.365h-508.24L3.615,515.729h353.029l-204.69,563.042l895.973-777.405H758.889L1078.159,1.365z
                        M569.919,454.482c-0.171-0.055-0.256-0.055-0.344-0.055c-0.171,0-0.256-0.055-0.427-0.055c1.544-1.828,3.175-3.627,4.55-5.564
                        C572.497,450.745,571.209,452.544,569.919,454.482 M725.56,192.275c-6.612,0.167-12.882-0.442-18.895-1.855
                        C712.678,191.25,719.032,191.833,725.56,192.275"/>
                    </svg>
                </button>
                <i class="fas fa-ellipsis-h c-third fa-2x mr-1"  id="dropdownMenuPost"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu bg-primary text-white p-2" aria-labelledby="dropdownMenuPost">
                    <div v-if="!menuPlaylist">
                        <a :href="`/${post.user.username}/Profile/WorkHistory`" target="_blank" class="dropdown-item">Go To User Profile</a>
                        <!-- <a href="#" class="dropdown-item">Message User</a> -->
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item" @click="edit = true" v-if="auth.username == post.user.username">Edit description</div>
                        <div class="dropdown-item" @click="showModalSure" v-if="auth.username == post.user.username">Delete Post</div>
                        <a :href="`/${post.user.username}/Post/get/${post.token}`" target="_blank" class="dropdown-item">Go To Post</a>
                        <a href="#" class="dropdown-item link-post" @click="copyLink">Copy Link</a>
                        <div class="dropdown-item cursor-pointer" >Hide Post</div>
                        <a href="mailto:support@noisesahrks.com" class="dropdown-item" v-if="auth.username != post.user.username">Report</a>
                        <!-- <div class="dropdown-item" @click="menuPlaylist = true" v-if="post.resource_type == 'audio' || post.resource_type == 'video'">Add To Playlist</div> -->
                    </div>
                    <div v-if="menuPlaylist">
                        <div class="dropdown-item" @click="showModalNewPlaylist"> <i class="fas fa-plus-circle mr-2"></i> new playlist</div>
                        <div class="dropdown-divider"></div>
                        <!-- <a href="" class="dropdown-item" v-for="(playlist, index) in playlist" :key="index">{{ playlist.name }}</a> -->
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <img :src="`${post.user.avatar}`" alt="" class="post-user-image rounded-pill">
                <div class="d-flex flex-column pl-md-3">
                    <a :href="`/${post.user.username}/Profile/WorkHistory`" class="text-white post-user-name">{{ post.user.profile_information && post.user.profile_information.artistic_name != null ? post.user.profile_information.artistic_name : post.user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="" class="check-icon" ></a>
                    <div class="d-flex align-items-center post-user-type mt-2">
                        <button class="btn bg-fifth text-white mr-2">{{ post.user.profile_information ? post.user.profile_information.title : 'Profile Title Not Chosen' }}</button>
                        <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="btn bg-white c-fifth d-flex align-items-center justify-content-center">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red"></button>
                    </div>
                </div>
            </div>
        </div>
         <div class="text p-3 item bg-primary" id="description" v-if="!post.replace_caption">
            <span v-if="!edit && !post.replace_caption && post.resource_type != 'docs'">{{ post.description }}</span>
            <a :href="`${post.resource}`"  class="text-white p-3"  v-if="post.resource_type == 'docs'">
                <h2>{{ post.description }}</h2>
            </a>
            <form @submit.prevent="update"  v-if="edit && !post.replace_caption ">
                <textarea
                    class="form-control bg-primary"
                    rows="5"
                    placeholder="Add Some value to the music industry..."
                    id="textarea"
                    v-model="post.description"
                    >
                </textarea>
                <div class="btn text-white bg-primary rounded-pill float-right mx-3" @click="edit = false">Cancel Edit</div>
                <button type="submit" class="btn text-white bg-fifth rounded-pill float-right">Save Edit</button>
            </form>
        </div>
        <div class="post-body bg-primary">
            <div>
                <div class="d-flex flex-column mt-1 content img-fluid p-3" v-if="post.resource">
                    <img :src="`${post.resource}`"  alt="img-post" class="img-fluid cursor-point" v-if="post.resource_type == 'image'" />
                    <video :src="`${post.resource}`" controls  v-if="post.resource_type == 'video'" />
                    <vue-wave-surfer :id="'waveform'+post.token" :src="`${post.resource}`" :options="options_audio" v-if="post.resource_type == 'audio'" ref="surf"></vue-wave-surfer>
<!--                    <div :id="'waveform'+post.token"  @change="current_time == duration ? playAudio(audio) : ''"></div>-->
                    <div class="d-flex flex-row text-center justify-content-center" v-if="post.resource_type == 'audio'">
                        <img src="/images/iconsplayer/Backward10sec-grey.svg" alt="" :id="`backward`+post.token" @click="backward(audio)" height="30" >
                        <div :id="`play`+post.token"  @click="playAudio()" >
                            <img src="/images/iconsplayer/Play-white.svg" alt="" class=" mx-3" height="33">
                        </div>
                        <img src="/images/iconsplayer/Forward10sec-grey.svg" alt="" @click="forward(audio)" height="30">
                    </div>
                    <img src="/images/icons/word-document.svg"  v-if="post.resource_type == 'docs'" style="min-height: 13rem; max-height: 13rem;">
                    <!-- <document-preview :value="post.resource" :type="docType" v-if="post.resource_type == 'docs'" /> -->
                  
                    <div v-if="post.replace_caption">
                        <a :href="`${post.resource}`"  class="text-white p-3"  v-if="post.resource_type == 'docs'">
                            <h2>{{ post.description }}</h2>
                        </a>
                        <h3 class="mb-3 font-weight-bold" v-if="!edit && post.resource_type != 'docs'">{{ post.replace_caption }}</h3>
                        <p v-if="!edit">{{ post.description }}</p>
                        <form @submit.prevent="update"  v-if="edit && post.replace_caption ">
                            <input type="text" class="form-control bg-primary rounded-pill my-2" v-model="post.replace_caption" />
                            <textarea
                                class="form-control bg-primary "
                                rows="5"
                                placeholder="Add Some value to the music industry..."
                                id="textarea"
                                v-model="post.description"
                                >
                            </textarea>
                            <div class="btn text-white bg-primary rounded-pill float-right mx-3" @click="edit = false">Cancel Edit</div>
                            <button type="submit" class="btn text-white bg-fifth rounded-pill float-right">Save Edit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between align-items-center post-user-actions d-block d-xl-none d-md-none pt-2">
                 <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger mx-2  w-100" @click="showModalSupport">SUPPORT
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="18px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-3">
                    <path fill="#141414" stroke="red" stroke-width="60" d="M775.617,0.807c-91.897,0-177.902,44.438-234.538,118.658C484.384,45.246,398.382,0.807,306.482,0.807
                        C140.316,0.807,5.113,143.518,5.113,319.004c0,137.825,77.957,297.373,231.784,474.343
                        c118.566,136.343,247.543,241.941,284.236,271.054l19.945,15.792l19.889-15.792c36.693-29.112,165.67-134.653,284.237-271.054
                        c153.823-176.912,231.84-336.519,231.84-474.343C1077.045,143.518,941.842,0.807,775.617,0.807"/>
                    </svg>
                </button>
                <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger mx-2 w-100" @click="showModalReward">REWARD
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="15px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-3">
                    <path fill="#141414" stroke="red" stroke-width="60" d="M1078.159,1.365h-508.24L3.615,515.729h353.029l-204.69,563.042l895.973-777.405H758.889L1078.159,1.365z
                        M569.919,454.482c-0.171-0.055-0.256-0.055-0.344-0.055c-0.171,0-0.256-0.055-0.427-0.055c1.544-1.828,3.175-3.627,4.55-5.564
                        C572.497,450.745,571.209,452.544,569.919,454.482 M725.56,192.275c-6.612,0.167-12.882-0.442-18.895-1.855
                        C712.678,191.25,719.032,191.833,725.56,192.275"/>
                    </svg>
                </button>
            </div>
            <div class="p-3 ">
                <span class="c-fourth">0 {{ post.resource_type == 'audio' || post.resource_type == 'video' ? 'Plays' : 'Views' }}</span>
                <span class="c-fourth mx-3">{{ post.time_ago }}</span>
            </div>
        </div>
        <div class="post-footer bg-primary px-3 py-2">
            <div class="d-flex c-fourth ">
                <div :id="`voteUp`+this.post.id" class="information cursor-pointer" @click="colorVote(vote_type == '' || vote_type == 'vote_down' || vote_type == 'unvote_down' ? vote_type = 'vote_up' : vote_type = 'unvote_up')"><img src="/images/icons/post-percentage-up.svg" alt=""><span>{{ votes.vote_up.length  }}</span></div>
                <div :id="`voteDown`+this.post.id" class="information cursor-pointer" @click="colorVote(vote_type == '' || vote_type == 'vote_up' || vote_type == 'unvote_up' ? vote_type = 'vote_down' : vote_type = 'unvote_down')"><img src="/images/icons/post-percentage-down-grey.svg" alt=""><span>{{ votes.vote_down.length }}</span></div>
                <div :id="`lit`+this.post.id" class="information cursor-pointer" @click="colorFlame(lit.like)" >
                    <img src="/images/icons/post-flame.svg" height="22"><span>{{ post.likes ? post.likes.length : 0 }}</span>
                </div>
                <div class="information cursor-pointer" @click="$parent.view_comment = !$parent.view_comment"><img src="/images/icons/post-comment.svg" alt="">{{ post.comments.length }}</div>
                <div class="information cursor-pointer" @click="showModalSharePost"><img src="/images/icons/post-up.svg" alt="">100</div>
                <div class="information cursor-pointer" v-if="post.allow_download"><img src="/images/icons/post-down.svg" alt="">100</div>
            </div>
        </div>
        <comments :post="post" :view_comment="view_comment"/>
        <textarea id="link" :value="link" class="d-none"></textarea>
        <modal-share-post :post="post" />
        <modal-sure-delete />
    </section>
</template>

<script>
    import Comments from './comments/Comments'
    import Auth from '../../helpers/Auth'
    import ModalSharePost from './ModalSharePost'
    import ModalSureDelete from './includes/ModalSureDeleted'
    import DocumentPreview from 'vue-doc-preview'

    export default {
        props:['post','user'],
        components:{
            Comments,
            ModalSharePost,
            DocumentPreview,
            ModalSureDelete,
        },
        data(){
            return {
                edit: false,
                auth: Auth.state,
                menuPlaylist: false,
                view_comment: this.post.comments.length > 2 ? false : true,
                audio: '',
                view_post: true,
                url : ``,
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
                follow_type: 'follow',
                follow:{
                    type: ''
                },
                link: '',
                view: 0,
                duration: '',
                current_time: '',
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
                }

            }
        },
        mounted(){
            Auth.initialize()
            this.getLike()
            this.getVote()
            this.getFollow()
            if(this.post.resource_type == 'audio'){
                this.player.on('finish', () => {
                    $(`#play`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)
                    this.$refs.surf.waveSurfer.stop()
                })
            }
        },
        computed: {
            player() {
                return this.$refs.surf.waveSurfer
            }
        },
        methods:{
            onScroll(){
                this.view += 1
                // console.log(this.view)
            },
            showModalSure(){
                $('#ModalSureDelete').modal('show')
            },
            showModalSupport(){
                $('#modalSupport').modal('show')
            },
            showModalReward(){
                $('#modalReward').modal('show')
            },
            showModalRegister(){
                $('#ModalRegister').modal('show')
            },
            showModalNewPlaylist(){
                $('#ModalPlaylist').modal('show')
            },
            showModalSharePost(){
                $('#ModalShare').modal('show')
            },
            // showModalPost(){
                //     $('#ModalPost').modal('show')
            // }
            getGrad(){
                var linGrad = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 850, 0);
                linGrad.addColorStop(0, '#ff0000');
                linGrad.addColorStop(1, 'white');
                return linGrad
            },
            playAudio(){
                this.audio = this.$refs.surf.waveSurfer
                this.duration = this.audio.getDuration()
                this.current_time = this.audio.getCurrentTime()

                while (this.duration == this.current_time) {
                    this.audio.play()
                    return
                }

                if(this.audio.isPlaying()){
                    $(`#play`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

                }else if(!this.audio.isPlaying()){
                    $(`#play`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Pause-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)

                }
                this.audio.playPause()
            },
            backward(){
                this.audio.skipBackward(10)
            },
            forward(){
                this.audio.skipForward(10)
            },
            copyLink(){
                this.link = `/${this.post.user.username}/Post/get/${this.post.token}`
                var range = document.createRange();
                range.selectNode(document.getElementById('link'));
                window.getSelection().addRange(range);
                document.execCommand("copy");

                this.$toasted.show('The copy link been successfully!', {
                    position: "bottom-right",
                    duration : 4000,
                    className: "p-4 notification bg-primary",
                    keepOnHover: true
                })
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
            getFollow(){
                if (Auth.state.username){
                    if (this.post.user.followers) {
                        this.post.user.followers.map(follow =>{
                            if (Auth.state.username == follow.user.username) {
                                $(`#follow`+this.post.token+' button').replaceWith('<button type="button" class="bg-primary align-items-right border-white active">FOLLOW<img src="/images/icons/star.svg" class="c-fifth ml-2 "></button>')
                                this.follow_type = 'unfollow'
                            }
                        })
                    }
                }
            },
            colorFollow(type){
                if (Auth.state.username) {
                    if (type == 'follow') {
                        $(`#follow`+this.post.token+' button').replaceWith('<button type="button" class="bg-primary align-items-right border-white active">FOLLOW<img src="/images/icons/star.svg" class="c-fifth ml-2 "></button>')
                        console.log(type)
                        this.store(type)
                    }
                    if(type == 'unfollow'){
                        $(`#follow`+this.post.token+' button').replaceWith('<button type="button" class="bg-primary align-items-right border-white">FOLLOW<img src="/images/icons/star.svg" class="c-fifth ml-2 "></button>')
                        console.log(type)
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
                    if (this.post.likes) {
                        this.post.likes.map(value => {
                            if (Auth.state.username == value.user.username) {
                                this.url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                            }
                        })
                    }
                }
                if (type == 'like') {
                    request = this.lit
                    this.url =  `/${Auth.state.username}/LitLike/like/Post/${this.post.id}`
                }
                if (type == 'vote_up') {
                    request = this.vote
                    this.url =  `/${Auth.state.username}/VotePost/VoteUp/${this.post.id}`
                    if (this.votes.vote_down) {
                        this.votes.vote_down.map(vote => {
                            this.url =  `/${Auth.state.username}/VotePost/VoteUp/${this.post.id}/${vote.id}`
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
                    this.url =  `/${Auth.state.username}/VotePost/VoteDown/${this.post.id}`
                    if (this.votes.vote_up){
                        this.votes.vote_up.map(vote =>{
                            if (Auth.state.username == vote.user.username) {
                                this.url = `/${Auth.state.username}/VotePost/VoteDown/${this.post.id}/${vote.id}`
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
                if (type == 'follow') {
                    if (Auth.state.username) {
                        this.follow.type = 'Followed'
                    }else{
                        this.follow.type = 'Follower'
                    }
                    request = this.follow
                    this.url = `/${Auth.state.username}/Follow/follow/${this.post.user.id}`
                }
                if (type == 'unfollow') {
                    request = this.follow
                    if (this.post.user.followers) {
                        this.post.user.followers.map(follow =>{
                            if (Auth.state.username == follow.user.username) {
                                this.url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                            }
                        })
                    }
                }
                axios.post(this.url, request).then(res =>{
                    if (res.data.like) {
                        this.lit.like = 'unlike'
                        this.post.likes.push(res.data.like)
                    }
                    if (res.data.unlike) {
                        this.lit.like = 'like'
                        let indice = this.post.likes.indexOf(res.data.like)
                        this.post.likes.splice(indice, 1)
                    }
                    if (res.data.voteUp) {
                        this.votes.vote_up.push(res.data.voteUp)
                        let indice = this.post.votes.indexOf(res.data.voteUp)
                        this.votes.vote_down.splice(indice, 1)
                        this.vote.type_vote = 'unvote_up'
                    }
                    if (res.data.unvoteUp) {
                        let indice = this.post.votes.indexOf(res.data.unvoteUp)
                        this.votes.vote_up.splice(indice, 1)
                        this.vote.type_vote = 'vote_up'
                    }
                    if (res.data.voteDown) {
                        this.votes.vote_down.push(res.data.voteDown)
                        let indice = this.post.votes.indexOf(res.data.voteDown)
                        this.votes.vote_up.splice(indice, 1)
                        this.vote.type_vote = 'unvote_down'
                    }
                    if (res.data.unvoteDown) {
                        let indice = this.post.votes.indexOf(res.data.unvoteDown)
                        this.votes.vote_down.splice(indice, 1)
                        this.vote.type_vote = 'vote_up'
                    }
                    if (res.data.follow) {
                        this.post.followers.push(res.data.follow)
                        this.follow_type = 'unfollow'
                    }
                    if (res.data.unfollow) {
                        this.follow_type = 'follow'
                    }
                }).catch(err =>{
                    console.log(err)
                })
            },
            update(){
                axios.post(`/${Auth.state.username}/Post/update/${this.post.token}`, this.post).then(res =>{
                    if (res.data.updated) {
                        this.edit = false
                        this.$toasted.show('The post has been updated successfully!', {
                            position: "bottom-right",
                            duration : 4000,
                            className: "p-4 notification bg-primary",
                            keepOnHover: true
                        })
                    }
                }).catch(err => {
                    console.log(err)
                })
            },
            deletePost(){
                axios.delete(`/${Auth.state.username}/Post/delete/${this.post.token}`).then(res =>{
                    if (res.data.deleted) {
                        var indice = this.$parent.$parent.posts.indexOf(this.post)
                        this.$parent.$parent.posts.splice(indice, 1)
                        // window.location.reload()
                        console.log(this.$parent.$parent.posts)
                    }
                }).catch(err => {
                    console.log(err)
                })
            }
        }
    }
</script>
