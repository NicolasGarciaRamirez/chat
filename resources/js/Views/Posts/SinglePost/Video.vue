<template>
    <div v-if="post.resource_type === 'video'" :class="(!$parent.user_auth_is_privacy) ? '' :'shadow'" style="border-radius: .6rem; overflow:hidden">
        <vue-plyr :options="options_video" ref="plyr" >
            <video
                preload="none"
                class="position-relative"
                controls
                crossorigin
                playsinline
                :data-poster="`${post.thumbnail}`"
                :src="`${post.resource}`" type="video/mp4"
                :onplay="`axios.post('/View/store/${post.id}')`"
                :id="`video-${post.token}`"
                >
            </video>
        </vue-plyr>
    </div>
</template>

<script>
    export default {
        name: "Video",
        props:['post','user'],
        data(){
            return {
                options_video: {
                    quality: {
                        default: '1080p'
                    },
                }
            }
        },
        mounted() {
            $("video").on("play", function() {
                $("video").not(this).each(function(index, video) {
                    video.pause();
                });

                $("audio").not(this).each(function(index, audio) {
                    audio.pause();
                });
            });
        }
    }
</script>

<style scoped>
    .plyr:-webkit-full-screen video {
        height: 100%;
        max-height: 100vh !important;
    }
</style>
