<template>
    <section class="channel">
        <div class="d-flex my-5 mx-3 navigation-header">
            <h3><a href="/Profile/Channel/Activity" class="text-white font-weight-bold pt-2 mr-3 active">Channel</a></h3>
            <h3><a :href="`/View/Profile/Releases/${user.user_name}`" class="c-fourth font-weight-bold">Profile</a></h3>
        </div>
        <div class="navigation-body">
            <a href="/Profile/Channel" class="c-fifth font-weight-bold mr-3 active">Activity</a>
            <a href="#" class="text-white font-weight-bold">Playlist</a>
        </div>
        <div class="container activities">
            <div class="row">
                <div class="col-md-3 activity">
                    <img src="/images/activity.jpg" alt="activity" class="img-fluid">
                    <h3 class="my-1">This is the title of the video I created</h3>
                    <div class="d-flex c-fourth my-3">
                        <div class="information"><img src="/images/icons/post-percentage-up.svg" alt=""><span>100</span></div>
                        <div class="information"><img src="/images/icons/post-flame.svg" alt="">100</div>
                        <div class="information"><img src="/images/icons/post-comment.svg" alt="">100</div>
                    </div>
                    <div class="d-flex justify-content-between c-fourth">
                        <p>11K Views </p>
                        <p>3 hrs ago</p>
                    </div>
                </div>
                <div class="col-md-3 activity">
                    <img src="/images/activity2.jpg" alt="activity" class="img-fluid">
                    <h3 class="my-1">This is the title of the video I created</h3>
                    <div class="d-flex c-fourth my-3">
                        <div class="information"><img src="/images/icons/post-percentage-up.svg" alt=""><span>100</span></div>
                        <div class="information"><img src="/images/icons/post-flame.svg" alt="">100</div>
                        <div class="information"><img src="/images/icons/post-comment.svg" alt="">100</div>
                    </div>
                    <div class="d-flex justify-content-between c-fourth">
                        <p>11K Views </p>
                        <p>3 hrs ago</p>
                    </div>
                </div>
                <div class="col-md-3 activity">
                    <img src="/images/activity3.jpg" alt="activity" class="img-fluid">
                    <h3 class="my-1">This is the title of the video I created</h3>
                    <div class="d-flex c-fourth my-3">
                        <div class="information"><img src="/images/icons/post-percentage-up.svg" alt=""><span>100</span></div>
                        <div class="information"><img src="/images/icons/post-flame.svg" alt="">100</div>
                        <div class="information"><img src="/images/icons/post-comment.svg" alt="">100</div>
                    </div>
                    <div class="d-flex justify-content-between c-fourth">
                        <p>11K Views </p>
                        <p>3 hrs ago</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            activity: true,
            playlist: false
        }
    },

    methods:{
        show(){
            if (this.activity && this.playlist == false) {
                this.playlist = true
                this.activity = false
            }
            else if (this.activity == false && this.playlist) {
                this.activity = true
                this.playlist = false
            }

        }
    }
}
</script>
