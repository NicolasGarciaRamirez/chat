<template>
    <section  class="playlist">
        <div class="d-flex my-5 mx-3 navigation-header">
            <h3><a :href="`${user.username}/Channel/Activity`" :class="'text-white font-weight-bold pt-2 mr-3 active'">Channel</a></h3>
            <h3><a :href="`${user.username}/Profile/Releases`" class="c-fourth font-weight-bold">Profile</a></h3>
        </div>
        <div class="d-flex flex-row">
            <p class="text-white p-3">
                {{ user.personal_information.about_you }}
            </p>
        </div>
        <div class="navigation-body">
            <a :href="`/${user.username}/Channel/Activity`" class="c-fifth font-weight-bold mr-3">Activity</a>
            <a :href="`/${user.username}/Channel/Playlist`" class="text-white font-weight-bold active">Playlist</a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 play">
                    <img src="/images/activity.jpg" alt="play" class="img-fluid">
                    <i class="fas fa-video  position-absolute"></i>
                    <h3 class="my-1">This is the title of the video I created</h3>
                </div>
                <div class="col-md-4 play">
                    <img src="/images/activity2.jpg" alt="play" class="img-fluid">
                    <i class="fas fa-video  position-absolute"></i>
                    <h3 class="my-1">This is the title of the video I created</h3>
                </div>
                <div class="col-md-4 play">
                    <img src="/images/activity3.jpg" alt="play" class="img-fluid">
                    <i class="fas fa-video  position-absolute"></i>
                    <h3 class="my-1">This is the title of the video I created</h3>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>