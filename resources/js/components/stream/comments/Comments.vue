<template>
    <section class="comments bg-primary p-2 c-fourth">
        <p class="font-weight-bold">View All 13 comments</p>
        <simple-comment />
    </section>
</template>

<script>
    import SimpleComment from './SimpleComment'
    export default {
        components:{
            SimpleComment
        }
    }
</script>
