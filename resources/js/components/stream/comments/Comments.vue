<template>
    <section class="comments bg-primary p-3 c-fourth">
        <p class="font-weight-bold">View All 13 comments</p>

        <div v-for="(comment, index) in allComments" :key="index">
            <simple-comment :comment="comment" />
        </div>
        <form @submit.prevent="save">
            <input type="text" class="form-control bg-second p-3 mt-3 text-white" placeholder="Interact with a comment" v-model="comments.description">
        </form>
    </section>
</template>

<script>
    import SimpleComment from './SimpleComment'
    export default {
        props:['post'],
        data(){
            return {
                comments:{
                    description: ''
                },
                allComments:''
            }
        },
        components:{
            SimpleComment,
        },
        created(){
            this.getComments()
        },
        methods:{
            getComments(){
                axios.get(`/View/Comments/get/${this.post.id}`).then(res => {
                    this.allComments = res.data.post.comments
                }).catch(err => {
                    
                })
            },
            save(){
                axios.post(`/Comments/save/${this.post.id}`, this.comments).then(res => {
                    if (res.data.saved) {
                        window.location.reload()
                    }
                }).catch(err =>{
                    window.location.replace('/login')
                })
            }
        }
    }
</script>
