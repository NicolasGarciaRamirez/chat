<template>
    <section>
        <vue-wave-surfer :src="post.resource" :options="options"></vue-wave-surfer>
    </section>
</template>

<script>

import VueWaveSurfer from 'vue-wave-surfer'

export default {
    components:{
        VueWaveSurfer
    },
    data(){
        return {
            options: {},
            post: {
                resource: '"/images/post/audio/R67d1f2epE/c4ca4238a0b923820dcc509a6f75849bAUD-20161126-WA0004.mp3"'
            }
        }
    }
}
</script>
