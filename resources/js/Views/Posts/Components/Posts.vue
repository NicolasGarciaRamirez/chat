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
    import ModalReward from "../Views/ModalReward";
    import ModalSupport from "../Views/ModalSupport";
    import ModalPost from "../Views/ModalPost";
    import Register from "../../Auth/Views/Register";
    import ModalPlaylist from "../../User/Channel/Components/Playlist/include/ModalNewPlaylist";
    import ModalSharePost from "../Views/ModalSharePost";
    
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
