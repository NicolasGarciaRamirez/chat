<template ref="posts">
    <section class="posts mb-4"  v-if="posts">
        <div v-for="(post, index) in posts" :key="index">
            <single-post :post="post" />
        </div>
        <modal-share-post :post="post" />
        <modal-support :user="user"  />
        <modal-reward :user="user"  />
        <register />
        <modal-playlist />
    </section>
</template>

<script>
    import SinglePost from '../Components/SinglePost'
    import ModalReward from "../Components/ModalReward";
    import ModalSupport from "../Components/ModalSupport";
    import ModalPost from "../Components/ModalPost";
    import ModalSharePost from "../Components/ModalSharePost";
    import ModalPlaylist from "../../User/Channel/Components/Playlist/include/ModalNewPlaylist";
    import Register from "../../Auth/Views/Register";


    export default {
        props:['posts'],
        components:{
            SinglePost,
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
                post: null,
                user: null
            }
        },
    }
</script>
