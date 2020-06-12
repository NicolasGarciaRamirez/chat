<template>
    <div class="d-flex align-items-center p-3 w-100">
        <img :src="`${comment.user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-pill mr-2">
        <div class="w-100">
            <div class="text-white d-flex align-items-center justify-content-between">
                <div>
                    <span ><a :href="`/${comment.user.username}/Profile/WorkHistory`" class="font-weight-bold no-underline text-white">{{ comment.user.personal_information.full_name }}</a></span>
                    <span class="ml-2">{{ comment.body }}</span>
                </div>
                <div :id="`litComment`+comment.id" @click="colorFlame(like_type)">
                    <img src="/images/icons/post-flame.svg" alt="flame-red" class=" float-right" height="20">
                </div>
            </div>
            <div class="comment-footer">
                <span>{{ comment.time_ago }}</span>
                <span class="mx-3">{{ likes.length }} lit</span>
                <span @click="$parent.form_reply = true" class="cursor-pointer">Reply</span>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from '../../../helpers/Auth'
    export default {
        props: ['comment'],
        data(){
            return {
                like_type:'like',
                url : ``,
                lit:{
                    like: 'like'
                },
                likes:[]
            }
        },
        mounted(){
            Auth.initialize()
            this.getLike()
        },
        methods:{
            getLike() {
                if (this.comment.likes) {
                    if (this.comment.likes[0] != null) {
                        this.comment.likes.map(like => {
                            this.likes.push(like)
                            if (Auth.state.username == like.user.username ) {
                                $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="20">')
                                this.url = `/${Auth.state.username}/LitLike/unlike/${like.id}`
                                this.like_type = 'unlike'
                                this.lit.like = 'unlike'
                            }
                        })
                    }
                }
            },
            colorFlame(type){
                if (Auth.state.token) {
                    if (type == 'like') {
                        $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="20">')
                        this.store(type)
                    }
                    if(type == 'unlike'){
                        $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame.svg" height="20">')
                        this.store(type)
                    }
                }else{
                    $('#ModalLogin').modal('show')
                }

            },
            store(type){
                if (type == 'unlike') {
                    if (this.likes[0] != null) {
                        this.likes.map(value =>{
                            if (Auth.state.username == value.user.username) {
                                this.url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                            }
                        })
                    }
                }
                if(type == 'like'){
                    this.url = `/${Auth.state.username}/LitLike/like/Comment/${this.comment.id}`
                }
                axios.post(this.url, this.lit).then(res =>{
                    if (res.data.like) {
                        this.likes.unshift(res.data.like)
                        this.like_type = 'unlike'
                    }
                    if (res.data.unlike) {
                        var indice = this.likes.indexOf(res.data.unlike)
                        this.likes.splice(indice, 1)
                        this.like_type = 'like'
                    }
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
