<template>
    <section class="">
        <span class="hide-comments cursor-pointer" v-if="post.comments.length > 0" @click="$parent.view_comment = !$parent.view_comment">
            <b>{{ $parent.view_comment ? 'Hide' : 'View' }} {{ post.comments.length }} comments</b>
        </span>
        <div v-for="(comment, index) in post.comments" :key="index" v-if="view_comment">
            <simple-comment :comment="comment"/>
        </div>
        <form @submit.prevent="loading ? '' : save()" class="fild-comment">
            <input type="text" class="form-control " placeholder="Interact with a comment" v-model="comment.body" required>
            <input type="submit" :id="`submit${post.token}`" hidden>
            <label :for="`submit${post.token}`" :class="( (comment.body.trim()).length <= 0) ? 'disable' : ''" v-if="!loading">
                Send
            </label>
        </form>
    </section>
</template>

<script>
    import SimpleComment from '../Components/SimpleComment'
    import Auth from "../../../helpers/Auth";
    export default {
        props:['post', 'view_comment'],
        data(){
            return {
                comment:{
                    body: '',
                },
                loading: false
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
                    Auth.setSession()
                    if(this.loading === true){return false}
                    this.loading = true
                    axios.post(`/${Auth.state.username}/Comment/store/Post/${this.post.id}`, this.comment).then(res => {
                        if (res.data.saved) {
                            this.comment.body = ''
                            this.post.comments.push(res.data.comment)
                            this.$toasted.show('Comment published successfully!', {
                                position: "bottom-right",
                                duration : 4000,
                                className: "notification",
                                keepOnHover: true
                            })
                            this.loading = false
                        }
                    }).catch(err =>{
                        this.loading = false
                        Auth.keepLogged(err.response.status)
                    })
                }else{
                    $('#ModalLogin').modal('show')
                }
            }
        }
    }
</script>
