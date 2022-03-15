<template>
    <section class="posts mb-4"  v-if="posts">
        <div v-for="(post, index) in posts" :key="post.token" v-if="!hiddePost">
            <post :post="post" :index="index" :user="user" :key="post.token"  />
        </div>
        <modal-share-post :post="post" />
        <modal-support ref="supportModal" :user="user" :post="post" />
        <modal-reward ref="rewardModal" :user="user" :post="post" />
        <login />
        <modal-edit-privacy :post="post"/>
    </section>
</template>

<script>
    import ModalReward from "../Components/ModalReward";
    import ModalSupport from "../Components/ModalSupport";
    import ModalPost from "../Components/ModalPost";
    import ModalSharePost from "../Components/ModalSharePost";
    import ModalPlaylist from "../../User/Channel/Components/Playlist/include/ModalNewPlaylist";
    import Login from "../../Auth/Components/Login";
    import StripeKeys from "../../../helpers/StripeKeys";
    import Auth from "../../../helpers/Auth";
    import PostMovile from './../../Home/post/PublicPostMovil'
    import ModalEditPrivacy from "../Components/ModalEditPrivacy";

    export default {
        props:['user'],
        components:{
            ModalEditPrivacy,
            ModalPost,
            ModalPlaylist,
            ModalSharePost,
            Login,
            PostMovile
        },
        data(){
            return{
                view_comment: false,
                post: {
                    user:{
                        profile_information: {}
                    }
                },
                posts: [],
                hiddePost: false,
                current_plan: '',
            }
        },
        mounted(){
            Auth.initialize()
            let self = this

            this.posts = this.$parent.all_post
            // este metodo se utiliza para guardar un view, cuando el tipo del post
            // sea diferente a audio ,link ,video
            $(window).scroll(function () {
                let scrollTop = $(window).scrollTop()

                self.posts.map(post =>{
                    let pos = document.querySelector(`#post-${post.token}`)
                    if(!pos) return false
                    let position = pos.getBoundingClientRect()
                    if(scrollTop >= position.top && scrollTop <= (position.top + position.height)){
                        if(post.resource_type !== 'audio' && post.resource_type !== 'link' && post.resource_type !== 'video') {
                            if(!post.ready_view){
                                post.ready_view = true
                                self.$children.forEach(function(children){
                                    if(children.$options._componentTag === 'post'){
                                        if(children.post.id === post.id){
                                            children.storeView()
                                            return false
                                        }
                                    }
                                })
                            }
                        }
                        if(post.resource_type === 'audio'){
                            self.$children.forEach(function(children){
                                if(children.$options._componentTag === 'post'){
                                    if(children.post.id === post.id){
                                        children.$refs.audio.muted()
                                        children.$refs.audio.playAudio()
                                    }
                                }
                            })
                        }
                    }
                    if(scrollTop >= (position.top + position.height) ){
                        console.log('ya vas mas abajo del post')
                        if(post.resource_type === 'audio'){
                            self.$children.forEach(function(children){
                                if(children.$options._componentTag === 'post'){
                                    if(children.post.id === post.id){
                                        children.$refs.audio.pauseAudio()
                                    }
                                }
                            })
                        }
                    }
                })
            })
        },
        updated() {
            this.posts = this.$parent.all_post
        },
        destroyed() {
            this.posts = this.$parent.all_post
        },
        methods:{
            // este metodo se agrego al helper location, llamar a la funcion getIp, se le envian dos parametros
            // el usuario y las referencias del componente

            updateComponent(){
                this.$forceUpdate()
            }
        }
    }
</script>
