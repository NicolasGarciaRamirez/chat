<template>
    <section class="comments bg-primary pb-3 pl-3 pr-3 c-fourth">
        <p class="font-weight-bold cursor-pointer py-2" v-if="post.comments.length > 0" @click="$parent.view_comment = !$parent.view_comment">{{ $parent.view_comment ? 'Hide' : 'View' }} {{ post.comments.length }} comments</p>
        <div v-for="(comment, index) in post.comments" :key="index" v-if="view_comment">
            <simple-comment :comment="comment"/>
        </div>
        <form @submit.prevent="save" class="py-3">
            <input type="text" class="input-comment form-control bg-second p-3 text-white" placeholder="Interact with a comment" v-model="comment.body">
        </form>
    </section>
</template>

<script>
    import SimpleComment from './SimpleComment'
    import Auth from '../../../helpers/Auth'
    export default {
        props:['post', 'view_comment'],
        data(){
            return {
                comment:{
                    body: '',
                },
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
                if (Auth.state.token) {
                    axios.post(`/${Auth.state.username}/Comment/store/Post/${this.post.id}`, this.comment).then(res => {
                        if (res.data.saved) {
                            this.comment.body = ''
                            this.post.comments.push(res.data.comment)
                            this.$toasted.show('The comment has been saved successfully!', {
                                position: "bottom-right",
                                duration : 4000,
                                className: "p-4 notification bg-primary",
                                keepOnHover: true
                            })
                        }
                    }).catch(err =>{

                    })
                }else{
                    $('#ModalLogin').modal('show')
                }
            }
        }
    }
</script>
