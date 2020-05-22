<template>
<section class="profile">
    <div class="img-container">
        <img :src="`/images/${user.cover}`" alt="ImagePortada" class="img-portada img-fluid">
        <button class="edit-cover-photo btn text-white rounded-pill mr-5" @click="showChangeImageCover" v-if="auth">Edit Cover Photo <i class="cil-pencil ml-2"></i></button>
        <div v-if="!auth" class="btn my-2"></div>
        <img :src="`/images/${user.avatar}`" alt="ImageProfile" class="img-profile rounded-circle" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu bg-primary text-white dowpdown-menu-profile" aria-labelledby="dropdownMenuProfile" v-if="auth">
            <a href="#" class="dropdown-item">View Image</a>
            <a href="#" class="dropdown-item">Edit Crop</a>
            <a class="dropdown-item" @click="showChangeImageProfile">Change Image</a>
        </div>
    </div>
    <div class="head-container align-items-center" style="transform: translateY(-2rem)">
        <div class="text-right d-flex justify-content-between align-items-center order-lg-2 functions pb-2" v-if="auth">
            <a :href="`/${user.username}/Edit`" class="btn bg-black rounded-pill text-white">Edit Profile <i class="cil-pencil ml-2"></i></a>
            <a href="#" class="btn bg-black rounded-pill text-white mx-3">Share Profile <i class="cil-share  ml-2"></i></a>
            <a :href="`/${ user.username}/Profile/Releases`" class="btn bg-black rounded-pill text-white">Preview Profile</a>
        </div>
        <div class="text-right d-flex justify-content-end align-items-center order-lg-2 functions pb-2" v-if="!auth">
            <img src="/images/chat.svg" alt="chat" class="icon mr-3">
            <img src="/images/icons/post-up.svg" alt="post-up" class="icon mr-3">
            <a href="#" class="btn bg-black rounded-pill mr-2 text-white">FOLLOW<img class="icon ml-2" src="/images/icons/star.svg"></a>
            <i class="fas fa-ellipsis-h c-third fa-2x"></i>
        </div>
        <div>
            <h2 class="font-weight-bold">{{ user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon"></h2>
            <div class="d-flex">
                <a href="#" class="btn bg-danger text-white mr-3">{{ user.personal_information.title }}</a>
                <a v-if="user.subscription_type  == 'CONTRIBUTOR'" href="#" class="btn bg-white c-fifth">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="music-red-icon" ></a>
            </div>
        </div>
    </div>

    <modal-change-image-cover :user="user" />
    <modal-change-image-profile :user="user"/>
</section>
</template>

<script>
import ModalChangeImageProfile from './include/ModalChangeImageProfile'
import ModalChangeImageCover from './include/ModalChangeImageCover'
import Auth from '../../../helpers/Auth'
export default {
    props:['user'],
    data(){
        return {
            auth: false
        }
    },
    mounted(){
        this.getAuth()
    },
    components:{
        ModalChangeImageProfile,
        ModalChangeImageCover
    },
    methods: {
        showChangeImageProfile(){
            $('#ModalChangeImageProfile').modal('show')
        },
        showChangeImageCover(){
            $('#ModalChangeImageCover').modal('show')
        },
        getAuth(){
            this.auth = Auth.getAuthUser()
        }
    },
}
</script>
