<template>
    <section class="releases container-fluid">
        <div class="release">
            <img src="/images/activity.jpg" alt="release" class="img-fluid">
            <div class="m-3">
                <label>Artist: </label><b class="font-weight-bold text-white ml-2">{{ releases.artist }}</b><br>
                <label>Album:</label><b class="font-weight-bold text-white ml-2">{{ releases.album }}</b><br>
                <label>Genre: </label><b class="font-weight-bold text-white ml-2">{{ releases.genre }}</b><br>
                <label>Release Date: </label><b class="font-weight-bold text-white ml-2">{{ releases.release_date }}</b><br>
                <label>Label: </label><b class="font-weight-bold text-white ml-2">{{ releases.label }}</b><br>
                <label>Credits: </label><b class="font-weight-bold text-white ml-2">{{ releases.credits }}</b>
            </div>
        </div>
        <!-- <div class=" release mt-5">
            <img src="/images/activity3.jpg" alt="release" class="img-fluid">
            <div class="m-3">
                <label>Artist: </label><b class="font-weight-bold text-white ml-2">{{ releases.artist_2 }}</b><br>
                <label>Album:</label><b class="font-weight-bold text-white ml-2">{{ releases.album_2 }}</b><br>
                <label>Genre: </label><b class="font-weight-bold text-white ml-2">{{ releases.genre_2 }}</b><br>
                <label>Release Date: </label><b class="font-weight-bold text-white ml-2">{{ release.release_date_2 }}</b><br>
                <label>Label: </label><b class="font-weight-bold text-white ml-2">{{ release.label_2 }}</b><br2
                <label>Credits: </label><b class="font-weight-bold text-white ml-2">{{ release.credits_2 }}</b>
            </div>
        </div>
        <div class=" release mt-5">
            <img src="/images/activity2.jpg" alt="release" class="img-fluid">
            <div class="m-3">
                <label>Artist: </label><b class="font-weight-bold text-white ml-2">{{ releases.artist_3 }}</b><br>
                <label>Album:</label><b class="font-weight-bold text-white ml-2">{{ releases.album_3 }}</b><br>
                <label>Genre: </label><b class="font-weight-bold text-white ml-2">{{ releases.genre_3 }}</b><br>
                <label>Release Date: </label><b class="font-weight-bold text-white ml-2">{{ release.release_date_3 }}</b><br>
                <label>Label: </label><b class="font-weight-bold text-white ml-2">{{ release.label_3 }}</b><br>
                <label>Credits: </label><b class="font-weight-bold text-white ml-2">{{ release.credits_3 }}</b>
            </div>
        </div>
        <div class=" release mt-5">
            <img src="/images/activity3.jpg" alt="release" class="img-fluid">
            <div class="m-3">
                <label>Artist: </label><b class="font-weight-bold text-white ml-2">{{ releases.artist_4 }}</b><br>
                <label>Album:</label><b class="font-weight-bold text-white ml-2">{{ releases.album_4 }}</b><br>
                <label>Genre: </label><b class="font-weight-bold text-white ml-2">{{ releases.genre_4 }}</b><br>
                <label>Release Date: </label><b class="font-weight-bold text-white ml-2">{{ release.release_date_4 }}</b><br>
                <label>Label: </label><b class="font-weight-bold text-white ml-2">{{ release.label_4 }}</b><br>
                <label>Credits: </label><b class="font-weight-bold text-white ml-2">{{ release.credits_4 }}</b>
            </div>
        </div> -->
    </section>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            releases:{}
        }
    },
    mounted(){
        this.getReleases()
    },
    methods:{
        getReleases(){
            this.releases = JSON.parse(this.user.personal_information.releases)
        }
    }
}
</script>