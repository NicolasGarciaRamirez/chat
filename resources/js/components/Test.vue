<template>
    <vue-wave-surfer :src="file" :options="options"></vue-wave-surfer>
</template>
<script>
    export default {
        data() {
            return {
                options: {
                },
                file: 'http://localhost:8000/images/post/audio/ikZw4jotJ9/c4ca4238a0b923820dcc509a6f75849b.mp3'
            }
        }
    }
</script>
