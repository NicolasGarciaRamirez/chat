<template>
    <div  id="content-header" v-click-outside="$parent.close">
        <h2 class="public-post--title">Create Your Content</h2>

        <ul class="public-post__content-icons">
            <input type="file" id="input-file-movil" accept="" class="d-none" v-on:change="saveFile" ref="Input">
            <li v-on:click.prevent="changeTypePost('text')" >
                <div>
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M18.3,22v-0.8c0-0.5-0.4-1-0.9-1c-0.4,0-0.8-0.1-1.2-0.1c-0.8-0.1-1.6-0.2-1.6-1.1l0-15 c3.1,0,4.7,1.7,5.6,4.4c0.1,0.4,0.5,0.7,1,0.7H22c0.6,0,1-0.5,1-1V2c0-0.6-0.5-1-1-1H12h0H2C1.5,1,1,1.5,1,2v6c0,0.6,0.5,1,1,1h0.8 c0.4,0,0.8-0.3,1-0.7c0.9-2.6,2.6-4.4,5.6-4.4l0,15c0,1-0.9,1.1-1.6,1.1c-0.4,0-0.8,0.1-1.2,0.1c-0.5,0-0.9,0.5-0.9,1V22 c0,0.6,0.5,1,1,1H12h0h5.3C17.9,23,18.3,22.5,18.3,22z"/> </svg>
                </div>
                <b>Text</b>
            </li>
            <li v-on:click.prevent="changeTypePost('audio')">
                <div>
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path class="audio-icon" d="M13.4,21c-0.2,0-0.4-0.2-0.4-0.4l-2.4-9.9l-2.2,5.5c-0.1,0.2-0.2,0.3-0.4,0.3s-0.3-0.1-0.4-0.2l-1.7-3.1H1.5 c-0.3,0-0.5-0.3-0.5-0.6C1,12.3,1.2,12,1.5,12H6c0.2,0,0.3,0.1,0.4,0.3l1.4,2.6L10.2,9c0.1-0.2,0.3-0.3,0.4-0.3 c0.2,0,0.3,0.2,0.4,0.4l2.2,9.1l2.4-14.7c0-0.3,0.2-0.5,0.5-0.5c0.2,0,0.4,0.2,0.4,0.5l0.8,9.3l1.2-0.8c0.1,0,0.1-0.1,0.2-0.1h3.7 c0.3,0,0.5,0.3,0.5,0.6s-0.2,0.6-0.5,0.6H19l-1.7,1.1c-0.1,0.1-0.3,0.1-0.4,0c-0.1-0.1-0.2-0.2-0.2-0.4L16,7.2l-2.2,13.3 C13.8,20.8,13.6,21,13.4,21L13.4,21z"/> </svg>
                </div>
                <b>Audio</b>
            </li>
            <li v-on:click.prevent="changeTypePost('video')">
                <div>
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path  d="M22,10.8l-3.1,2v-0.2c0-0.7-0.3-1.4-0.8-1.8c-0.3-0.3-0.6-0.5-0.9-0.6c1.1-0.9,1.7-2.1,1.7-3.6 c0-2.5-2.1-4.7-4.8-4.7c-1.8,0-3.3,1-4.1,2.3C9.1,3,7.6,2,5.8,2C3.1,2,1,4,1,6.7c0,1.5,0.7,2.7,1.7,3.6c-0.3,0.1-0.7,0.3-0.9,0.6 C1.3,11.3,1,12,1,12.7v6.7C1,20.8,2.2,22,3.7,22h12.5c1.5,0,2.7-1.2,2.7-2.6v-0.2l3.1,2c0.4,0.3,1,0,1-0.5v-9.4 C23,10.8,22.4,10.5,22,10.8z M9.9,9c0.2,0.4,0.5,0.8,0.9,1.1H9.1C9.4,9.8,9.7,9.4,9.9,9z"/> </svg>
                </div>
                <b>Video</b>
            </li>
            <li v-on:click.prevent="changeTypePost('image')">
                <div>
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M20.5,1h-17C2.1,1,1,2.2,1,3.7v16.7C1,21.8,2.1,23,3.5,23h17c1.4,0,2.5-1.2,2.5-2.7V3.7 C23,2.2,21.9,1,20.5,1z M15.2,4.9c1.3,0,2.4,1.1,2.4,2.6s-1.1,2.6-2.4,2.6c-1.3,0-2.4-1.1-2.4-2.6S13.9,4.9,15.2,4.9z M19.7,20.5 H12H4.6c-0.7,0-1-0.5-0.7-1.1l4.1-8.7c0.3-0.6,0.9-0.7,1.3-0.1l4.1,5.8c0.4,0.6,1.1,0.6,1.6,0.1l1-1.1c0.5-0.5,1.2-0.4,1.5,0.1 l2.6,4C20.6,20.1,20.4,20.5,19.7,20.5z"/> </svg>
                </div>
                <b>Image</b>
            </li>
            <li v-on:click.prevent="changeTypePost('link')">
                <div>
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M22.1,4.8L19.3,2c-1.2-1.3-3.3-1.3-4.5,0l-3.2,3c-1.3,1.2-1.3,3.3,0,4.5l1.8-1.8c-0.2-0.6,0-1.2,0.5-1.6l2-2 c0.6-0.6,1.6-0.6,2.3,0l1.7,1.7c0.6,0.6,0.6,1.6,0,2.3l-2,2c-0.4,0.4-1.1,0.6-1.6,0.5l-1.7,1.8c1.2,1.3,3.3,1.3,4.5,0l3.1-3.1 C23.3,8.1,23.3,6.1,22.1,4.8z"/> <path d="M10.6,16.2c0.1,0.5-0.1,1.3-0.5,1.7l-1.9,1.9c-0.6,0.6-1.7,0.6-2.3,0L4.2,18c-0.6-0.6-0.6-1.7,0-2.3l1.9-1.9 c0.5-0.4,1.1-0.7,1.7-0.5l1.8-1.8c-1.3-1.3-3.3-1.3-4.6,0l-3,3c-1.3,1.3-1.3,3.3,0,4.6L4.8,22c1.3,1.3,3.3,1.3,4.6,0l3-3 c1.3-1.3,1.3-3.3,0-4.6L10.6,16.2z"/> <path d="M8.7,15.4c0.4,0.4,1.1,0.4,1.5,0l5.1-5.2c0.4-0.4,0.4-1.1,0-1.6c-0.4-0.4-1.1-0.4-1.5,0l-5.1,5.2 C8.3,14.2,8.3,14.9,8.7,15.4z"/> </svg>
                </div>
                <b>Link</b>
            </li>
            <li v-on:click.prevent="changeTypePost('blog')" >
                <div>
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M1.1,3.1V21c0,0.5,0.5,1,1.1,1H22c0.6,0,1.1-0.5,1.1-1.1V3.1C23,2.5,22.5,2,21.9,2H2.1C1.5,2,1.1,2.5,1.1,3.1 z M8.8,17.9H3.6v-1.3h5.2C8.8,16.6,8.8,17.9,8.8,17.9z M11.4,15.3H3.6V14h7.8V15.3z M3.6,11.7v-1.3h5.2v1.3H3.6z M11.4,9.1H3.6 V7.7h7.8V9.1z M19.3,18.9H15c-0.6,0-1.1-0.5-1.1-1.1v-9c0-0.6,0.5-1.1,1.1-1.1h4.4c0.6,0,1.1,0.5,1.1,1.1v9.1 C20.4,18.4,19.9,18.9,19.3,18.9z M21.7,4.6H2.3V3.3h19.3C21.7,3.3,21.7,4.6,21.7,4.6z"/> </svg>
                </div>
                <b>Blog</b>
            </li>
            <li v-on:click.prevent="changeTypePost('poll')">
                <div>
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M3.2,1h11c1.2,0,2.2,1,2.2,2.2l0,0c0,1.2-1,2.2-2.2,2.2h-11C2,5.4,1,4.4,1,3.2l0,0C1,2,2,1,3.2,1z"/> <path d="M1,12L1,12c0-1.2,1-2.2,2.2-2.2h17.6c1.2,0,2.2,1,2.2,2.2l0,0c0,1.2-1,2.2-2.2,2.2H3.2C2,14.2,1,13.2,1,12z"/> <path d="M3.2,18.6h4.4c1.2,0,2.2,1,2.2,2.2l0,0c0,1.2-1,2.2-2.2,2.2H3.2C2,23,1,22,1,20.8l0,0C1,19.6,2,18.6,3.2,18.6z "/> </svg>
                </div>
                <b>Poll</b>
            </li>
            <li v-on:click.prevent="changeTypePost('docs')">
                <div>
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path d="M20,6.8c0-0.1-0.1-0.1-0.1-0.1l-5.3-5.5l-0.1-0.1c-0.1,0-0.1,0-0.2,0H5.8C4.8,1.1,4,1.9,4,2.9v18.4 c0,1,0.8,1.8,1.8,1.8h12.4c1,0,1.8-0.8,1.8-1.8V7C20,6.9,20,6.8,20,6.8z M16,17.5H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2 C16.7,17,16.4,17.5,16,17.5z M16,13.8H7.8c-0.4-0.4-0.2-0.9,0.2-0.9h8.2C16.7,13.3,16.4,13.8,16,13.8z M16,10.2H7.8 C7.3,9.8,7.6,9.3,8,9.3h8.2C16.7,9.7,16.4,10.2,16,10.2z M15.1,6.5c-0.2,0-0.4-0.2-0.4-0.5V3.5c0-0.3,0.4-0.5,0.6-0.2l2.6,2.7 c0.2,0.2,0.1,0.6-0.3,0.6H15.1z"/> </svg>
                </div>
                <b>File</b>
            </li>
            <li class="hide"></li>
            <li v-on:click.prevent="changeTypePost('go live')">
                <div>
                    <svg version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve" width="1.3rem"><path d="M21.1,7.3h-1.3c-0.4-1.1-1.1-2.1-1.9-2.9c-1.3-1.3-3-2.1-4.7-2.4c-2.9-0.4-5.7,0.8-7.6,3.1 C5,5.8,4.6,6.5,4.3,7.3H2.9c-1,0-1.9,0.9-1.9,2V12c0,1.1,0.9,2,1.9,2h2.6l-0.3-0.9C4.5,10.6,4.9,8,6.5,6s4-2.9,6.4-2.6 c3.1,0.4,5.5,2.9,6,6.1c0.3,2.1-0.2,4.3-1.6,6C16,17.1,14.1,18,12,18c-1.1,0-1.9,0.9-1.9,2c0,1.1,0.9,2,1.9,2c1.1,0,1.9-0.9,1.9-2 v-0.9c1.7-0.4,3.3-1.4,4.4-2.8c0.6-0.7,1-1.5,1.4-2.3H21c1.1,0,1.9-0.9,1.9-2V9.3C23,8.2,22.1,7.3,21.1,7.3z M12.6,20 c0,0.4-0.3,0.7-0.6,0.7c-0.3,0-0.6-0.3-0.6-0.7c0-0.4,0.3-0.7,0.7-0.7c0.2,0,0.4,0,0.6,0L12.6,20L12.6,20z"/> <path d="M12,4.7c-3.2,0-5.8,2.7-5.8,6c0,1.3,0.9,3,0.9,3c0.2,0.4,0.2,0.9,0,1.2c-0.2,0.3-0.9,0.8-0.9,1.1 c0,0.3,0.3,0.6,0.8,0.6h4.3c0.4,0,1.1-0.1,1.4-0.3c0,0,5.1-2.4,5.1-5.7S15.2,4.7,12,4.7z M10.1,10.6c0,0.4-0.3,0.7-0.6,0.7 c-0.4,0-0.7-0.3-0.7-0.7S9.1,10,9.5,10C9.8,10,10.1,10.3,10.1,10.6z M12.6,10.6c0,0.4-0.3,0.7-0.6,0.7c-0.4,0-0.7-0.3-0.7-0.7 S11.6,10,12,10C12.3,10,12.6,10.3,12.6,10.6z M15.2,10.6c0,0.4-0.3,0.7-0.7,0.7s-0.6-0.3-0.6-0.7s0.3-0.6,0.6-0.6 C14.9,10,15.2,10.3,15.2,10.6z"/></svg>
                </div>
                <b class="white-space--nowrap d-flex">GO LIVE <span class="text-danger ml-1">•</span></b>
            </li>
        </ul>

        <span href="" class="btn-close" v-on:click="$parent.close()">
            <svg class="my-3" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path class="st0" d="M22.5,20.2L14.3,12l8.2-8.2c0.6-0.6,0.6-1.7,0-2.3s-1.7-0.6-2.3,0L12,9.7L3.8,1.5c-0.6-0.6-1.7-0.6-2.3,0 s-0.6,1.7,0,2.3L9.7,12l-8.2,8.2c-0.6,0.6-0.6,1.7,0,2.3c0.6,0.6,1.7,0.6,2.3,0l8.2-8.2l8.2,8.2c0.6,0.6,1.7,0.6,2.3,0 C23.2,21.9,23.2,20.8,22.5,20.2z"/> </svg>
        </span>
    </div>
</template>

<script>
    import vClickOutside from "v-click-outside";

    export default {
        name: "PublicHeaderPostMovile",
        props:['user'],
        directives: {
            clickOutside: vClickOutside.directive
        },
        computed:{
            publicPost(){
                return this.$root.$refs.publicPostMovile
            }
        },
        methods:{
            changeTypePost(post){
                if(post == 'go live'){
                    $("#CommingSoonLive").modal('show')
                    return true
                }

                if(post == 'blog' || post == 'poll'){
                    $("#CommingSoonPost").modal('show')
                    return true
                }

                let root = window.location.href.split('/')
                root = root[root.length - 1]
                root === '' || root === '#' || root === 'Search' ? window.location.replace(`/Post/Public/Movile/${post}`) : ''

            },
            saveFile(event){
                this.$root.$refs.publicPostMovile.saveFile(event)
            },
        }
    }
</script>

<style scoped>

</style>
