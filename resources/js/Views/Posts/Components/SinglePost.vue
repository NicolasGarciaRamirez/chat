<template >
    <section class="post" v-if="view_post" @click="storeView">
        <div class="post-head bg-primary p-3">
            <div class="d-flex justify-content-between align-items-center post-user-actions order-xl-2 order-md-2 order-sm-1">
                <div :id="`follow`+post.token" @click="disable_follow ? '' :storeFollow(follow_type)" v-if="post.user.username !== auth.username">
                    <button type="button" class="bg-primary align-items-right border-white follow-idle">
                        {{ follow_type === 'unfollow' ? 'FOLLOWING' : 'FOLLOW' }}
                        <svg version="1.2" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" viewBox="0 0 1179 1080" xml:space="preserve" width="1rem" class="ml-2">
                            <g id="Layer_2">
                                <g id="Layer_2-2">
                                    <path fill="#141414" d="M1179,407.04l-402.88-55.63L587.74,0L404.99,352.76L0,414.5L292.81,690.6L228.6,1080l363.37-182.49
                                        l365.48,179.1L886.9,687.89L1179,407.04z"  stroke="white" stroke-width="2em"/>
                                </g>
                            </g>
                        </svg>
                    </button>
                </div>
                <button v-if="post.user.subscription_type === 'CONTRIBUTOR' && post.user.username !== auth.username" class="bg-primary border-danger d-sm-down-none "  @click="showModalSupport">SUPPORT
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="1rem" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-2">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M775.617,0.807c-91.897,0-177.902,44.438-234.538,118.658C484.384,45.246,398.382,0.807,306.482,0.807
                        C140.316,0.807,5.113,143.518,5.113,319.004c0,137.825,77.957,297.373,231.784,474.343
                        c118.566,136.343,247.543,241.941,284.236,271.054l19.945,15.792l19.889-15.792c36.693-29.112,165.67-134.653,284.237-271.054
                        c153.823-176.912,231.84-336.519,231.84-474.343C1077.045,143.518,941.842,0.807,775.617,0.807"/>
                    </svg>
                </button>
                <button v-if="post.user.subscription_type === 'CONTRIBUTOR' && post.user.username !== auth.username" class="bg-primary border-danger d-sm-down-none " @click="showModalReward">REWARD
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="1rem" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-2">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M1078.159,1.365h-508.24L3.615,515.729h353.029l-204.69,563.042l895.973-777.405H758.889L1078.159,1.365z
                        M569.919,454.482c-0.171-0.055-0.256-0.055-0.344-0.055c-0.171,0-0.256-0.055-0.427-0.055c1.544-1.828,3.175-3.627,4.55-5.564
                        C572.497,450.745,571.209,452.544,569.919,454.482 M725.56,192.275c-6.612,0.167-12.882-0.442-18.895-1.855
                        C712.678,191.25,719.032,191.833,725.56,192.275"/>
                    </svg>
                </button>
                <i class="fas fa-ellipsis-h c-third fa-2x mfs-auto"  id="dropdownMenuPost"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu bg-primary text-white p-2" aria-labelledby="dropdownMenuPost">
                    <div v-if="!menuPlaylist">
                        <a :href="`/${post.user.username}/Profile`" target="_blank" class="dropdown-item" v-if="post.user.username !== auth.username">Go To User Profile</a>
                        <!-- <a href="#" class="dropdown-item">Message User</a> -->
                        <div class="dropdown-divider" v-if="post.user.username !== auth.username"></div>
                        <div class="dropdown-item cursor-pointer" @click="edit = true" v-if="auth.username === post.user.username">Edit description</div>
                        <div class="dropdown-item cursor-pointer" @click="deletePost" v-if="auth.username === post.user.username">Delete Post</div>
                        <a :href="`/Post/${post.token}`" target="_blank" class="dropdown-item">Go To Post</a>
                        <a href="#" class="dropdown-item link-post" @click="copyLink">Copy Link</a>
                        <!--<div class="dropdown-item cursor-pointer" >Hide Post</div>-->
                        <a href="mailto:support@noisesahrks.com" class="dropdown-item" v-if="auth.username !== post.user.username">Report</a>
                        <!-- <div class="dropdown-item" @click="menuPlaylist = true" v-if="post.resource_type == 'audio' || post.resource_type == 'video'">Add To Playlist</div> -->
                    </div>
