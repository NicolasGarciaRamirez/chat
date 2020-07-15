<template ref="posts">
    <section class="posts mb-4"  v-if="posts">
        <div v-for="(post, index) in posts" :key="index">
            <post :post="post" />
        </div>
        <modal-support  />
        <modal-reward  />
        <register />
        <modal-playlist />
        <modal-share-post  />
<!--        <modal-sure-delete :options="options_sure_delete" />-->
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
    import ModalSureDelete from "./includes/ModalSureDeleted";

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
            ModalSureDelete,
        },
        data(){
            return{
                view_comment: false,
                options_sure_delete:{
                    type: 'Post',
                    title: 'Delete Post',
                    text: 'You are about to delete this post. Would you like to proceed?',
                    buttons:{
                        cancel: true,
                        accept: true,
                        thank_you: false
                    }
                }
            }
        },

    }
</script>
