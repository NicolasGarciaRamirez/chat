<template>
    <div class="d-flex align-items-center p-3 w-100">
        <img :src="`${comment.user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-pill mr-2">
        <div class="w-100">
            <div class="text-white d-flex align-items-center justify-content-between">
                <div class="d-flex flex-row align-items-center">
                    <span ><a :href="`/${comment.id}/Profile/WorkHistory`" class="font-weight-bold no-underline text-white">{{ comment.user.personal_information.full_name }}</a></span>
                    <span class="ml-2" :id="`comment_body`+comment.id" >
                        <form @submit.prevent="update" v-if="edit">
                            <input type="text"  v-model="comment.body" autofocus class="input-comment form-control bg-second p-3 mt-3 text-white" />
                        </form>
                        <span v-if="!edit">{{ comment.body }}</span>
                    </span>
                    <i class="fas fa-ellipsis-h c-third fa-1x ml-1"  id="dropdownMenuComment"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu bg-primary text-white p-2" aria-labelledby="dropdownMenuComment">
                        <div v-if="comment.user.username == auth.username">
                            <div class="dropdown-item" @click="edit = true">Edit</div>
                            <div class="dropdown-item" @click="deleteComment">Delete</div>
                        </div>
                        <div v-else>
                            <a href="mailto:support@noisesahrks.com" class="dropdown-item">Report</a>
                            <a href="#" class="dropdown-item">Hidden</a>
                        </div>
                    </div>
                </div>
                <div :id="`litComment`+comment.id" @click="colorFlame(like_type)">
                    <img src="/images/icons/post-flame.svg" alt="flame-red" class=" float-right" height="20">
                </div>
            </div>
            <div class="comment-footer">
                <span>{{ comment.time_ago }}</span>
                <span class="mx-3">{{ likes.length }} lit</span>
                <span @click="$parent.form_reply = true" class="cursor-pointer"><span @click="$parent.reply.body = `@`+comment.user.personal_information.first_name+' '+comment.user.personal_information.last_name ">Reply</span></span>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from '../../../helpers/Auth'
    export default {
        props: ['comment'],
        template:{
            
        },
        data(){
            return {
                edit:false,
                like_type:'like',
                url : ``,
                lit:{
                    like: 'like'
                },
                likes:[],
                auth: Auth.state
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
            },
            update(){
                axios.post(`/${this.auth.username}/Comment/update/${this.comment.id}`, this.$parent.comment).then(res =>{
                    if (res.data.updated) {
                        this.edit = false
                        this.$toasted.show('The comment has been updated successfully!', {
                            position: "bottom-right",
                            duration : 4000,
                            className: "p-4 notification bg-primary",
                            keepOnHover: true
                        })
                    }
                }).catch(err =>{
                    alert('the comment cannot be empty')
                })
            },
            deleteComment(){
                axios.delete(`/${this.auth.username}/Comment/delete/${this.comment.id}`).then(res =>{
                    if (res.data.deleted) {
                        this.$toasted.show('The comment has been deleted successfully!', {
                            position: "bottom-right",
                            duration : 4000,
                            className: "p-4 notification bg-primary",
                            keepOnHover: true
                        })
                        var indice = this.$parent.$parent.post.comments.findIndex(element => element.id == res.data.comment.id)
                        this.$parent.$parent.post.comments.splice(indice, 1)
                    }
                }).catch(err =>{
                     
                })
            }
        }
    }
</script>
