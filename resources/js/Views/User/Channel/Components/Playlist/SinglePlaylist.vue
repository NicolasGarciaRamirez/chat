<template>
    <section>
        <div class="d-flex flex-column play m-3">
            <a :href="`/${auth.username}/Channel/Playlist/get/${playlist.token}`">
                <img :src="playlist.image" alt="play" class="img-fluid" width="300" height="300">
            </a>
            <!-- <i class="fas fa-video position-absolute"></i> -->
            <h4 class="my-1">{{ playlist.title }}</h4>
        </div>
    </section>
</template>

<script>
import Auth from "../../../../../helpers/Auth";
export default {
    props:['playlist'],
    data(){
        return {
            auth: Auth.state
        }
    },
    mounted(){
        Auth.initialize()
    }
}
</script>
