<template>
    <section>
        <ul v-for="(work , index) in user.profile_information.worked_with" :key="index">
            <li class="text-white">{{work.name}}</li>
        </ul>
    </section>
</template>
<script>
    export default {
        props:['user'],
        data(){
            return {

            }
        }
    }
</script>
