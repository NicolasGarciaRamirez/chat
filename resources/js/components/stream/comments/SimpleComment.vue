<template>
    <div class="comment">
        <div class="d-flex align-items-center p-2">
            <div v-if="!comment.comment_parent_id" class="d-flex align-items-center p-3">
                <img :src="`${comment.user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-pill mr-2">
                <div class="w-100">
                    <div class="text-white d-flex align-items-center justify-content-between">
                        <div>
                            <span class="font-weight-bold">{{ comment.user.personal_information.full_name }}</span>
                            <span class="ml-2">{{ comment.description }}</span>
                        </div>
                        <img src="/images/icons/post-flame.svg" alt="flame-red" class="icon float-right">
                    </div>
                    <div class="comment-footer">
                        <span>4m</span>
                        <span class="mx-3">1 Lit</span>
                        <span @click="form_reply = true">Reply</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row pl-5 pr-5">
            <div v-if="comment.comment_parent_id" class="d-flex align-items-center p-3">
                <img :src="`${comment.user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-pill mr-2">
                <div class="w-100">
                    <div class="text-white d-flex align-items-center justify-content-between">
                        <div>
                            <span class="font-weight-bold">{{ comment.user.personal_information.full_name }}</span>
                            <span class="ml-2">{{ comment.description }}</span>
                        </div>
                        <div class="text-right d-flex flex-row justify-content-end ">
                            <img src="/images/icons/post-flame.svg" alt="flame-red" class="icon float-right">
                        </div>
                    </div>
                    <div class="comment-footer">
                        <span>4m</span>
                        <span class="mx-3">1 Lit</span>
                    </div>
                </div>
            </div>

            <form @submit.prevent="save" class="w-100" v-if="form_reply">
                <input type="text" class="input-comment form-control bg-second p-3 mt-3 text-white" placeholder="Interact with a comment" v-model="reply.description">
            </form>
        </div>

    </div>
</template>

<script>
    import Auth from '../../../helpers/Auth'
    export default {
        props:['comment'],
        data(){
            return {
                form_reply:false,
                reply: {
                    description: '',
                    user_id: this.comment.user.id,
                    post_id: this.comment.post_id,
                    comment_parent_id: this.comment.id
                }
            }
        },
        mounted(){
            Auth.initialize()
        },
        methods:{
            save(){
                axios.post(`/${Auth.state.username}/Comments/Save`, this.reply).then(res =>{
                    if (res.data.saved) {
                        $('html, body, .comments').animate({ scrollTop: 0 }, 'fast');
                    }
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
