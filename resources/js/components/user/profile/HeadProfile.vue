<template>
<section>
    <div class="img-container">
        <img src="/images/portada.jpg" alt="ImagePortada" class="img-portada img-fluid">
        <button class="edit-cover-photo btn text-white rounded-pill mr-5">Edit Cover Photo <i class="cil-pencil ml-2"></i></button>
        <img src="/images/profile.jpg" alt="ImagePortada" class="img-profile rounded-circle" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu bg-primary text-white dowpdown-menu-profile" aria-labelledby="dropdownMenuProfile">
            <a href="#" class="dropdown-item">View Image</a>
            <a href="#" class="dropdown-item">Edit Crop</a>
            <a class="dropdown-item" @click="showChangeImageProfile">Change Image</a>
        </div>
    </div>
    <div class="head-container align-items-center" style="transform: translateY(-2rem)">
        <div class="text-right d-flex justify-content-between align-items-center order-lg-2 functions pb-2">
            <a href="/Profile/Edit" class="btn bg-black rounded-pill text-white">Edit Profile <i class="cil-pencil ml-2"></i></a>
            <a href="#" class="btn bg-black rounded-pill text-white mx-3">Share Profile <i class="cil-share  ml-2"></i></a>
            <a :href="`/View/Profile/Releases/${ user.user_name }`" class="btn bg-black rounded-pill text-white">Preview Profile</a>
        </div>
        <div>
            <h2 class="font-weight-bold">{{ user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon"></h2>
            <div class="d-flex">
                <a href="#" class="btn bg-danger text-white mr-3">{{ user.personal_information.title }}</a>
                <a v-if="user.suscription_type  == 'CONTRIBUTOR'" href="#" class="btn bg-white c-fifth">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="music-red-icon" ></a>
            </div>
        </div>
    </div>
    <ModalChangeImageProfile />
</section>
</template>

<script>
import ModalChangeImageProfile from './include/ModalChangeImageProfile'
export default {
    props:['user'],
    components:{
        ModalChangeImageProfile
    },
    methods: {
        showChangeImageProfile(){
            $('#ModalChangeImageProfile').modal('show')
        }
    },
}
</script>