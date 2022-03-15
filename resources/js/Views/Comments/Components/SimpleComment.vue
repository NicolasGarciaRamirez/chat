<template>
<!--    este componente es el formulario par comentar un post-->
    <div class="comment">
        <div class="d-flex flex-column">
<!--          el componente text-comment es el formulario para responder un comentario -->
            <text-comment :comment="comment" :view_reply="true" ref="Comment"/>
            <div class="cursor-pointer my-2 d-flex align-items-end content-line c-fourth"  @click="view_reply ? view_reply = false : view_reply = true" v-if="comment.comments.length > 0">&nbsp;
                <label class="line w-25 mx-2"></label>
                {{ view_reply ? 'Hide Replies' :  'View Replies' }} ({{ comment.comments.length }})
            </div>
            <text-comment class="pl-5 py-2" v-for="(reply, index) in comment.comments" :comment="reply" :key="index" :view_reply="view_reply"/>
            <form @submit.prevent="loading ? '' : store()" v-if="form_reply" class="ml-5 w-75 p-3">
                <input type="text" class="form-control" placeholder="Interact with a comment" autofocus v-model="reply.body">
                <input type="submit" :id="`submit${comment.id}`" hidden>
                <label :for="`submit${comment.id}`" :class="`mr-3 ${((reply.body.trim()).length <= 0) ? 'disable' : ''}`" v-if="!loading">
                    Send
                </label>
            </form>
        </div>
    </div>
</template>

<script>
    import TextComment from './Comment'
    import Auth from "../../../helpers/Auth";
    export default {
        props:['comment'],
        components:{
            TextComment
        },
        data(){
            return {
                view_reply: false,
                form_reply: false,
                reply: {
                    body: '',
                },
                loading: false, 
                btn_reply: false,
                sources: null
            }
        },
        mounted(){
            Auth.initialize()
        },
        methods:{
            
            async store(){
                if(Auth.state.username){
                    this.btn_reply = true
                    await Auth.setSession()
                    if(this.loading === true){return false}
                    this.loading = true

                    const CancelToken = axios.CancelToken;
                    const source = CancelToken.source(); 
                    this.sources = source;
                    console.log(this.sources); 
                    let self = this                  
                    setTimeout(function(){
                        axios.post(
                            `/${Auth.state.username}/Comment/store/Comment/${self.comment.id}`,
                            self.reply,{
                                cancelToken: source.token
                            }           
                        ).then(res =>{
                            if (res.data.saved) {
                                self.btn_reply = false;
                                self.reply.body = ''
                                self.comment.comments.push(res.data.comment)
                                self.loading = false     
                                self.$toasted.show('Comment has been updated successfully!', {
                                    position: "bottom-right",
                                    duration : 4000,
                                    className: "notification",
                                    keepOnHover: true
                                })              
                            }
                        }).catch(err =>{
                            self.loading = false
                            self.btn_reply = false;
                            console.log(err)
                        })
                    },500)  

                }

            },
            cancelReply(){
                if(this.btn_reply == true){
                    this.sources.cancel();
                    swal('info', 'Operation canceled by the user.', 'info');
                }
            }
        }
    }
</script>