<!--                    <div v-if="menuPlaylist">-->
<!--                        <div class="dropdown-item" @click="showModalNewPlaylist"> <i class="fas fa-plus-circle mr-2"></i> new playlist</div>-->
<!--                        <div class="dropdown-divider"></div>-->
                        <!-- <a href="" class="dropdown-item" v-for="(playlist, index) in playlist" :key="index">{{ playlist.name }}</a> -->
<!--                    </div>-->
                </div>
            </div>
            <div class="d-flex align-items-start order-xl-1 order-md-1 order-sm-2">
                <img :src="`${post.user.avatar}`" alt="" class="post-user-image rounded-circle">
                <div class="d-flex flex-column content-head">
                    <a :href="`/${post.user.username}/Profile`" class="text-white post-user-name">{{ post.user.profile_information && post.user.profile_information.artistic_name != null ? post.user.profile_information.artistic_name : post.user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="" class="check-icon" v-if="post.user.verification_date"></a>
                    <div class="d-flex align-items-center post-user-type mt-2">
                        <button class="btn bg-fifth text-white mr-2">{{ post.user.profile_information ? post.user.profile_information.title : 'Profile Title Not Chosen' }}</button>
                        <button class="btn bg-white c-fifth d-flex align-items-center justify-content-center" v-if="post.user.subscription_type === 'CONTRIBUTOR'">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text p-3 item bg-primary" id="description" v-if="!post.replace_caption && post.description">
            <span v-if="!edit && !post.replace_caption && post.resource_type !== 'docs'">
                <span v-if="showMore">{{description}}</span>
                <span v-if="!showMore">{{descriptionLess}}</span>
                <span class="c-fourth cursor-pointer mx-1" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description.length > 500">{{!showMore ? 'See More...' : 'See Less'}}</span>
            </span>
            <span v-if="post.resource_type === 'docs'">
                <span v-if="showMore">{{description}}</span>
                <span v-if="!showMore">{{descriptionLess}}</span>
                <span class="c-fourth cursor-pointer mx-1" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description.length > 500">{{!showMore ? 'See More...' : 'See Less'}}</span>
            </span>
            <span v-if="post.resource_type === 'docs' && resource_extension !== 'pdf'">
                <span v-if="showMore">{{description}}</span>
                <span v-if="!showMore">{{descriptionLess}}</span>
                <span class="c-fourth cursor-pointer mx-4" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description.length > 500">{{!showMore ? 'See More...' : 'See Less'}}</span>
            </span>
            <form @submit.prevent="update"  v-if="edit && !post.replace_caption ">
                <textarea
                    class="form-control bg-primary"
                    rows="5"
                    placeholder="Add Some value to the music industry..."
                    v-model="post.description"
                    >
                </textarea>
                <div class="btn text-white bg-primary rounded-pill float-right mx-3" @click="edit = false">Cancel Edit</div>
                <button type="submit" class="btn text-white bg-fifth rounded-pill float-right">Save Edit</button>
            </form>
        </div>
        <div class="post-body bg-primary" v-if="post.resource">
            <div>
                <div class="d-flex flex-column content img-fluid p-3" v-if="post.resource">
                    <img :src="`${post.resource}`"  alt="img-post" class="img-fluid cursor-point" v-if="post.resource_type === 'image'" />
                    <video :src="`${post.resource}`" controls  v-if="post.resource_type === 'video'" />
                    <vue-wave-surfer :id="'waveform'+post.token" :src="`${post.resource}`" :options="options_audio" v-if="post.resource_type === 'audio'" ref="surf"></vue-wave-surfer>
                    <div class="d-flex flex-row text-center justify-content-center" v-if="post.resource_type === 'audio'">
                        <img src="/images/iconsplayer/Backward10sec-grey.svg" alt="" class="cursor-pointer" :id="`backward`+post.token" @click="backward(audio)" height="30" >
                        <div :id="`play`+post.token"  @click="playAudio()" >
                            <img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">
                        </div>
                        <img src="/images/iconsplayer/Forward10sec-grey.svg" alt="" class="cursor-pointer" @click="forward(audio)" height="30">
                    </div>
                    <a :href="`${post.resource}`" target="_blank"  class="text-white no-underline p-3" v-if="post.resource_type === 'docs' && resource_extension === 'pdf'">
                        <img :src="`${resource_extension === 'docx' ? '/images/documments/word-document.svg' : '' || resource_extension === 'pdf' ? '/images/documments/pdf-document.svg' : '' || resource_extension === 'xlsx' ? '/images/documments/excel-document.svg' : '' || resource_extension === 'pptx' ? '/images/documments/power-point-document.svg' : ''}`"   style="min-height: 13rem; max-height: 13rem;">
                    </a>
                    <div v-if="post.resource_type === 'docs' && resource_extension !== 'pdf'">
                        <img :src="`${resource_extension === 'docx' ? '/images/documments/word-document.svg' : '' || resource_extension === 'pdf' ? '/images/documments/pdf-document.svg' : '' || resource_extension === 'xlsx' ? '/images/documments/excel-document.svg' : '' || resource_extension === 'pptx' ? '/images/documments/power-point-document.svg' : ''}`"   style="min-height: 13rem; max-height: 13rem;">
                    </div>
                    <div class="my-3" v-if="post.replace_caption">
                        <a :href="`${post.resource}`" class="text-white no-underline p-3" v-if="post.resource_type === 'docs' && resource_extension === 'pdf'">
                            <h4>{{ post.replace_caption }}</h4>
                        </a>
                        <h4 class="font-weight-bold" v-if="resource_extension !== 'pdf'">{{ post.replace_caption }}</h4>
                        <span class="mb-3" v-if="!edit">
                            <span v-if="showMore">{{description}}</span>
                            <span v-if="!showMore">{{descriptionLess}}</span>
                            <span class="c-fourth cursor-pointer mx-1" @click="!showMore ? showMore = true : showMore = false" v-if="description != null && description != '' && description.length > 500">{{!showMore ? 'See More...' : 'See Less'}}</span>
                        </span>
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
            <div class="d-flex flex-row justify-content-between align-items-center post-user-actions pb-3 d-block d-xl-none d-md-none">
                 <button class="bg-primary border-danger mx-3" v-if="post.user.subscription_type == 'CONTRIBUTOR' && post.user.username !== auth.username"  @click="showModalSupport">SUPPORT
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="1rem" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-3">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M775.617,0.807c-91.897,0-177.902,44.438-234.538,118.658C484.384,45.246,398.382,0.807,306.482,0.807
                        C140.316,0.807,5.113,143.518,5.113,319.004c0,137.825,77.957,297.373,231.784,474.343
                        c118.566,136.343,247.543,241.941,284.236,271.054l19.945,15.792l19.889-15.792c36.693-29.112,165.67-134.653,284.237-271.054
                        c153.823-176.912,231.84-336.519,231.84-474.343C1077.045,143.518,941.842,0.807,775.617,0.807"/>
                     </svg>
                </button>
                <button class="bg-primary border-danger mx-3" v-if="post.user.subscription_type == 'CONTRIBUTOR' && post.user.username !== auth.username"  @click="showModalReward">REWARD
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="1rem" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-3">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M1078.159,1.365h-508.24L3.615,515.729h353.029l-204.69,563.042l895.973-777.405H758.889L1078.159,1.365z
                        M569.919,454.482c-0.171-0.055-0.256-0.055-0.344-0.055c-0.171,0-0.256-0.055-0.427-0.055c1.544-1.828,3.175-3.627,4.55-5.564
                        C572.497,450.745,571.209,452.544,569.919,454.482 M725.56,192.275c-6.612,0.167-12.882-0.442-18.895-1.855
                        C712.678,191.25,719.032,191.833,725.56,192.275"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="px-3 py-1 bg-primary post-data">
            <span class="c-fourth">{{post.views.length}} {{ post.resource_type == 'audio' || post.resource_type == 'video' ? 'Plays' : 'Views' }}</span>
            <span class="c-fourth mx-3">{{ post.time_ago }}</span>
        </div>
        <div class="post-footer bg-primary px-3 py-2">
            <div class="post-reactions c-fourth ">
                <div :id="`voteUp`+this.post.id" class="information cursor-pointer" @click="disable_vote_up ? '' : storeVoteUp(vote_type_up)"><img src="/images/icons/post-percentage-up.svg" alt=""><span>{{ votes.vote_up.length  }}</span></div>

                <div :id="`voteDown`+this.post.id" class="information cursor-pointer" @click="disable_vote_down ? '' : storeVoteDown(vote_type_down)"><img src="/images/icons/post-percentage-down-grey.svg" alt=""><span>{{ votes.vote_down.length }}</span></div>

                <div :id="`lit`+this.post.id" class="information cursor-pointer" @click="disable_like ? '': storeLike(lit.like)">
                    <img src="/images/icons/post-flame.svg" height="22"><span>{{ post.likes ? post.likes.length : 0 }}</span>
                </div>
                <div class="information cursor-pointer" @click="$parent.view_comment = !$parent.view_comment"><img src="/images/icons/post-comment.svg" alt="">{{ post.comments.length }}</div>
                <div class="information cursor-pointer" @click="showModalSharePost"><img src="/images/icons/post-share.svg" alt="">{{post.shares.length}}</div>
                <div class="information cursor-pointer" v-if="post.allow_download"><a :href="`${post.resource}`"><img src="/images/icons/post-down.svg" alt=""></a></div>
            </div>
        </div>
        <comments :post="post" :view_comment="view_comment"/>
        <input type="text" :value="`https://www.noisesharks.com/${post.user.username}/Post/get/${post.token}`" :id="'myInput'+`${post.token}`" class="text-black-50 bg-black border-0" >
    </section>
</template>

<script>
    import Comments from '../../Comments/Views/Comments'
    import DocumentPreview from 'vue-doc-preview'
    import Auth from "../../../helpers/Auth";
    import Followers from "../../../helpers/Followers";
    export default {
        props:['post','user'],
        components:{
            Comments,
            DocumentPreview,
        },
        data(){
            return {
                disable_like: false,
                disable_vote_up: false,
                disable_vote_down: false,
                disable_follow: false,
                showMore:false,
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
                vote_type_up: 'vote_up',
                vote_type_down: 'vote_down',
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
                },
            }
        },
        mounted(){
            Auth.initialize()
            this.getLike()
            this.getVote()
            this.getFollow()
            if(this.post.resource_type === 'audio'){
                this.player.on('finish', () => {
                    $(`#play`+this.post.token+` img`).replaceWith(`<img src="/images/iconsplayer/Play-white.svg" alt="" class="cursor-pointer mx-3" height="33">`)
                    this.$refs.surf.waveSurfer.stop()
                })
            }

            $("video").on("play", function() {
                $("video").not(this).each(function(index, video) {
                    video.pause();
                });
            });
        },
        computed: {
            player() {
                return this.$refs.surf.waveSurfer
            },
            resource_extension() {
                if (this.post.resource_type === 'docs'){
                    let extension = this.post.resource.split(".")
                    return _.last(extension)
                }else{
                    return 'not-document'
                }
            },
            descriptionLess(){
                if(this.post.description !== null && this.post.description !== ''){
                    let text = this.post.description
                    let a = text.substr(0,500)
                    return a
                }
                return null
            },
            description(){
                return this.post.description
            }
        },
        methods:{
            // methods show
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

                this.$parent.post = this.post
                $('#ModalShare').modal('show')
            },
            // showModalPost(){
                //     $('#ModalPost').modal('show')
            // }
            //send methods show
            //methods player
            getGrad(){
                let linGrad = document.createElement('canvas').getContext('2d').createLinearGradient(0, 0, 850, 0);
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
                    this.storeView()
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
            //methods player
            copyLink(){
                var copyText = document.getElementById("myInput"+this.post.token);
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");

                this.$toasted.show('The copy link been successfully!', {
                    position: "bottom-right",
                    duration : 4000,
                    className: "p-4 notification bg-primary",
                    keepOnHover: true
                })
            },
            // methods reactions
            storeView(){
                axios.post(`/${this.auth.username}/View/store/${this.post.id}`).then(res=>{
                    // console.log(res)
                }).catch(err =>{
                    console.log(err)
                })
            },

            getLike(){
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
            storeLike(type){
                if (Auth.state.token) {
                    let request =''
                    this.disable_like = true
                    this.disable_vote_down = true
                    this.disable_vote_up = true
                    if (type == 'unlike') {
                        request = this.lit
                        if (this.post.likes) {
                            this.post.likes.map(value => {
                                if (Auth.state.username === value.user.username) {
                                    this.url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                                }
                            })
                        }
                    }
                    if (type == 'like') {
                        request = this.lit
                        this.url =  `/${Auth.state.username}/LitLike/like/Post/${this.post.id}`
                    }
                    axios.post(this.url, request).then(res =>{
                        if (res.data.like) {
                            this.disable_like = false
                            this.disable_vote_down = false
                            this.disable_vote_up = false
                            this.lit.like = 'unlike'
                            this.post.likes.push(res.data.like)
                            $(`#lit`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="22">')
                        }
                        if (res.data.unlike) {
                            this.disable_like = false
                            this.disable_vote_down = false
                            this.disable_vote_up = false
                            this.lit.like = 'like'
                            let indice = this.post.likes.indexOf(res.data.like)
                            this.post.likes.splice(indice, 1)
                            $(`#lit`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-flame.svg" height="22">')
                        }
                    })
                }else{
                    $('#ModalLogin').modal('show')
                }
            },

            getVote(){
                if (Auth.state.token) {
                    if (this.post.votes) {
                        this.post.votes.map(vote => {
                            if (vote.type_vote === 'vote_up') {
                                this.votes.vote_up.push(vote)
                                $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                                $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                            }
                            if(vote.type_vote === 'vote_down'){
                                this.votes.vote_down.push(vote)
                                $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                                $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
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
                }
            },
            storeVoteUp(type){
                if (Auth.state.token) {
                    let request = ''
                    this.disable_vote_up = true
                    this.disable_vote_down = true
                    this.disable_like = true
                    if (type == 'vote_up') {
                        this.vote.type_vote = 'vote_up'
                        request = this.vote
                        this.url =  `/${Auth.state.username}/VotePost/VoteUp/${this.post.id}`
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
                        let indice = this.post.votes.indexOf(res.data.voteUp)
                        this.votes.vote_down.splice(indice, 1)
                        this.vote.type_vote = 'unvote_up'
                        this.vote_type_up = 'unvote_up'

                        $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up-red.svg" height="22">')
                        $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                    }
                    if (res.data.unvoteUp) {
                        this.disable_vote_up = false
                        this.disable_vote_down = false
                        this.disable_like = false
                        let indice = this.post.votes.indexOf(res.data.unvoteUp)
                        this.votes.vote_up.splice(indice, 1)
                        this.vote.type_vote = 'vote_up'
                        this.vote_type_up = 'vote_up'

                        $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                        $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
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
                        this.url =  `/${Auth.state.username}/VotePost/VoteDown/${this.post.id}`
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
                            let indice = this.post.votes.indexOf(res.data.voteDown)
                            this.votes.vote_up.splice(indice, 1)
                            this.vote.type_vote = 'unvote_down'
                            this.vote_type_down = 'unvote_down'
                            $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                            $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                        }
                        if (res.data.unvoteDown) {
                            this.disable_vote_down = false
                            this.disable_vote_up = false
                            this.disable_like = false
                            let indice = this.post.votes.indexOf(res.data.unvoteDown)
                            this.votes.vote_down.splice(indice, 1)
                            this.vote.type_vote = 'vote_up'
                            this.vote_type_down = 'vote_down'
                            $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-grey.svg" height="22">')
                            $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                        }
                    })
                }else{
                    $('#ModalLogin').modal('show')
                }
            },

            getFollow(){
                if (Auth.state.username){
                    if (this.post.user.followers) {
                        this.post.user.followers.map(follow =>{
                            if (Auth.state.username === follow.user.username) {
                                $(`#follow`+this.post.token+' button').addClass('follow-active').removeClass('follow-idle')
                                this.follow_type = 'unfollow'
                            }
                        })
                    }
                }
            },
            storeFollow(type){
                if (Auth.state.username) {
                    this.disable_follow = true
                    let request =''
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
                        if (res.data.follow) {
                            this.disable_follow = false
                            this.post.user.followers.push(res.data.follow)
                            this.follow_type = 'unfollow'
                            Followers.set(res.data.following)
                            $(`#follow`+this.post.token+' button').addClass('follow-active').removeClass('follow-idle')
                            window.location.reload()
                        }
                        if (res.data.unfollow) {
                            this.disable_follow = false
                            this.follow_type = 'follow'
                            Followers.set(res.data.following)
                            $(`#follow`+this.post.token+' button').addClass('follow-idle').removeClass('follow-active')
                            window.location.reload()
                        }
                    }).catch(err =>{
                        console.log(err)
                    })
                }else{
                    $('#ModalLogin').modal('show')
                }
            },

            // end methods reactions
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
                swal({
                    title: 'Delete Post',
                    text: 'You are about to delete this post. Would you like to proceed?',
                    className: 'swal-alert',
                    buttons: ['Cancel','Delete'],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete){
                        const self = this
                        axios.delete(`/${Auth.state.username}/Post/delete/${self.post.id}`).then(res =>{
                            if (res.data.deleted) {
                                this.$toasted.show('post deleted successfully!', {
                                    position: "bottom-right",
                                    duration : 4000,
                                    className: "p-4 notification bg-primary",
                                    keepOnHover: true
                                })
                                let index = _.findIndex(this.$parent.posts, function(o) { return o.id === self.post.id; });
                                this.$parent.posts.splice(index, 1)
                            }
                        }).catch(err => {
                            console.log(err)
                        })
                    }
                })
            }
        }
    }
</script>
