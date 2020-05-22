<template>
    <section class="releases container-fluid">
        <div class="release">
            <img :src="`${releases.image}`" alt="release" class="img-fluid">
            <div class="m-3">
                <label>Artist: </label><b class="font-weight-bold text-white ml-2">{{ releases.artist_name }}</b><br>
                <label>Album:</label><b class="font-weight-bold text-white ml-2">{{ releases.album_name }}</b><br>
                <label>Release Date: </label><b class="font-weight-bold text-white ml-2">{{ releases.release_date }}</b><br>
                <label>Genre: </label><b class="font-weight-bold text-white ml-2">{{ releases.genre }}</b><br>
                <label>Label: </label><b class="font-weight-bold text-white ml-2">{{ releases.label }}</b><br>
                <!-- <label>Credits: </label><b class="font-weight-bold text-white ml-2">{{ releases.credits }}</b> -->
            </div>
        </div>
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