<template>
    <section class="releases container-fluid" v-if="user.profile_information">
        <div class="release mb-5"  v-for="(release, index) in user.profile_information.releases" :key="index">
            <img :src="`${release.image}`" alt="release" class="img-fluid">
            <div class="m-3">
                <span>Artist: </span><b class="font-weight-bold text-white ml-2">{{ release.artistic_name }}</b><br>
                <span>Album:</span><b class="font-weight-bold text-white ml-2">{{ release.album_name }}</b><br>
                <span>Release Date: </span><b class="font-weight-bold text-white ml-2">{{ release.release_date }}</b><br>
                <span>Genre: </span><b class="font-weight-bold text-white ml-2">{{ release.genre }}</b><br>
                <span>Label: </span><b class="font-weight-bold text-white ml-2">{{ release.label }}</b><br>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props:['user']
}
</script>
