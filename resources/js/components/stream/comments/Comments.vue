<template>
    <section class="comments bg-primary p-3 c-fourth">
        <p class="font-weight-bold">View All 13 comments</p>

        <div v-for="(comment, index) in post.comments" :key="index" id="comments">
            <simple-comment :comment="comment" />
        </div>
        <!-- <form @submit.prevent="save">
            <input type="text" class="input-comment form-control bg-second p-3 mt-3 text-white" placeholder="Interact with a comment" v-model="comments.description">
        </form> -->
    </section>
</template>

<script>
    import SimpleComment from './SimpleComment'
    import Auth from '../../../helpers/Auth'
    export default {
        props:['post'],
        data(){
            return {
                comments:{
                    description: '',
                    post_id: this.post.id,
                },
                allComments:''
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
                axios.post(`/${Auth.username}/Comments/save`, this.comments).then(res => {
                    if (res.data.saved) {
                        $('html, body').animate({ scrollTop: 0 }, 'fast');
                    }
                }).catch(err =>{
                    window.location.replace('/login')
                })
            }
        }
    }
</script>
