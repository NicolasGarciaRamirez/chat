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
                <span class="mx-3">{{ comment.likes ? comment.likes.length : '0' }} lit</span>
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
                lit:{
                    like: 'like'
                },
                url : `/${Auth.state.username}/LitLike/like/Comment/${this.comment.id}`
            }
        },
        mounted(){
            Auth.initialize()
            this.getLike()
        },
        methods:{
            getLike() {
                if (this.comment.likes) {
                    this.comment.likes.map(val => {
                        if (Auth.state.username == val.user.username ) {
                            $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="20">')
                            this.url = `/${Auth.state.username}/LitLike/unlike/${val.id}`
                            this.lit.like = 'unlike'
                        }
                    })
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
                var id_like = ''
                if (type == 'unlike') {
                    this.comment.likes.map(value =>{
                        if (Auth.state.uusername == value.user.username) {
                            this.url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                            id_like = value.id
                        }
                    })
                }else{
                    this.url = `/${Auth.state.username}/LitLike/like/Comment/${this.comment.id}`
                }
                axios.post(this.url, this.lit).then(res =>{
                    if (res.data.saved) {
                        this.lit.like = 'unlike'
                        this.comment.likes.unshift(res.data.like)
                    }
                    if (res.data.unlike) {
                        this.lit.like = 'like'
                        var indice = this.comment.likes.indexOf(id_like)
                        this.comment.likes.splice(indice, 1)
                    }
                        
                    
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
