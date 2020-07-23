<template>
    <section class="channel">
        <modal-login />
        <modal-new-playlist />
        <modal-share-post></modal-share-post>
        <div class="d-flex my-5 mx-3 navigation-header">
            <h3><a :href="`/${user.username}/Channel/Activity`" :class="'text-white font-weight-bold pt-2 mr-3 active'">Channel</a></h3>
            <h3><a :href="`/${user.username}/Profile/Releases`" class="c-fourth font-weight-bold">About</a></h3>
        </div>
        <div class="d-flex flex-row">
            <p class="text-white p-3">
                {{ user.profile_information ? user.profile_information.about_you : '' }}
            </p>
        </div>
        <div class="navigation-body">
            <a :href="`/${user.username}/Channel/Activity`" class="c-fifth font-weight-bold mr-3 active">Activity</a>
            <!-- <a :href="`/${user.username}/Channel/Playlist`" class="text-white font-weight-bold">Playlist</a> -->
        </div>
        <div class="container activities">
            <div class="row">
                <single-activity class="col-md-4 activity" v-for="(activity , index) in user.posts" :key="index" :activity="activity" :user="user" />
            </div>
        </div>
    </section>
</template>

<script>
import SingleActivity from './SingleActivity'
import ModalLogin from "../../../../Auth/Components/Login";
import ModalNewPlaylist from "../Playlist/include/ModalNewPlaylist";
import ModalSharePost from "../../../../Posts/Components/ModalSharePost";

export default {
    props:['user'],
    components:{
        SingleActivity,
        ModalLogin,
        ModalNewPlaylist,
        ModalSharePost
    }
}
</script>
