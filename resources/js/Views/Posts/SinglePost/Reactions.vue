<template>
    <section>
        <div class="d-md-down-none d-md-flex flex-wrap " ref="reactions" v-if="!reaction_movile">
            <div class="mr-2" :id="`follow`+post.token" @click="disable_follow ? '' : storeFollow(follow_type)" v-if="post.user.username !== auth.username && !only_reactions_contributor">
                <button type="button" class="btn btn-sm content-icon btn-outline-light rounded-pill follow-idle">
                    {{ follow_type === 'unfollow' ? 'Following' : 'Follow' }}
                    <svg class="icon-sm" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path  d="M23,9.4C22.9,9.2,22.7,9,22.5,9l-6.8-1.1l-3.1-6.5C12.5,1.2,12.3,1,12,1c-0.2,0-0.5,0.1-0.6,0.4l-3,6.4 L1.6,8.9C1.3,9,1.1,9.1,1,9.4c0,0.2,0,0.5,0.2,0.6l4.9,5.1L5,22.3c0,0.2,0.1,0.5,0.3,0.6C5.4,23,5.5,23,5.7,23 c0.1,0,0.2,0,0.3-0.1l6.1-3.4l6.1,3.4c0.2,0.1,0.5,0.1,0.7,0c0.2-0.1,0.3-0.4,0.3-0.6L18,15.1l4.9-5.1C23,9.9,23,9.6,23,9.4z"/> </svg>
                </button>
            </div>
            <div class="mr-2" :id="'reward'+post.token" @click="disable_reward ? '' : storeReward()" v-if="post.user.subscription_type === 'CONTRIBUTOR' && post.user.username !== auth.username">
                <button type="button" :class="`btn btn-sm btn-outline-red rounded-pill content-icon ${ !only_reactions_contributor ? 'function-contributor-idle' : ''}`">
                    <span>Reward</span>
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M14.6,12.6V23h5.2c1.1,0,2-0.9,2-1.9v-8.4h-7.2V12.6z"/> <path d="M2.3,12.6V21c0,1.1,0.9,1.9,1.9,1.9h5.2V12.6H2.3z"/> <path d="M21.1,6.2h-2.6c0.4-0.5,0.7-1.2,0.7-1.9c0-1.8-1.4-3.2-3.2-3.2c-2.4-0.1-3,1.5-4,4C11,2.6,10.4,1,8.1,1 C6.4,1,4.9,2.4,4.9,4.2c0,0.7,0.3,1.4,0.7,1.9H2.9C1.9,6.2,1,7,1,8.1v1.3c0,1.1,0.9,1.9,1.9,1.9h6.5V6.2H8.1 C7,6.2,6.2,5.3,6.2,4.3s0.9-1.9,1.9-1.9c1.3,0,1.7,0.8,2.7,3.3C10.9,5.8,11,6,11,6.2h-0.3c0,9.6,0,7.2,0,16.8h2.6 c0-15.1,0-12.7,0-16.8H13c0-0.2,0.1-0.4,0.2-0.6c1-2.5,1.4-3.3,2.7-3.3c1.1,0,1.9,0.9,1.9,1.9s-0.9,1.9-1.9,1.9h-1.3v5.2h6.5 c1.1,0,1.9-0.9,1.9-1.9V8.1C23,7,22.1,6.2,21.1,6.2z"/> </svg>
                </button>
            </div>
            <div class="mr-2" :id="'support'+post.token" @click="disable_support ? '' : storeSupport()" v-if="post.user.subscription_type === 'CONTRIBUTOR' && post.user.username !== auth.username">
                <button type="button" :class="`rounded-pill btn btn-sm btn-outline-red content-icon function-contributor-idle ${!only_reactions_contributor ? '' : ''}`">
                    <span>{{ support_type === 'unSupport' ? 'Supporting' : 'Support' }}</span>
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M17.1,2c-1.2,0-2.3,0.4-3.3,1.1c-0.9,0.7-1.5,1.6-1.9,2.4c-0.4-0.7-1-1.6-1.9-2.4C9,2.4,7.9,2,6.7,2 C3.5,2,1,4.8,1,8.5c0,4,3.1,6.8,7.8,10.9c0.8,0.7,1.7,1.5,2.7,2.4c0.1,0.1,0.3,0.2,0.5,0.2s0.3-0.1,0.5-0.2 c0.9-0.8,1.9-1.6,2.7-2.4c4.7-4.1,7.8-6.9,7.8-10.9C22.8,4.8,20.3,2,17.1,2z"/> </svg>
                </button>
            </div>
        </div>
        <div class="d-flex flex-row" :id="`followMovile`+post.token"  v-if="reaction_movile && !only_reactions_contributor" style="z-index: 1">
            <div class="d-flex">
                <a :href="`/${post.user.username}/Channel/Activity`">{{ post.user.profile_information && post.user.profile_information.artistic_name != null ? post.user.profile_information.artistic_name : post.user.personal_information.full_name }}
                    <img src="/images/icons/check.svg" alt="" class="icon-check" style="width: 1rem;"  v-if="post.user.verification_date">
                </a>
                <div class="badge100" data-toggle="modal" data-target="#badgeMore100" style="z-index: -1;" v-if="post.user.badge_verification">
                    <svg class="icon-check badge__icon ml-2" style="transform: translateY(-2px)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path fill="#FFC34D" d="M4,11.5l1-4.8C5,6.2,5.7,6,6.1,6.5l2.8,3.8c0.4,0.6-0.1,0.7-2,3C4.5,12,3.8,12.3,4,11.5L4,11.5z"/> <path fill="#FFC34D" d="M17.1,13.2c-1.9-2.2-2.5-2.4-2-3l2.8-3.8c0.3-0.4,1-0.3,1.1,0.3l1,4.8C20.2,12.3,19.4,12.1,17.1,13.2z"/> <path fill="#FFEA80" d="M22,8.9l-4.6,3.4l-4.8-8.4c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-4.8,8.4L2,8.9 C1.5,8.5,0.9,9,1,9.6l1.8,6.9l1.2,0.7l-0.8,0.6l0.5,2.1c0.1,0.3,0.3,0.5,0.6,0.5h15.5c0.3,0,0.6-0.2,0.6-0.5l0.5-2.1l-0.5-0.6 l0.8-0.6L23,9.6C23.1,9,22.5,8.5,22,8.9L22,8.9z"/> <path fill="#FFEA80" d="M23,9.6l-1.8,6.9l-0.8,0.6l0.5,0.6l-0.5,2.1c-0.1,0.3-0.3,0.5-0.6,0.5H12V3.6c0.2,0,0.4,0.1,0.6,0.3 l4.8,8.4L22,8.9C22.5,8.5,23.1,9,23,9.6L23,9.6z"/> <path fill="#FF6A4D" d="M14.5,13.6l-1.9-3.2c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-1.9,3.2c-0.1,0.2-0.1,0.5,0,0.7 l1.9,3.2c0.1,0.2,0.3,0.3,0.6,0.3c0.2,0,0.4-0.1,0.6-0.3l1.9-3.2C14.6,14.1,14.6,13.8,14.5,13.6z"/> <path fill="#FF6A4D" d="M14.5,14.3l-1.9,3.2c-0.1,0.2-0.3,0.3-0.6,0.3v-7.7c0.2,0,0.4,0.1,0.6,0.3l1.9,3.2 C14.6,13.8,14.6,14.1,14.5,14.3z"/> <path fill="#FFC34D" d="M7.5,17.2c0,0.4-0.3,0.6-0.6,0.6H3.1l-0.3-1.3h4.1C7.2,16.5,7.5,16.8,7.5,17.2z"/> <path fill="#FFC34D" d="M21.2,16.5l-0.3,1.3h-3.7c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H21.2z"/> </svg>
                    <div class="badge100__modal shadow">
                        <p> <b>{{post.user.artistic_name}}</b> earned the 100-loyalty badge for being one of the first 100 useres on Noisesharks </p>
                    </div>
                </div>
            </div>
            <b class="d-md-none ml-1" @click="storeFollow(follow_type)" v-if="post.user.username !== auth.username" > •<span class="ml-1 follow-idle">{{ follow_type === 'unfollow' ? 'Following' : 'Follow'}}</span> </b>
        </div>
        <div class="d-lg-none d-md-none cross-center flex-row mb-2" v-if="only_reactions_contributor">
            <div class="mr-2" :id="'reward'+post.token" @click="disable_reward ? '' : storeReward()" v-if="post.user.subscription_type === 'CONTRIBUTOR' && post.user.username !== auth.username">
                <button type="button" :class="`btn btn-sm btn-outline-red rounded-pill content-icon ${ !only_reactions_contributor ? 'function-contributor-idle' : ''}`">
                    <span>Reward</span>
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M14.6,12.6V23h5.2c1.1,0,2-0.9,2-1.9v-8.4h-7.2V12.6z"/> <path d="M2.3,12.6V21c0,1.1,0.9,1.9,1.9,1.9h5.2V12.6H2.3z"/> <path d="M21.1,6.2h-2.6c0.4-0.5,0.7-1.2,0.7-1.9c0-1.8-1.4-3.2-3.2-3.2c-2.4-0.1-3,1.5-4,4C11,2.6,10.4,1,8.1,1 C6.4,1,4.9,2.4,4.9,4.2c0,0.7,0.3,1.4,0.7,1.9H2.9C1.9,6.2,1,7,1,8.1v1.3c0,1.1,0.9,1.9,1.9,1.9h6.5V6.2H8.1 C7,6.2,6.2,5.3,6.2,4.3s0.9-1.9,1.9-1.9c1.3,0,1.7,0.8,2.7,3.3C10.9,5.8,11,6,11,6.2h-0.3c0,9.6,0,7.2,0,16.8h2.6 c0-15.1,0-12.7,0-16.8H13c0-0.2,0.1-0.4,0.2-0.6c1-2.5,1.4-3.3,2.7-3.3c1.1,0,1.9,0.9,1.9,1.9s-0.9,1.9-1.9,1.9h-1.3v5.2h6.5 c1.1,0,1.9-0.9,1.9-1.9V8.1C23,7,22.1,6.2,21.1,6.2z"/> </svg>
                </button>
            </div>
            <div class="mr-2" :id="'support'+post.token" @click="disable_support ? '' : storeSupport()" v-if="post.user.subscription_type === 'CONTRIBUTOR' && post.user.username !== auth.username">
                <button type="button" :class="`rounded-pill btn btn-sm btn-outline-red content-icon function-contributor-idle ${!only_reactions_contributor ? '' : ''}`">
                    <span>{{ support_type === 'unSupport' ? 'Supporting' : 'Support' }}</span>
                    <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M17.1,2c-1.2,0-2.3,0.4-3.3,1.1c-0.9,0.7-1.5,1.6-1.9,2.4c-0.4-0.7-1-1.6-1.9-2.4C9,2.4,7.9,2,6.7,2 C3.5,2,1,4.8,1,8.5c0,4,3.1,6.8,7.8,10.9c0.8,0.7,1.7,1.5,2.7,2.4c0.1,0.1,0.3,0.2,0.5,0.2s0.3-0.1,0.5-0.2 c0.9-0.8,1.9-1.6,2.7-2.4c4.7-4.1,7.8-6.9,7.8-10.9C22.8,4.8,20.3,2,17.1,2z"/> </svg>
                </button>
            </div>
        </div>
    </section>
