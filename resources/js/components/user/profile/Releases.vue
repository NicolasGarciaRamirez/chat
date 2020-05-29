<template>
    <section class="releases container-fluid" v-if="user.profile_information">
        <div class="release mb-5"  v-for="(release, index) in user.profile_information.releases" :key="index">
            <img :src="`${release.image}`" alt="release" class="img-fluid">
            <div class="m-3">
                <label>Artist: </label><b class="font-weight-bold text-white ml-2">{{ release.artistic_name }}</b><br>
                <label>Album:</label><b class="font-weight-bold text-white ml-2">{{ release.album_name }}</b><br>
                <label>Release Date: </label><b class="font-weight-bold text-white ml-2">{{ release.release_date }}</b><br>
                <label>Genre: </label><b class="font-weight-bold text-white ml-2">{{ release.genre }}</b><br>
                <label>Label: </label><b class="font-weight-bold text-white ml-2">{{ release.label }}</b><br>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props:['user']
}
</script>