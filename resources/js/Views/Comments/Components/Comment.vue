<template>
    <div class="d-flex align-items-center pt-2 w-100" v-if="view_reply">
        <img :src="`${comment.user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-circle mr-2">
        <div class="w-100">
            <div class="text-white d-flex align-items-center justify-content-between">
                <div class="d-flex flex-row align-items-center justify-content-start">
                    <div class="d-flex flex-column p-1">
                        <a :href="`/${comment.user.username}/Profile`" class="font-weight-bold no-underline text-white ">
                            {{ comment.user.profile_information && comment.user.profile_information.artistic_name ? comment.user.profile_information.artistic_name : comment.user.personal_information.full_name }}
                        </a>
                        <div :id="`comment_body`+comment.id" >
                            <form @submit.prevent="update" v-if="edit">
                                <input type="text"  v-model="comment.body" autofocus class="input-comment form-control bg-second p-3 mt-3 text-white" />
                            </form>
                            <span v-if="!edit">{{ comment.body }}</span>
                            <i class="fas fa-ellipsis-h c-third fa-1x m-2"  id="dropdownMenuComment"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="transform: rotate(90deg);"></i>
                            <div class="dropdown-menu bg-primary text-white p-2" aria-labelledby="dropdownMenuComment">
                                <div v-if="comment.user.username == auth.username">
                                    <div class="dropdown-item cursor-pointer" @click="edit = true">Edit</div>
                                    <div class="dropdown-item cursor-pointer" @click="deleteComment">Delete</div>
                                </div>
                                <div v-else>
                                    <a href="mailto:support@noisesahrks.com" class="dropdown-item cursor-pointer">Report</a>
                                    <a href="#" class="dropdown-item cursor-pointer">Hidden</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div :id="`litComment`+comment.id" class="cursor-pointer" @click="disable_like ? '' : storeLike(like_type)">
                    <img src="/images/icons/post-flame.svg" alt="flame-red" class="cursor-pointer float-right" height="20">
                </div>
            </div>
            <div class="comment-footer">
                <span>{{ comment.time_ago }}</span>
                <span class="mx-3">{{ likes.length }} lit</span>
                <span class="cursor-pointer" @click="$parent.form_reply = true">
                    <span @click="$parent.reply.body = `@${comment.user.personal_information.full_name} `">Reply</span>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    export default {
        name:'Comment-text',
        props: ['comment','view_reply'],
        data(){
            return {
                edit:false,
                disable_like: false,
                like_type:'like',
                lit:{
                    like: 'like'
                },
                likes:[],
                url : ``,
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
                            }
                        })
                    }
                }
            },
            storeLike(type){
                if (Auth.state.token) {
                    this.disable_like = true
                    console.log(type)

                    if (type === 'unlike') {
                        if (this.likes.length > 0) {
                            this.likes.map(value =>{
                                if (Auth.state.username == value.user.username) {
                                    this.url = `/${Auth.state.username}/LitLike/unlike/${value.id}`
                                }
                            })
                        }
                    }
                    if(type === 'like'){
                        this.url = `/${Auth.state.username}/LitLike/like/Comment/${this.comment.id}/${this.$parent.$parent.post.id}`
                    }
                    axios.post(this.url, this.lit).then(res =>{
                        console.log(res)
                        if (res.data.like) {
                            this.disable_like = false
                            this.likes.unshift(res.data.like)
                            this.like_type = 'unlike'
                            $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame-red.svg" height="20">')

                        }
                        if (res.data.unlike) {
                            this.disable_like = false
                            let indice = this.likes.indexOf(res.data.unlike)
                            this.likes.splice(indice, 1)
                            this.like_type = 'like'
                            $(`#litComment`+this.comment.id+` img`).replaceWith('<img src="/images/icons/post-flame.svg" height="20">')
                        }
                    }).catch(err =>{
                        console.log(err)
                    })
                }else{
                    $('#ModalLogin').modal('show')
                }
            },
            update(){
                axios.post(`/${this.auth.username}/Comment/update/${this.comment.id}`, this.comment).then(res =>{
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
                    swal({
                        text:'the comment cannot be empty',
                        className:'swal-alert',
                        buttons:[false, 'Ok']
                    })
                })
            },
            deleteComment() {
                swal({
                    title: 'Delete Comment',
                    text: 'You are about to delete this comment. Would you like to proceed?',
                    className: 'swal-alert',
                    buttons: ['Cancel','Delete'],
                    dangerMode: true,
                }).then((willDelete) => {
                    if(willDelete){
                        axios.delete(`/${this.auth.username}/Comment/delete/${this.comment.id}`).then(res => {
                            if (res.data.deleted) {
                                this.$toasted.show('The comment has been deleted successfully!', {
                                    position: "bottom-right",
                                    duration: 4000,
                                    className: "p-4 notification bg-primary",
                                    keepOnHover: true
                                })
                                if (res.data.comment.commentable_type === "App\\Models\\Post\\Post") {
                                    let index = _.findIndex(this.$parent.$parent.post.comments, function (comment) {
                                        console.log(comment)
                                        return comment.id === res.data.comment.id
                                    })
                                    this.$parent.$parent.post.comments.splice(index, 1)
                                } else if (res.data.comment.commentable_type === "App\\Models\\Comment\\Comment"){
                                    if (res.data.comment.commentable_id === this.$parent.comment.id) {
                                        let index = _.findIndex(this.$parent.comment.comments, function (comment) {
                                            return comment.id === res.data.comment.id;
                                        })
                                        this.$parent.comment.comments.splice(index, 1)
                                    }
                                }
                            }
                        }).catch(err => {

                        })
                    }
                })
            }
        }
    }
</script>
