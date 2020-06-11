<template>
    <section class="post mt-3" v-if="view_post">
        <div class="post-head bg-primary p-3 d-md-flex align-items-start justify-content-between">
            <div class="d-flex justify-content-between align-items-center post-user-actions order-md-2">
                <button class="bg-primary align-items-right border-white">FOLLOW
                    <img src="/images/icons/star.svg" class="c-fifth ml-2">
                </button>
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
                <div class="dropdown-menu bg-primary text-white dowpdown-menu-post p-2" aria-labelledby="dropdownMenuPost">
                    <a :href="`/${post.user.username}/Profile/WorkHistory`" class="dropdown-item">Go To User Profile</a>
                    <a href="#" class="dropdown-item">Message User</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Go To Post</a>
                    <a href="#" class="dropdown-item">Copy Link</a>
                    <a @click="view_post = false" class="dropdown-item">Hide Post</a>
                    <a href="#" class="dropdown-item">Report</a>
                    <a href="#" class="dropdown-item">Add To Playlist</a>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <img :src="`${post.user.avatar}`" alt="" class="post-user-image rounded-pill">
                <div class="d-flex flex-column pl-md-3">

                    <a :href="`/${post.user.username}/Profile/WorkHistory`" class="text-white post-user-name">{{ post.user.profile_information && post.user.profile_information.artistic_name != null ? post.user.profile_information.artistic_name : post.user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="" class="check-icon" ></a>

                    <div class="d-flex align-items-center post-user-type mt-2">
                        <button class="btn bg-fifth text-white mr-2">{{ post.user.profile_information ? post.user.profile_information.title : 'N/A' }}</button>
                        <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="btn bg-white c-fifth d-flex align-items-center justify-content-center">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-body bg-primary">
            <div class="text p-3 item">
                {{ post.description }}
            </div>
            <div class="d-flex flex-column mt-1 content img-fluid" v-if="post.resource">
                <img :src="`${post.resource}`"  alt="img-post" class="img-fluid cursor-point">
            </div>
            <div class="d-flex flex-row justify-content-between align-items-center pt-2 post-user-actions d-block d-xl-none d-md-none">
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
            <div class="mt-2 bg-primary post-footer p-3">
                <div>
                    <span class="c-fourth">11k views</span>
                    <span class="ml-1 c-fourth">{{ post.time_ago }}</span>
                </div>
                <div class="d-flex c-fourth my-3">
                    <div :id="`voteUp`+this.post.id" class="information" @click="colorVote(vote_type == '' || vote_type == 'vote_down' || vote_type == 'unvote_down' ? vote_type = 'vote_up' : vote_type = 'unvote_up')"><img src="/images/icons/post-percentage-up.svg" alt=""><span>{{ votes.vote_up.length  }}</span></div>

                    <div :id="`voteDown`+this.post.id" class="information" @click="colorVote(vote_type == '' || vote_type == 'vote_up' || vote_type == 'unvote_up' ? vote_type = 'vote_down' : vote_type = 'unvote_down')"><img src="/images/icons/post-percentage-down-grey.svg" alt=""><span>{{ votes.vote_down.length }}</span></div>
                    <div :id="`lit`+this.post.id" class="information" @click="colorFlame(lit.like)" >
                        <img src="/images/icons/post-flame.svg" height="22"><span>{{ post.likes ? post.likes.length : 0 }}</span>
                    </div>
                    <div class="information"><img src="/images/icons/post-comment.svg" alt="">{{ post.comments.length }}</div>
                    <div class="information"><img src="/images/icons/post-up.svg" alt="">100</div>

                    <div class="information" v-if="post.allow_download"><img src="/images/icons/post-down.svg" alt="">100</div>
                </div>
            </div>
            <comments :post="post" />
        </div>
    </section>
</template>

<script>
    import Comments from './comments/Comments'
    import ModalLogin from '../auth/Login'
    import Auth from '../../helpers/Auth'
    export default {
        props:['post'],
        components:{
            Comments,
            ModalLogin
        },
        data(){
            return {
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
                }
            }
        },
        mounted(){
            Auth.initialize()
            this.getLike()
            this.getVote()
        },
        methods:{
            showModalSupport(){
                $('#modalSupport').modal('show')
            },
            showModalReward(){
                $('#modalReward').modal('show')
            },
            showModalRegister(){
                $('#ModalRegister').modal('show')
            },
            // showModalPost(){
            //     $('#ModalPost').modal('show')
            // }
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
                                this.vote.type_vote = 'unvote_up'

                            } else if(vote.type_vote == 'vote_down'){
                                this.votes.vote_down.push(vote)
                                $(`#voteDown`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-down-red.svg" height="22">')
                                $(`#voteUp`+this.post.id+` img`).replaceWith('<img src="/images/icons/post-percentage-up.svg" height="22">')
                                this.vote.type_vote = 'unvote_down'
                            }
                        })
                    }
                }else{
                    $('#ModalLogin').modal('show')
                }
            },
            colorVote(type){
                console.log(type)
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
                    if (this.vote.vote_down) {
                        this.vote.vote_down.map(vote => {
                            console.log(vote)
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
                    if (this.votes.vote_down){
                        this.votes.vote_down.map(vote =>{
                            if (Auth.state.username == vote.posts.username) {
                                this.url =  `/${Auth.state.username}/VotePost/VoteDown/${this.post.id}/${vote.id}`
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
                    if (res.data.saved) {
                        this.lit.like = 'unlike'
                        this.post.likes.unshift(res.data.like)
                    }
                    if (res.data.unlike) {
                        this.lit.like = 'like'
                        let indice = this.post.likes.indexOf(res.data.like)
                        this.post.likes.splice(indice, 1)
                    }
                    if (res.data.voteUp) {
                        this.votes.vote_up.unshift(res.data.voteUp)
                        let indice = this.post.votes.indexOf(res.data.voteUp)
                        this.votes.vote_down.splice(indice, 1)
                        this.vote.type_vote = 'unvote_up'
                    }
                    if (res.data.unvoteUp) {
                        let indice = this.post.votes.indexOf(res.data.unvoteUp)
                        this.votes.vote_up.splice(indice, 1)
                        this.vote.type_vote = 'unvote_up'
                    }
                    if (res.data.voteDown) {
                        this.votes.vote_down.unshift(res.data.voteDown)
                        let indice = this.post.votes.indexOf(res.data.voteDown)
                        this.votes.vote_up.splice(indice, 1)
                        this.vote.type_vote = 'unvote_down'
                    }
                    if (res.data.unvoteDown) {
                        let indice = this.post.votes.indexOf(res.data.unvoteDown)
                        this.votes.vote_down.splice(indice, 1)
                        this.vote.type_vote = 'unvote_up'
                    }
                    
                }).catch(err =>{
                    console.log(err)
                })
            }

        }
    }
</script>
