<template>
    <section >
        <div class="form-group post-form" v-if="auth">
            <div class="bg-primary">
                <textarea  rows="5" class="form-control bg-primary" placeholder="Add Some value to the music industry..."></textarea>
            </div>
            <div class="bg-primary post-footer d-flex justify-content-between align-items-center pr-2">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="/images/icons/sound.svg" alt="">
                    <img src="/images/icons/video-camera.svg" alt="">
                    <img src="/images/icons/image.svg" alt="">
                    <img src="/images/icons/paperclip.svg" alt="">
                    <a href="#">GO LIVE <span class="c-fifth">•</span></a>
                </div>
                <button class="btn bg-fifth text-white rounded-pill">POST</button>
            </div>
        </div>
        <posts />
    </section>
</template>

<script>
    import Posts from "../stream/Posts";
    export default {
        data(){
            return {
                auth : false
            }
        },
        components:{
            Posts
        },
        mounted(){
            this.authCheck()
        },
        methods:{
            authCheck(){
                axios.post('/Auth/Check').then(res => {
                    this.auth = res.data.auth 
                })
            }
        }
    }
</script>
