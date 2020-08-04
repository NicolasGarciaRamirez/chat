<template>
    <section class="genres" v-if="user.profile_information">
        <ul v-for="(genre, index) in genres" :key="index">
            <li>{{ genre }}</li>
        </ul>
    </section>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            genres:[]
        }
    },
    mounted(){
        this.genres = this.user.profile_information.genres.split(",")
    }
}
</script>
