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
                    <div class="dropdown-menu text-white p-2" aria-labelledby="dropdownMenuPlaylist">
                        <div class="dropdown-item" @click="showModalAddVideos"><i class="fas fa-plus-circle mr-2"></i> Add video(s)</div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item" @click="showModalPlaylist">Edit Playlist Details</div>
                        <div class="dropdown-item link-post" @click="deletePlaylist">Delete Playlist</div>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-item" @click="showModalShare">Share</div>
                        <div class="dropdown-item" @click="copyLink">Copy Link</div>
                    </div>
                </div>
                <label class="c-fourth my-3">{{ playlist.playlist_post.length }} videos</label>
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
                <single-post-playlist :post="post" />
            </div>
            <div class="col col-sm ml-3">
                <all-post-playlist  v-for="(post, index) in playlist.playlist_post" :key="index" :post="post.post" :class="index == 0 ? 'bg-primary' : ''"/>
            </div>
        </div>
        <modal-playlist :playlis="playlist" />
        <modal-share :post="post" />
    </section>
</template>

<script>
import SinglePostPlaylist from './SinglePostPlaylist'
import AllPostPlaylist from './AllPostPlaylist'
import ModalPlaylist from "./include/ModalNewPlaylist";
import ModalAddVideos from "./include/ModalAddVideos";
import ModalShare from "../../../../Posts/Components/ModalSharePost";
import Auth from "../../../../../helpers/Auth";
export default {
    props:['playlist'],
    components:{
        SinglePostPlaylist,
        AllPostPlaylist,
        ModalAddVideos,
        ModalPlaylist,
        ModalShare
    },
    data(){
        return {
            post: {}
        }
    },
    mounted(){
        this.getPostPlaying()
        Auth.initialize()
    },
    methods:{
        showModalShare(){
            $('#ModalShare').modal('show')
        },
        showModalAddVideos(){
            $('#ModalAddVideos').modal('show')
        },
        showModalPlaylist(){
            $('#ModalPlaylist').modal('show')
        },
        copyLink(){

        },
        getPostPlaying(){
            if (this.playlist.playlist_post) {
                var cont = 1
                this.playlist.playlist_post.map(post => {
                    if (cont === this.playlist.playlist_post.length) {
                        this.post = post.post
                        cont=1
                    }
                    cont++
                })
            }
        },
        deletePlaylist(){
            axios.post(`/${Auth.state.username}/Channel/Playlist/delete/${this.playlist.id}`).then(res =>{
                if (res.data.deleted) {
                    window.location.replace(`/${Auth.state.username}/Channel/Playlist`)
                }
            }).catch(err =>{
                console.log(err)
            })
        }
    }
}
</script>
