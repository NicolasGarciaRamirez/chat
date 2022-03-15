<template>
    <div>
        <textarea @change="typeIsLink()" :rows="rowsText" id="text-area-auto" class="form-control" placeholder="Add something valuble to the music industry..." v-model="description"></textarea>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                description: ''
            }
        },
        computed:{
            rowsText(){
                return window.innerWidth > 768 ? 1 : 10;
            }
        },
        watch:{
            description(){
                this.$parent.post.description = this.description
                if(this.description == '' || this.description == ' '){
                    this.$parent.editPost = false
                }else{
                    this.$parent.editPost = true
                }
            }
        },
        methods:{
            reset(){
                this.description = ''
            },
            store(){
                return true
            },
            async typeIsLink(){
                let description = null
                this.description.split('/').map(des =>{
                    if(des.match('https://') || des.match('www') ) {
                        description = true
                    }else{
                        description = false
                    }
                })
                if(description){
                    this.$parent.$refs.Link.resource_link = this.description
                    return await this.$parent.changeTypeIfLink('link')
                }
            }
        }
    }
</script>

