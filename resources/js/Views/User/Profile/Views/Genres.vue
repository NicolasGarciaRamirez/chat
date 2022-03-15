<template>
    <section class="genres" v-if="user.profile_information">
        <div class="text-left d-flex flex-row flex-wrap">
            <dl class="p-3" v-for="(item , index) in genres" :key="index" >
                <dt class="text-white font-wight-bold">- {{ item.principal_genre }}</dt>
                <dd class="text-white ml-3" v-for="(specific_genre, index) in item.specific_genres" :key="index">- {{specific_genre}}</dd>
            </dl>
        </div>
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
        this.genres = JSON.parse(this.user.profile_information.display_genres)
    }
}
</script>
