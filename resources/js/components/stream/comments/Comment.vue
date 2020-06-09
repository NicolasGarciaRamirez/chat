<template>
    <div class="d-flex align-items-center p-3 w-100">
        <img :src="`${comment.user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-pill mr-2">
        <div class="w-100">
            <div class="text-white d-flex align-items-center justify-content-between">
                <div>
                    <span ><a :href="`/${comment.user.username}/Profile/WorkHistory`" class="font-weight-bold no-underline text-white">{{ comment.user.personal_information.full_name }}</a></span>
                    <span class="ml-2">{{ comment.body }}</span>
                </div>
                <div :id="`litComment`+comment.id" @click="colorFlame(lit.like)">
                    <img src="/images/icons/post-flame.svg" alt="flame-red" class=" float-right" height="20">
                </div>
            </div>
            <div class="comment-footer">
                <span>{{ comment.time_ago }}</span>
                <span class="mx-3">1 Lit</span>
                <span @click="$parent.form_reply = true" class="cursor-pointer">Reply</span>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from '../../../helpers/Auth'
import Like from '../../../helpers/likes'
    export default {
        props: ['comment'],
        data(){
            return {
                lit:{
                    like: 'like'
                },
                url : `/${Auth.state.username}/LitLike/store/Comment/${this.comment.id}/like`
            }
        },
        mounted(){
            Auth.initialize()
            this.getLike()
        },
        methods:{
            getLike() {
                console.log(this.comment)
                this.comment.likes.map(val => {
                    if (Auth.state.username == val.user.username ) {
                        $(`#lit`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" width="20">')
                        this.url = `/${Auth.state.username}/LitLike/store/Comment/${this.comment.id}/unlike/${val.id}`
                        this.lit.like = 'unlike'
                    }
                })
            },
            colorFlame(type){
                if (Auth.state.token) {     
                    if (type == 'like') {
                        $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" width="20">')
                        this.store(type)
                    }
                    if(type == 'unlike'){
                        $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame.svg" width="20">')
                        this.store(type)
                    }
                }else{
                    $('#ModalLogin').modal('show')
                }

            },
            store(type){
                axios.post(this.url, this.lit).then(res =>{
                    if (res.data.saved) {
                        if (type == 'like') {
                            this.lit.like = 'unlike'
                            this.comment.likes.unshift(res.data.like)
                        }else{
                            this.lit.like = 'like'
                            var indice = this.comment.likes.indexOf(res.data.like)
                            this.comment.likes.splice(indice, 1)
                        }
                    }
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
