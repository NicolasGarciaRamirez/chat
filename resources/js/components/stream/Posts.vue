<template>
    <section class="posts"  v-if="posts">
        <div v-for="(post, index) in posts" :key="index" >
            <post :post="post" />
        </div>
    </section>
</template>

<script>
    import Post from './Post'
    export default {
        props:['posts'],
        components:{
            Post
        }
    }
</script>
