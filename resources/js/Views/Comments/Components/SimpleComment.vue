<template>
    <div class="comment">
        <div class="d-flex flex-column">
            <text-comment :comment="comment" :view_reply="true" ref="Comment"/>
            <p class="cursor-pointer mt-2 d-flex align-items-end content-line" @click="view_reply ? view_reply = false : view_reply = true" v-if="comment.comments.length > 0">&nbsp;
                <label class="line w-25 mx-2"></label>
                {{ view_reply ? 'Hide Replies' :  'View Replies' }} ({{ comment.comments.length }})
            </p>
            <text-comment class="pl-5 py-2" v-for="(reply, index) in comment.comments" :comment="reply" :key="index" :view_reply="view_reply"/>
            <form @submit.prevent="store()" v-if="form_reply" class="ml-5 w-75 p-3">
                <input type="text" class="input-comment form-control bg-second p-3 text-white" placeholder="Interact with a comment" autofocus v-model="reply.body">
            </form>
        </div>
    </div>
</template>

<script>
    import TextComment from './Comment'
    import Auth from "../../../helpers/Auth";
    export default {
        props:['comment'],
        components:{
            TextComment
        },
        data(){
            return {
                view_reply: false,
                form_reply: false,
                reply: {
                    body: '',
                }
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
                        this.comment.comments.push(res.data.comment)
                    }

                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
