<template>
    <div class="text-center">
        <a :href="`${post.resource}`" target="_blank"  class="text-white no-underline" v-if="post.resource_type === 'docs' && $parent.resource_extension === 'pdf'" @click="$parent.storeView">
            <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M20,6.8c0-0.1-0.1-0.1-0.1-0.1l-5.3-5.5l-0.1-0.1c-0.1,0-0.1,0-0.2,0H5.8C4.8,1.1,4,1.9,4,2.9v18.4 c0,1,0.8,1.8,1.8,1.8h12.4c1,0,1.8-0.8,1.8-1.8V7C20,6.9,20,6.8,20,6.8z M16,17.5H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2 C16.7,17,16.4,17.5,16,17.5z M16,13.8H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2C16.7,13.3,16.4,13.8,16,13.8z M16,10.2H7.8 C7.3,9.8,7.6,9.3,8,9.3h8.2C16.7,9.7,16.4,10.2,16,10.2z M15.1,6.5c-0.2,0-0.4-0.2-0.4-0.5V3.5c0-0.3,0.4-0.5,0.6-0.2l2.6,2.7 c0.2,0.2,0.1,0.6-0.3,0.6H15.1z"/> </svg>
        </a>
        <div class="cursor-pointer" v-if="post.resource_type === 'docs' && $parent.resource_extension !== 'pdf'" @click="$parent.user_auth_is_privacy ? click() : ''">
            <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M20,6.8c0-0.1-0.1-0.1-0.1-0.1l-5.3-5.5l-0.1-0.1c-0.1,0-0.1,0-0.2,0H5.8C4.8,1.1,4,1.9,4,2.9v18.4 c0,1,0.8,1.8,1.8,1.8h12.4c1,0,1.8-0.8,1.8-1.8V7C20,6.9,20,6.8,20,6.8z M16,17.5H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2 C16.7,17,16.4,17.5,16,17.5z M16,13.8H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2C16.7,13.3,16.4,13.8,16,13.8z M16,10.2H7.8 C7.3,9.8,7.6,9.3,8,9.3h8.2C16.7,9.7,16.4,10.2,16,10.2z M15.1,6.5c-0.2,0-0.4-0.2-0.4-0.5V3.5c0-0.3,0.4-0.5,0.6-0.2l2.6,2.7 c0.2,0.2,0.1,0.6-0.3,0.6H15.1z"/> </svg>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Document",
        props:['post','user'],
        methods:{
            click(){
                window.open(this.post.resource, '_blank')
                this.$parent.storeView()
            }
        }
    }
</script>

<style scoped>
    svg{
        max-width: 4rem;
        fill: #999;
    }
</style>
