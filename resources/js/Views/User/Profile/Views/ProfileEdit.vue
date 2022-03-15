<template>
    <section class="profile">
        <div style="background: var(--second-color);">
            <div class="row navigation-body mx-auto mb-3 pb-3 " style="max-width: 1000px;">
                <div class="col-12 col-lg-6 pb-3">
                    <div class="navigation-body__content h-100 text-left  px-3 pb-0 px-lg-5">
                        <h3 class="c-white font-weight-bold text-center">
                            Personal Details
                            <svg  class="icon-sm mb-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor" xml:space="preserve"> <path d="M1,22.2c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7l-5.1-5.1L1,22.2z"/> <path d="M1.7,23c-0.2,0-0.3-0.1-0.5-0.2C1,22.6,1,22.4,1,22.2l1.7-6l5.1,5.1L1.8,23C1.8,23,1.7,23,1.7,23z M2.8,16.2 l-1.7,6c-0.1,0.2,0,0.5,0.2,0.6C1.3,22.9,1.5,23,1.7,23c0.1,0,0.1,0,0.2,0l6-1.7L2.8,16.2z"/> <path d="M22.4,4.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1c-0.5,0-1,0.2-1.4,0.6L15.6,3L21,8.4L22.4,7C22.8,6.7,23,6.2,23,5.7 C23,5.2,22.8,4.7,22.4,4.3z"/> <path d="M21.1,8.4L15.6,3l1.4-1.4C17.3,1.2,17.8,1,18.3,1c0.5,0,1,0.2,1.4,0.6l2.7,2.7C22.8,4.7,23,5.2,23,5.7 c0,0.5-0.2,1-0.6,1.4L21.1,8.4z M15.6,3l5.4,5.4L22.4,7C22.8,6.7,23,6.2,23,5.7s-0.2-1-0.6-1.3l-2.7-2.7C19.3,1.2,18.8,1,18.3,1 s-1,0.2-1.3,0.6L15.6,3z"/> <path d="M3.5,15.1L14.7,3.9l5.5,5.5L8.9,20.5L3.5,15.1z"/> <path d="M8.9,20.5l-5.5-5.5L14.7,3.8l5.5,5.5L8.9,20.5z M3.5,15.1l5.4,5.4L20.1,9.3l-5.4-5.4L3.5,15.1z"/> </svg>
                        </h3>
                        <label class="c-fourth">Name: <span class="text-white">{{ user.personal_information.full_name  }}</span></label><br>
                        <label class="c-fourth">Gender: <span class="text-white"> {{ user.personal_information.gender }}</span></label><br>
                        <label class="c-fourth">Location: <span class="text-white">{{ user.personal_information.location }}</span> </label><br>
                        <label class="c-fourth">Email: <span class="text-white">{{ user.email }}</span></label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 pb-3">
                    <div class="navigation-body__content h-100 cross-center justify-content-between">
                        <div>
                            <h3 class="c-white font-weight-bold">Subscription</h3>
                            <label class="c-fourth">Account Type: <span class="c-fifth font-weight-bold">{{ user.subscription_type }}</span></label>
                        </div>
                        <a href="#" v-on:click.prevent="windowReplaceSettings" class="btn btn-outline-light  rounded-pill">
                            Account Settings 
                            <svg class="icon-sm" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="fill: currentColor;" xml:space="preserve"> <path d="M23,12.1c0-0.8-0.6-1.7-1.3-1.9C21,9.9,20.3,9.3,20,8.8c-0.2-0.5-0.2-1.4,0.2-2.1c0.3-0.7,0.1-1.7-0.4-2.3 c-0.6-0.6-1.6-0.8-2.3-0.4c-0.7,0.3-1.6,0.4-2.1,0.2C14.8,3.7,14.2,3,14,2.3C13.7,1.6,12.8,1,12,1s-1.7,0.6-2,1.3S9.2,3.7,8.7,4 C8.2,4.2,7.2,4.1,6.5,3.8S4.8,3.6,4.2,4.2S3.4,5.8,3.8,6.6S4.2,8.3,4,8.8c-0.3,0.5-1,1.1-1.7,1.4S1,11.3,1,12.1s0.6,1.7,1.3,2 C3,14.3,3.7,14.9,4,15.4c0.2,0.5,0.2,1.4-0.2,2.1c-0.3,0.7-0.1,1.7,0.4,2.3c0.6,0.6,1.6,0.8,2.3,0.4s1.6-0.4,2.1-0.2 c0.5,0.2,1.1,0.9,1.4,1.6s1.1,1.3,2,1.3c0.8,0,1.7-0.6,2-1.3c0.3-0.7,0.9-1.4,1.4-1.6s1.4-0.2,2.1,0.2c0.7,0.3,1.7,0.1,2.3-0.4 c0.6-0.6,0.8-1.6,0.4-2.3c-0.3-0.7-0.4-1.6-0.2-2.1c0.2-0.5,0.9-1.1,1.6-1.4C22.4,13.8,23,12.9,23,12.1z M12,16.1c-2.2,0-4-1.8-4-4 s1.8-4,4-4s4,1.8,4,4S14.2,16.1,12,16.1z"/> </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="navigation-header">
                <div class="navigation-header__select-section bg-black">
                    <h3 class="mb-0">
                        <a :href="`/${user.username}/Channel/Edit`" :class="'font-weight-bold '" :style="'border-radius: 0 0 0 0.6rem;'">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="mr-2"> <path d="M21.1,4.9h-7.5l2.8-2.8c0.3-0.3,0.3-0.7,0-0.9c-0.3-0.3-0.7-0.3-0.9,0L12,4.6L8.6,1.2c-0.3-0.3-0.7-0.3-0.9,0 c-0.3,0.3-0.3,0.7,0,0.9l2.8,2.8H2.9C1.9,4.9,1,5.8,1,6.8v12.9c0,1.1,0.9,1.9,1.9,1.9h1.9v0.6c0,0.4,0.3,0.6,0.6,0.6 s0.6-0.3,0.6-0.6v-0.6h11.6v0.6c0,0.4,0.3,0.6,0.6,0.6s0.6-0.3,0.6-0.6v-0.6h2c1.1,0,1.9-0.9,1.9-1.9V6.8C23,5.8,22.1,4.9,21.1,4.9 z M17.8,18.5c0,0.4-0.3,0.6-0.6,0.6H4.2c-0.4,0-0.6-0.3-0.6-0.6V8.1c0-0.4,0.3-0.6,0.6-0.6h12.9c0.4,0,0.6,0.3,0.6,0.6V18.5z M20.4,17.2c0,0.4-0.3,0.6-0.6,0.6s-0.6-0.3-0.6-0.6v-2.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6V17.2z M19.7,12.6 c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,12.4,20.1,12.6,19.7,12.6z M19.7,10.1c-0.4,0-0.6-0.3-0.6-0.6 c0-0.4,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6C20.4,9.8,20.1,10.1,19.7,10.1z"/> <path d="M4.9,8.8h11.6v9.1H4.9V8.8z"/> </svg>
                            Channel
                        </a>
                    </h3>
                    <h3 class="mb-0">
                        <a href="#" class="font-weight-bold active text-white" style="border-radius:0 0 .6rem 0;">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="mr-1"> <path d="M12,1c3.2,0,5.8,2.8,5.2,6.1c-0.3,2.1-2.1,3.7-4.3,4.2c-3.4,0.6-6.2-1.9-6.2-5.1C6.7,3.4,8.9,1,11.9,1H12z"/> <path d="M12,13.7c-5,0-9,3.7-9.5,8.5c0,0.5,0.3,0.8,0.8,0.8c3.1,0,14.5,0,17.5,0c0.4,0,0.7-0.3,0.7-0.7 C21,17.6,17,13.9,12,13.7z"/> </svg>
                            About
                        </a>
                    </h3>
                </div>
            </div>
        </div>
        <accordion-profile :user="user"  />
    </section>
</template>

<script>
    import AccordionProfile from "../Components/AccordionProfile";
    export default {
        props:['user'],
        data(){
            return {
                is_login_view: Boolean,
                type_change_image: ''
            }
        },
        components:{
            AccordionProfile
        },
        methods:{
            windowReplaceSettings(){
                window.location.replace(`/User/Settings/${this.user.username}`)
            }
        }
    }
</script>
