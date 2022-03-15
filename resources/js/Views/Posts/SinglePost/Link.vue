<template>
    <div style="border-radius: .6rem; overflow:hidden" >
        <div v-if="link_is_youtube">
            <youtube :video-id="code" @playing="playing" player-width="100%" player-height="460px" :player-vars="{origin: location}"></youtube>
        </div>
        <div @click="newWindow()" v-else>
            <img class="img-fluid" :src="post.resource" style="object-fit: cover; width: 100%; height: 25rem">
            <div class="d-flex c-fourth flex-column justify-content-start p-3">
                <span class="mb-1">{{link_info.domain}}</span>
                <p class="font-weight-bold mb-1 underline cursor-pointer">{{link_info.title}}</p>
                <p class="mb-0">{{link_info.description}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Link",
        props:['post','user'],
        data(){
            return {
                code: '',
                ready_view: false,
                location: window.location.href
            }
        },
        mounted() {
            this.code = this.post.resource ? this.post.resource : ''
        },
        computed:{
            link_is_youtube(){
                if(this.post.link) {
                    if(this.post.domain === 'www.youtube.com'){
                        return true
                    }else return this.post.domain === 'youtu.be';
                }else {
                    return false
                }
            },
            link_info(){
                if(this.post.link_info !== null || typeof this.post.link_info !== 'object') {
                    return this.post.link_info === "null"
                        ? {domain: '',title: '',description: ''}
                        : JSON.parse(this.post.link_info)
                }else {
                    return {
                        domain: '',
                        title: '',
                        description: ''
                    }
                }
            }
        },
        methods:{
            newWindow(){
                if(!this.ready_view){
                    this.ready_view = true
                    this.$parent.storeView()
                }
                window.open(this.post.link, '_blank')
            },
            playing(){
                if(!this.ready_view){
                    this.ready_view = true
                    this.$parent.storeView()
                }
            },
            redirect(){
                window.open(this.link_info.link);
            }
        }
    }
</script>

<style scoped>

</style>
