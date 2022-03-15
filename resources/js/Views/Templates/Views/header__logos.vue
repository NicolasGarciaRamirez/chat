<template>
    <ul class="c-header-nav">
        <li class="c-header-nav-item d-flex flex-row align-items-center" v-if="!view_post__movil && !view_search__movil">
            <button class="c-header-toggler c-class-toggler d-lg-none" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <span class="navbar-toggler-icon">
                    <svg class="icon-m mb-2 fill-fourth" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"> <path d="M22.5,4.5h-21C1.2,4.5,1,4.3,1,4V1.5C1,1.2,1.2,1,1.5,1h21C22.8,1,23,1.2,23,1.5V4C23,4.3,22.8,4.5,22.5,4.5z "/> <path d="M22.5,23h-21C1.2,23,1,22.8,1,22.5V20c0-0.3,0.2-0.5,0.5-0.5h21c0.3,0,0.5,0.2,0.5,0.5v2.5 C23,22.8,22.8,23,22.5,23z"/> <path d="M22.5,13.8h-21c-0.3,0-0.5-0.2-0.5-0.5v-2.5c0-0.3,0.2-0.5,0.5-0.5h21c0.3,0,0.5,0.2,0.5,0.5v2.5 C23,13.5,22.8,13.8,22.5,13.8z"/> </svg>
                </span>
            </button>
            <a href="/" class="d-flex align-items-center pl-1  d-lg-none">
                <img src="/images/logo-white.svg" alt="noisesharsk-logo" height="30" class="noisesharks-logo" style="transform: translate(-7px, -3px);">
                <img src="/images/BETA.svg" alt="noisesharks-beta" class="position-relative" width="25" style="top:6px;left: -4px;">
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "header__logos",
        data(){
            return {
                view_post__movil: false,
                view_search__movil: false
            }
        },
        computed:{
            postMovile(){
                return this.$root.$refs.publicPostMovile
            },
            a(){
                if(!this.postMovile.controlsPost.publicPost) this.setParent()
            }
        },
        mounted(){

        },
        methods:{
            setParent(){
                let header_principal = $('#headerPrincipal')
                if(window.innerWidth <= 768){
                    header_principal.removeClass('c-header-fixed').addClass('c-header-fixed-none')
                }else{
                    if(header_principal.hasClass('c-header-fixed-none')){
                        header_principal.removeClass('c-header-fixed-none').addClass('c-header-fixed')
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>
