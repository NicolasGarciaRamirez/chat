<template>
    <section class="navigation-body__content m-0" v-if="user.profile_information">
        <div class="card mb-0" style="background: transparent; border:none;" v-for="(release, index) in user.profile_information.releases" :key="index">
            <div class="row no-gutters">
                <div class="col-md-4 pb-3 pb-lg-0">
                    <img :src="`${release.image}`" alt="release" class="w-100 img-card shadow border-radius" style="object-fit: cover;">
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body p-0">
                        <ul class="list-group text-left list-group-flush">
                            <li class="list-group-item border-0 pt-0">Artist:       <b class="font-weight-bold">{{ release.artistic_name }}</b> </li>
                            <li class="list-group-item border-0 pt-0">Album:        <b class="font-weight-bold">{{ release.album_name }}</b> </li>
                            <li class="list-group-item border-0 pt-0">Genre:        <b class="font-weight-bold">{{ release.genre }}</b> </li>
                            <li class="list-group-item border-0 pt-0">Release Date: <b class="font-weight-bold">{{ release.release_date }}</b> </li>
                            <li class="list-group-item border-0 pt-0">Label:        <b class="font-weight-bold">{{ release.label }}</b> </li>
                            <li class="list-group-item border-0 pt-0">Label:        <b class="font-weight-bold">{{ release.label }}</b> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props:['user']
}
</script>
