<template>
    <div class="banner" id="alert-marketing" style="background:linear-gradient(45deg,#21f2ff,#4181ff 59.22%,#4475ff 98.02%),#7196ff;" v-if="location">
        <button type="button" class="btn btn-link p-3 text-white close d-block d-lg-none position-absolute" @click.prevent="hidde()" style="top: 0; right: 0;">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-block d-lg-none text-center mx-auto">
            <img src="/images/profile/YouTube Ready Badge.png" class="d-block mx-auto" style="max-width: 60px">
            <span class="font-weight-bold">Download your badge now and use it outside Noisesharks to bring supporters to your channel! </span>
        </div>
        <div class="d-none d-lg-block">
            <img src="/images/profile/YouTube Ready Badge.png" style="max-width: 30px">
            <span class="font-weight-bold">Download your badge now and use it outside Noisesharks to bring supporters to your channel! </span>
        </div>
        <div class="buttons ">
            <button type="button" class="btn btn-sm rounded-pill  mx-2" v-on:click="showModalMarketing()">Download Shield</button>
            <button type="button" class="btn btn-link close d-none d-lg-block" @click.prevent="hidde()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "alert-batch",
        data(){
            return {
                location: window.location.href === 'http://localhost:8000/' || window.location.href === 'https://www.noisesharks.com/' || window.location.href === 'https://www.noisesharks.com/#'
            }
        },
        methods:{
            showModalMarketing(){
                $("#myMarketing").modal("show");
            },
            hidde(){
                $('#alert-marketing').hide()
            }
        }
    }
</script>

<style scoped>

</style>
