<template>
    <section class="services">
        <ul v-for="(service, index) in services" :key="index">
            <li>{{ service }}</li>
        </ul>
    </section>
</template>

<script>
export default {
    props:['user'],
    data(){
        return {
            services:[]
        }
    },
    mounted(){
        this.services = this.user.profile_information.services.split(",")
    }
}
</script>