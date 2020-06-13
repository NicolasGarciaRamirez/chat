<template>
    <section class="channel">
        <div class="d-flex my-5 mx-3 navigation-header">
            <h3><a :href="`/${user.username}/Channel/Activity`" :class="'text-white font-weight-bold pt-2 mr-3 active'">Channel</a></h3>
            <h3><a :href="`/${user.username}/Profile/Releases`" class="c-fourth font-weight-bold">Profile</a></h3>
        </div>
        <div class="d-flex flex-row">
            <p class="text-white p-3">
                {{ user.personal_information.about_you }}
            </p>
        </div>
        <div class="navigation-body">
            <a :href="`/${user.username}/Channel/Activity`" class="c-fifth font-weight-bold mr-3 active">Activity</a>
            <a :href="`/${user.username}/Channel/Playlist`" class="text-white font-weight-bold">Playlist</a>
        </div>
        <div class="container activities">
            <div class="row">
                <div class="col-md-4 activity" v-for="(activity , index) in user.posts" :key="index">
                    <img :src="`${activity.resource}`" alt="activity" class="img-activity img-fluid" v-if="activity.resource_type == 'image'">
                    <video :src="`${activity.resource}`" controls  class="img-activity img-fluid" style="max-height: 10.8rem" v-if="activity.resource_type == 'video'" />
                    <audio :src="`${activity.resource}`" type=”audio/mp3″ controls style="margin-top: 4rem; margin-bottom: 3.5rem;" v-if="activity.resource_type == 'audio'" />
                    <iframe :src="`${activity.resource}`" frameborder="0" v-if="activity.resource_type == 'docs'"></iframe>
                    <h3 class="m-1" v-if="activity.resource_type == 'image' || activity.resource_type == 'audio' || activity.resource_type == 'video' || activity.resource_type == 'text'">{{ activity.description }}</h3>
                    <h3 v-else><a :href="`${activity.resource}`" class="text-white">{{ activity.description }}</a></h3>
                    <div class="d-flex c-fourth my-3">
                        <div class="information"><img src="/images/icons/post-percentage-up.svg" alt=""><span>{{ activity.likes ?  activity.likes.length : 0}}</span></div>
                        <div class="information"><img src="/images/icons/post-flame.svg" alt="">{{ activity.votes ? activity.votes.length: 0 }}</div>
                        <div class="information"><img src="/images/icons/post-comment.svg" alt="">{{ activity.comments ? activity.comments.length:0 }}</div>
                    </div>
                    <div class="d-flex justify-content-between c-fourth">
                        <p>11K Views </p>
                        <p>{{ activity.time_ago }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props:['user'],
}
</script>
