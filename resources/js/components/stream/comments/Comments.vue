<template>
    <section class="comments bg-primary p-3 c-fourth">
        <p class="font-weight-bold cursor-pointer" v-if="post.comments.length > 0" @click="view_comment = !view_comment">View {{ post.comments.length }} comments</p>

        <div v-for="(comment, index) in post.comments" :key="index" v-if="view_comment">
            <simple-comment :comment="comment" />
        </div>
        <form @submit.prevent="save">
            <input type="text" class="input-comment form-control bg-second p-3 mt-3 text-white" placeholder="Interact with a comment" v-model="comment.body">
        </form>
    </section>
</template>

<script>
    import SimpleComment from './SimpleComment'
    import Auth from '../../../helpers/Auth'
    export default {
        props:['post'],
        data(){
            return {
                comment:{
                    body: '',
                },
                view_comment: false
            }
        },
        components:{
            SimpleComment,
        },
        mounted(){
            Auth.initialize()
        },
        methods:{
            save(){
                axios.post(`/${Auth.state.username}/Comment/store/Post/${this.post.id}`, this.comment).then(res => {
                    if (res.data.saved) {
                        this.comment.body = ''
                       this.post.comments.unshift(res.data.comment)
                    }
                }).catch(err =>{
                    if (!Auth.state.token) {
                        window.location.replace('/login')
                    }
                })
            }
        }
    }
</script>
