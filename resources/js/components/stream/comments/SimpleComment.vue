<template>
    <div class="comment">
        <div class="d-flex p-2 flex-column">
            <text-comment :comment="comment"/>
            <text-comment v-for="(reply, index) in comment.comments" :comment="reply" :key="index" class="ml-5 pr-5"/>
            <form @submit.prevent="store()" v-if="form_reply" class="ml-5 w-50">
                <input type="text" class="input-comment form-control bg-second p-3 text-white" placeholder="Interact with a comment" v-model="reply.body">
            </form>
        </div>
    </div>
</template>

<script>
    import Auth from '../../../helpers/Auth'
    import TextComment from './Comment'
    export default {
        props:['comment'],
        components:{
            TextComment
        },
        data(){
            return {
                form_reply: false,
                reply: {
                    body: '',
                },
            }
        },
        mounted(){
            Auth.initialize()
        },
        methods:{
            store(){
                axios.post(`/${Auth.state.username}/Comment/store/Comment/${this.comment.id}`, this.reply).then(res =>{
                    if (res.data.saved) {
                        this.reply.body = ''
                        this.comment.comments.unshift(res.data.comment)
                    }
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
