<template>
  <section class="m-3">
        <div class="d-flex flex-row">
            <div class="d-flex flex-column">
                <img :src="playlist.image" alt="" class="img-fluid" width="250" height="300">
            </div>
            <div class="d-flex flex-column ml-3">
                <div class="d-flex flex-row align-items-center">
                    <i class="fas fa-video"></i>
                    <h4 class="font-weight-bold mx-3">{{ playlist.title }}</h4>
                </div>
                <label class="c-fourth my-3">{{ playlist.posts_playlist.length }} videos</label>
                <div class="c-fourth d-flex justify-content-start">
                    {{ playlist.about }}
                </div>
                <div class="d-flex flex-row">
                    <i class="fas fa-circle-plus"></i>
                    <div class="fas fa-pencil-all mx-3"></div>
                </div>
            </div>
        </div>
        <div class="my-3" style="border-top:1px solid gray"></div>
        <div  class="row row-sm">
            <div class="col col-sm-8">
                <single-post-playlist v-for="(post, index) in playlist.posts_playlist" :key="index" :post="post.post" />
            </div>
            <div class="col col-sm ml-3">
                <all-post-playlist  v-for="(post, index) in playlist.posts_playlist" :key="index" :post="post.post" :class="index == 0 ? 'bg-primary' : ''"/>
            </div>
        </div>
    </section>
</template>

<script>
import SinglePostPlaylist from './SinglePostPlaylist'
import AllPostPlaylist from './AllPostPlaylist'
export default {
    props:['playlist'],
    data(){
        return {
            length: ''
        }
    },
    components:{
        SinglePostPlaylist,
        AllPostPlaylist
    }
}
</script>