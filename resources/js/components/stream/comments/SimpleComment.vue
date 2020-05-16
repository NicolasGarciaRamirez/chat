<template>
    <div class="comment">
        <div class="d-flex align-items-center p-2">
            <img :src="`/images/profile/${user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-pill mr-2">
            <div class="w-100">
                <div class="text-white d-flex align-items-center justify-content-between">
                    <div>
                        <span class="font-weight-bold">{{ this.user.personal_information.full_name }}</span>
                        <span class="ml-2">{{ this.comment.comment }}</span>
                    </div>
                    <img src="/images/icons/post-flame.svg" alt="flame-red" class="icon float-right">
                </div>
                <div class="comment-footer">
                    <span>4m</span>
                    <span class="mx-3">1 Lit</span>
                    <span>Reply</span>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {  
        props:['comment'],
        data(){
            return {
                user:{
                    personal_information:{
                        full_name:''
                    }
                }
            }
        },
        created(){
            this.getUser()
        },
        methods:{
            async getUser(){
                await axios.get(`/View/Post/get/${this.comment.user_comment_id}`).then(res =>{
                    this.user = res.data.user
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
        
    }
</script>