</template>

<style scoped>
    button{
        padding: .25rem .5rem .35rem .5rem;
    }
</style>

<script>
    import Auth from "../../../helpers/Auth";
    export default {
        name: "Reactions",
        props:['post', 'auth', 'only_reactions_contributor', 'reaction_movile'],
        data(){
            return {
                disable_like: false,
                disable_vote_up: false,
                disable_vote_down: false,
                disable_follow: false,
                disable_support: false,
                disable_reward: false,
                follow_type: 'follow',
                follow:{
                    type: ''
                },
                reward_type:'reward',
                reward:{
                    amount: 0
                },
                support_type: 'support',
                support:{
                    monthly_amount: 0,
                    tier_id: null
                },
            }
        },
        mounted(){
            Auth.initialize()
            this.getFollow()
            this.getSupport()
            this.getReward()
        },
        methods:{
            getFollow(){
                if (Auth.state.username){
                    if (this.post.user.followers) {
                        this.post.user.followers.map(follow =>{
                            if(follow.user){
                                if (Auth.state.username === follow.user.username) {
                                    $(`#follow`+this.post.token+' button').addClass('follow-active').removeClass('follow-idle')
                                    $(`#followMovile`+this.post.token+' span').addClass('follow-active').removeClass('follow-idle')
                                    this.follow_type = 'unfollow'
                                }
                            }
                        })
                    }
                }
            },
            getSupport(){
                if (Auth.state.username){
                    if (this.post.user.supports) {
                        this.post.user.supports.map(support =>{
                            if (Auth.state.username === support.user.username) {
                                $('#support'+this.post.token+' button').addClass('function-contributor-active').removeClass('function-contributor-idle')
                                this.support_type = 'unSupport'
                            }
                        })
                    }
                }
            },
            getReward(){
                if (Auth.state.username){
                    if (this.post.user.rewards) {
                        //
                    }
                }
            },
            async storeFollow(type){
                if (Auth.state.username) {
                    await Auth.setSession()
                    this.disable_follow = true
                    let request =''
                    if (type === 'follow') {
                        Auth.state.username ? this.follow.type = 'Followed' : this.follow.type = 'Follower'
                        request = this.follow
                        this.url = `/${Auth.state.username}/Follow/follow/${this.post.user.token}`
                    }
                    if (type === 'unfollow') {
                        request = this.follow
                        if (this.post.user.followers) {
                            this.post.user.followers.map(follow =>{
                                if (Auth.state.username === follow.user.username) {
                                    this.url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                                }
                            })
                        }
                    }
                    await axios.post(this.url, request).then(res =>{
                        let self = this
                        if (res.data.follow) {
                            // se pregunta si esta en el channel activity
                            if(window.location.href.match(`${window.location.origin}/${this.$parent.post.user.username}/Channel/Activity`)) {
                                console.log('si esta en el channel activity')
                                // se da el efecto de tiempo real con el head profile
                                let profile = this.$root.$refs.Profile
                                profile.follow_type = 'unfollow'
                                // se da el efecto de tiempo real en el componente post
                                profile.user.followers.push(res.data.follow)
                                $(`#follow`+profile.user.token+` button`).addClass('follow-active').removeClass('follow-idle')
                                // se da el efecto de tiempo real en todos los post del channel activity
                                _.forEach(this.$root.$refs.channelActivity.$children, function(children){
                                    console.log(children)
                                    if(children.$options._componentTag === 'post'){
                                        if(children.post.user.username === self.post.user.username){
                                            children.$children.map(react => {
                                                if (react.$options._componentTag === 'post-reactions') {
                                                    react.follow_type = 'unfollow'
                                                    react.post.user.followers.push(res.data.follow)
                                                    $(`#follow` + children.post.token + ' button').addClass('follow-active').removeClass('follow-idle')
                                                    $(`#followMovile` + children.post.token + ' span').addClass('follow-active').removeClass('follow-idle')
                                                }
                                            })
                                        }
                                    }
                                })
                            }
                            // este cambia las variables en el componente link
                            $(`#follow`+this.post.token+' button').addClass('follow-active').removeClass('follow-idle')
                            $(`#followMovile`+this.post.token+' span').addClass('follow-active').removeClass('follow-idle')
                            this.disable_follow = false
                            this.post.user.followers.push(res.data.follow)
                            this.post.privacy === 'Followers' ? this.$parent.user_auth_is_privacy = true : ''
                            this.follow_type = 'unfollow'
                            // se pone el seguidor en el nav
                            this.$root.$refs.AppNav.followings = res.data.followings
                            this.$root.$refs.modalRelathion.followings = []
                            _.each(this.$root.$refs.modalRelathion.followers , user =>{
                                if (user.username === this.post.user.username) user.followers.push(res.data.follow)
                            })
                            // se pone el efecto de real time con el resto de los post en el home
                            _.each(res.data.followings , follow =>{this.$root.$refs.modalRelathion.followings.push(follow.following)})
                            _.forEach(this.$root.$refs.home.$refs.posts.$children, function(children, key){
                                if(children.$options._componentTag === 'post'){
                                    if(children.post.user.username === self.post.user.username){
                                        children.$children.map(react => {
                                            if (react.$options._componentTag === 'post-reactions') {
                                                react.follow_type = 'unfollow'
                                                react.post.user.followers.push(res.data.follow)
                                                $(`#follow` + children.post.token + ' button').addClass('follow-active').removeClass('follow-idle')
                                                $(`#followMovile` + children.post.token + ' span').addClass('follow-active').removeClass('follow-idle')
                                            }
                                        })
                                    }
                                }
                            })

                        }
                        if (res.data.unfollow) {
                            if(window.location.href.match(`${window.location.origin}/${this.$parent.post.user.username}/Channel/Activity`)) {
                                // efect real time in progile head
                                let profile = this.$root.$refs.Profile
                                profile.follow_type = 'follow'
                                $(`#follow`+profile.user.token+` button`).addClass('follow-idle').removeClass('follow-active')
                                // efect real time in post active

                                // este cambia las variables en el componente link
                                $(`#follow`+this.post.token+' button').addClass('follow-active').removeClass('follow-idle')
                                $(`#followMovile`+this.post.token+' span').addClass('follow-active').removeClass('follow-idle')
                                this.disable_follow = false
                                this.post.privacy === 'Followers' ? this.$parent.user_auth_is_privacy = true : ''
                                this.follow_type = 'follow'

                                // efect real time in others posts channel activity
                                _.forEach(this.$root.$refs.channelActivity.$children, function(children){
                                    if(children.$options._componentTag === 'post'){
                                        if(children.post.user.username === self.post.user.username){
                                            children.$children.map(react => {
                                                if (react.$options._componentTag === 'post-reactions') {
                                                    react.follow_type = 'follow'
                                                    $(`#follow` + children.post.token + ' button').removeClass('follow-active').addClass('follow-idle')
                                                    $(`#followMovile` + children.post.token + ' span').removeClass('follow-active').addClass('follow-idle')
                                                }
                                            })
                                        }
                                    }
                                })
                            }

                            this.disable_follow = false
                            this.follow_type = 'follow'
                            this.post.privacy === 'Followers' ? this.$parent.user_auth_is_privacy = false : ''
                            $(`#follow`+this.post.token+' button').addClass('follow-idle').removeClass('follow-active')
                            $(`#followMovile`+this.post.token+' span').addClass('follow-idle').removeClass('follow-active')
                            this.$root.$refs.AppNav.followings = res.data.followings
                            this.$root.$refs.modalRelathion.followings = []
                            _.each(res.data.followings , follow =>{ this.$root.$refs.modalRelathion.followings.push(follow.following)})
                            _.forEach(this.$root.$refs.home.$refs.posts.$children, function(children, key){
                                if(children.$options._componentTag === 'post'){
                                    if(children.post.user.username === self.post.user.username){
                                        children.$children.map(react => {
                                            if (react.$options._componentTag === 'post-reactions') {
                                                react.follow_type = 'follow'
                                                $(`#follow` + children.post.token + ' button').addClass('follow-idle').removeClass('follow-active')
                                                $(`#followMovile` + children.post.token + ' span').addClass('follow-active').removeClass('follow-idle')
                                            }
                                        })
                                    }
                                }
                            })
                        }
                    }).catch(err =>{
                        if(err.response) Auth.keepLogged(err.response.status)
                    })
                }else{$('#ModalLogin').modal('show')}
            },
            async storeSupport(){
                this.disable_support = true
                let url = ''
                if(this.support_type === 'support' || this.support_type === 'unSupport'){
                    this.$parent.showModalSupport()
                    this.disable_support = false
                    return false
                }

                if(this.support_type === 'support-payment'){
                    url = `/${Auth.state.username}/Support/save/${this.post.user.username}`
                }
                // se comenta por nueva interacion de mostrar el plan actual
                // if(this.support_type === 'unSupport'){
                //     if (this.post.user.supports) {
                //         this.post.user.supports.map(support =>{
                //             if (Auth.state.username === support.user.username) {
                //                 url = `/${Auth.state.username}/Support/delete/${support.id}`
                //             }
                //         })
                //     }
                // }
                await Auth.setSession()
                axios.post(url, this.support).then(res => {
                    let self = this
                    if(res.data.saved){
                        this.disable_support = false
                        this.support_type = 'unSupport'
                        this.post.user.supports.push(res.data.support)
                        // this.post.privacy !== 'Everyone' && this.post.privacy !== 'Followers' ? this.$parent.user_auth_is_privacy = true : ''
                        $(`#support`+this.post.token+' button').addClass('function-contributor-active').removeClass('function-contributor-idle')

                        this.$root.$refs.modalRelathion.supportings = []
                        _.each(res.data.supportings , support =>{
                            this.$root.$refs.modalRelathion.supportings.push(support)
                        })
                        _.forEach(this.$root.$refs.home.$refs.posts.$children, function(children, key){
                            if(children.$options._componentTag === 'post'){
                                if(children.post.user.username === self.post.user.username){
                                    children.$children.map(react => {
                                        if (react.$options._componentTag === 'post-reactions') {
                                            react.support_type = 'unSupport'
                                            react.support = res.data.support
                                            children.post.user.supports.push(res.data.support)
                                            $(`#support` + children.post.token + ' button').addClass('function-contributor-active').removeClass('function-contributor-idle')
                                        }
                                    })
                                }
                            }
                        })
                    }
                    if(res.data.unSupport){
                        this.disable_support = false
                        this.support_type = 'support'
                        $(`#support`+this.post.token+' button').addClass('function-contributor-idle').removeClass('function-contributor-active')
                        this.$root.$refs.modalRelathion.supportings = []
                        _.each(res.data.supportings , support =>{
                            this.$root.$refs.modalRelathion.supportings.push(support.supporting)
                        })
                        _.forEach(this.$root.$refs.home.$refs.posts.$children, function(children, key){
                            if(children.$options._componentTag === 'post'){
                                if(children.post.user.username === self.post.user.username){
                                    children.$children.map(react => {
                                        if (react.$options._componentTag === 'post-reactions') {
                                            react.support_type = 'support'
                                            $(`#support`+children.post.token+' button').addClass('function-contributor-idle').removeClass('function-contributor-active')
                                        }
                                    })
                                }
                            }
                        })
                    }
                }).catch(err =>{Auth.keepLogged(err.response.status)})

            },
            async storeReward(){
                this.disable_reward = true
                let url =''
                if(this.reward_type === 'reward'){
                    this.$parent.showModalReward()
                    this.disable_reward = false
                    return false
                }
                if(this.reward_type === 'reward-payment') url = `/${Auth.state.username}/Reward/save/${this.post.user.username}`
                if(this.reward_type === 'unReward'){
                    this.$parent.showModalReward()
                    this.disable_reward = false
                    return false
                }
                await Auth.setSession()
                await axios.post(url, this.reward).then(res => {
                    this.disable_reward = false
                    let self = this
                    if(res.data.saved){
                        this.post.user.rewards.push(res.data.reward)
                        this.$root.$refs.modalRelathion.rewardings = []
                        _.each(res.data.rewardings , reward =>{
                            this.$root.$refs.modalRelathion.rewardings.push(reward)
                        })
                        _.forEach(this.$root.$refs.home.$refs.posts.$children, function(children, key){
                            if(children.$options._componentTag === 'post'){
                                if(children.post.user.username === self.post.user.username){
                                    children.post.user.rewards.push(res.data.reward)
                                }
                            }
                        })
                    }

                }).catch(err =>{Auth.keepLogged(err.response.status)})
            },
        }
    }
</script>

