<template>
    <section class="social_media">
        <ul v-for="(link, index) in social_media" :key="index">
           <li v-if="link != null"><a :href="link" class="no-underline text-white" target="_blank">{{ link }}</a></li> 
        </ul>
    </section>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            social_media: null
        }
    },
    mounted(){
        this.getSocialLinks()
    },
    methods:{
        getSocialLinks(){
            this.social_media = JSON.parse(this.user.profile_information.social_media)
        }
    }
}
</script>
