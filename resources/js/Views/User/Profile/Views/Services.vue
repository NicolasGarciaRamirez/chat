<template>
    <section class="services">
        <div class="text-left d-flex flex-row flex-wrap">
            <dl class="p-3" v-for="(item , index) in services" :key="index" >
                <dt class="text-white font-wight-bold">- {{ item.principal_service }}</dt>
                <dd class="text-white ml-3" v-for="(specific_service, index) in item.specific_services" :key="index">- {{specific_service}}</dd>
            </dl>
        </div>
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
        this.services = JSON.parse(this.user.profile_information.display_services)
    }
}
</script>
