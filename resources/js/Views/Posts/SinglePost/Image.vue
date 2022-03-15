<template>
    <div class="text-center">
        <img v-gallery  :id="`image`+post.token" :src="`${post.resource}`" alt="img-post" class="principal-image cursor-point" v-if="post.resource_type === 'image'" @click="$parent.storeView" />
    </div>
</template>

<script>
    export default {
        name: "Imagen",
        props:['post','user'],
        data(){
            return {
                image_width: '',
                image_height: ''
            }
        },
    }
</script>
