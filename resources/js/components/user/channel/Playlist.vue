<template>
  <section class="m-3 channel-playlist">
        <div class="d-flex flex-row">
            <div class="d-flex flex-column">
                <img :src="playlist.image" alt="" class="img-fluid" style="min-width: 250px;max-width: 250px;min-height: 200px;max-height: 200px;">
            </div>
            <div class="d-flex flex-column ml-3">
                <div class="d-flex flex-row align-items-center">
                    <img src="/images/icons/video-playlist.svg" alt="" width="25" height="25">
                    <h4 class="font-weight-bold mx-3">{{ playlist.title }}</h4>
                    <i class="fas fa-ellipsis-h c-third fa-2x mr-1"  id="dropdownMenuPlaylist"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu bg-primary text-white p-2" aria-labelledby="dropdownMenuPlaylist">
                        <a href="" class="dropdown-item"><i class="fas fa-plus-circle mr-2"></i> Add video(s)</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Edit Playlist Details</a>
                        <a href="#" class="dropdown-item link-post">Delete Playlist</a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item">Share</div>
                        <div class="dropdown-item" @click="copyLink">Copy Link</div>
                    </div>
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
                <single-post-playlist :post="postPlaying.post" />
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
    components:{
        SinglePostPlaylist,
        AllPostPlaylist
    },
    data(){
        return {
            length: '',
            postPlaying:{}
        }
    },
    mounted(){
        this.getPostPlaying()
    },
    methods:{
        copyLink(){

        },
        getPostPlaying(){
            if (this.playlist.posts_playlist) {
                var cont = 1
                this.playlist.posts_playlist.map(post => {
                    if (cont === this.playlist.posts_playlist.length) {
                        this.postPlaying = post 
                    }
                    cont++
                })
            }else{
                console.log('no')
            }
        }
    }
}
</script>