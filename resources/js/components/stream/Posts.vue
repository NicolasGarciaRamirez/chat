<template ref="posts">
    <section class="posts mb-4"  v-if="posts">
        <div v-for="(post, index) in posts" :key="index">
            <post :post="post" />
        </div>
        <modal-share-post :post="post" />
        <modal-support  />
        <modal-reward  />
        <register />
        <modal-playlist />
    </section>
</template>

<script>
    import Post from './Post'
    import ModalReward from './ModalReward'
    import ModalSupport from './ModalSupport'
    import ModalPost from './ModalPost'
    import Register from '../auth/Register'
    import ModalPlaylist from '../user/channel/includes/ModalNewPlaylist'
    import ModalSharePost from "./ModalSharePost";

    export default {
        props:['posts'],
        components:{
            Post,
            ModalSupport,
            ModalReward,
            ModalPost,
            Register,
            ModalPlaylist,
            ModalSharePost,
        },
        data(){
            return{
                view_comment: false,
                post: null
            }
        },
    }
</script>
