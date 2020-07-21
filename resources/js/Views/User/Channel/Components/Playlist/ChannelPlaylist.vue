<template>
    <section  class="playlist">
        <div class="d-flex my-5 mx-3 navigation-header">
            <h3><a :href="`/${user.username}/Channel/Activity`" :class="'text-white font-weight-bold pt-2 mr-3 active'">Channel</a></h3>
            <h3><a :href="`/${user.username}/Profile/Releases`" class="c-fourth font-weight-bold">Profile</a></h3>
        </div>
        <div class="d-flex flex-row">
            <p class="text-white p-3">
                {{ user.profile_information ? user.profile_information.about_you: '' }}
            </p>
        </div>
        <div class="navigation-body">
            <a :href="`/${user.username}/Channel/Activity`" class="text-white font-weight-bold mr-3">Activity</a>
            <a :href="`/${user.username}/Channel/Playlist`" class="c-fifth font-weight-bold active">Playlist</a>
        </div>
        <div class="container">
            <div class="d-flex flex-row">
                <single-playlist v-for="(playlist ,index) in user.playlists" :key="index" :playlist="playlist" :user="user"/>
            </div>
        </div>

    </section>
</template>

<script>
import SinglePlaylist from './SinglePlaylist'
export default {
    props:['user'],
    components:{
        SinglePlaylist
    }
}
</script>