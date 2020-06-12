<template>
    <section class="posts mb-4"  v-if="posts">
        <div v-for="(post, index) in posts" :key="index" >
            <post :post="post"   />
        </div>
        <modal-support  />
        <modal-reward  />
        <modal-login />
        <register />
    </section>
</template>

<script>
    import Post from './Post'
    import ModalReward from './ModalReward'
    import ModalSupport from './ModalSupport'
    import ModalPost from './ModalPost'
    import Register from '../auth/Register'
    import ModalLogin from '../auth/Login'

    export default {
        props:['posts'],
        components:{
            Post,
            ModalSupport,
            ModalReward,
            ModalPost,
            Register,
            ModalLogin
        }
    }
</script>
