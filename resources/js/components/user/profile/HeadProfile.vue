<template>
    <section class="profile">
        <div class="img-container wrap">
            <img :src="`${user.cover}`" alt="ImagePortada" class="img-portada">
            <button class="edit-cover-photo btn text-white rounded-pill mr-5 pt-0 pb-0 pl-3 pr-3" @click="showChangeImage" v-if="auth.token && auth.token == user.token">
                <label class="mb-0" @click="type_change_image = 'Cover'">Edit Cover Photo </label>
                <i class="cil-pencil ml-2"></i>
            </button>
            <div  class="btn my-2"></div>
            <img :src="`${user.avatar}`" alt="ImageProfile" class="img-profile rounded-circle cursor-pointer" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu bg-primary text-white dowpdown-menu-profile" aria-labelledby="dropdownMenuProfile" v-if="auth.token && auth.token == user.token">
                <a href="#" class="dropdown-item">View Image</a>
                <a href="#" class="dropdown-item">Edit Crop</a>
                <a class="dropdown-item" @click="showChangeImage">
                    <label @click="type_change_image = 'Profile'"> Change Image</label>
                </a>
            </div>
        </div>
        <div class="head-container align-items-center" style="transform: translateY(-2rem)">

            <div class="text-right d-flex justify-content-between align-items-center order-lg-2 functions pb-2" v-if="auth.token == user.token">
                <a :href="`/${user.username}/Edit`" class="btn bg-black rounded-pill text-white">Edit Profile <i class="cil-pencil ml-2"></i></a>
                <a href="#" class="btn bg-black rounded-pill text-white mx-3">Share Profile <i class="cil-share  ml-2"></i></a>
                <a :href="`/${ user.username}/Profile/WorkHistory`" class="btn bg-black rounded-pill text-white">Preview Profile</a>
            </div>

            <div class="text-right d-flex justify-content-end align-items-center order-lg-2 functions pb-2" v-if="!auth.token || auth.token != user.token">
                <img src="/images/chat.svg" alt="chat" class="icon mr-3">
                <img src="/images/icons/post-up.svg" alt="post-up" class="icon mr-3">
                <div :id="`follow`+user.token" @click="colorFollow(follow_type)">
                    <a class="btn rounded-pill bg-primary align-items-center justify-content-center font-weight-bold border-white pt-0 pb-0">
                        <div class="pt-0 pb-0 pl-1 pr-1">
                            <label class="m-1">FOLLOW</label>
                            <img src="/images/icons/star.svg" class="c-fifth ml-2 mb-1" width="15" height="18">
                        </div> 
                    </a>
                </div>
                <i class="fas fa-ellipsis-h c-third fa-2x"></i>
            </div>
            <div>
                <h2 class="font-weight-bold">{{ user.profile_information && user.profile_information.artistic_name != null ? user.profile_information.artistic_name  : user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon"></h2>
                <div class="d-flex">
                    <a href="#" class="btn bg-danger text-white mr-3">{{ user.profile_information ? user.profile_information.title : 'N/A' }}</a>
                    <a v-if="user.subscription_type  == 'CONTRIBUTOR'" href="#" class="btn bg-white c-fifth">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="music-red-icon" ></a>
                </div>
            </div>
        </div>
        <modal-change-image />
        <modal-login />
    </section>
</template>

<script>
import ModalChangeImage from './include/ModalChangeImage'
import ModalLogin from '../../auth/Login'
import Auth from '../../../helpers/Auth'
export default {
    props:['user'],
    data(){
        return {
            type_change_image: 'Profile',
            auth: Auth.state,
            follow_type: 'follow',
            follow:'',
        }
    },
    mounted(){
        Auth.initialize()
        this.getFollow()
    },
    components:{
        ModalChangeImage,
        ModalLogin
    },
    methods: {
        showChangeImage(){
            $('#ModalChangeImage').modal('show')
        },
        getFollow(){
            if(this.user.followers){
                this.user.followers.map(follow =>{
                    if (follow.user.username == this.auth.username) {
                        $(`#follow`+this.user.token+` a`).replaceWith('<a class="btn rounded-pill bg-primary align-items-center justify-content-center font-weight-bold border-white active pt-0 pb-0"><div class="pt-0 pb-0 pl-1 pr-1"><label class="m-1">FOLLOW</label><img src="/images/icons/star.svg" class="c-fifth mb-1 ml-1" width="17" height="18"></div></a>')
                        this.follow_type = 'unfollow'
                    }
                })
            }
        },
        colorFollow(type){
            if (Auth.state.token) {
                if (type == 'follow') {
                    $(`#follow`+this.user.token+` a`).replaceWith('<a class="btn rounded-pill bg-primary align-items-center justify-content-center font-weight-bold border-white active pt-0 pb-0"><div class="pt-0 pb-0 pl-1 pr-1"><label class="m-1">FOLLOW</label><img src="/images/icons/star.svg" class="c-fifth mb-1 ml-1" width="17" height="18"></div></a>')
                    this.store(type)
                } else if (type == 'unfollow') {
                    $(`#follow`+this.user.token+` a`).replaceWith('<a class="btn rounded-pill bg-primary align-items-center justify-content-center font-weight-bold border-white pt-0 pb-0"><div class="pt-0 pb-0 pl-1 pr-1"><label class="m-1">FOLLOW</label><img src="/images/icons/star.svg" class="c-fifth mb-1 ml-1" width="17" height="18"></div></a>')
                    this.store(type)
                }
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        store(type){
            var request = ''
            if (type == 'follow') {
                request = this.follow
                this.url = `/${Auth.state.username}/Follow/follow/${this.post.user.id}`
            }
            if (type == 'unfollow') {
                request = this.follow
                if (this.user.followers) {
                    this.user.followers.map(follow =>{
                        if (Auth.state.username == follow.user.username) {
                            this.url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                        }
                    })
                }
            }
            axios.post(this.url, request).then(res =>{
                if (res.data.follow) {
                    this.user.followers.push(res.data.follow)
                    this.follow_type = 'unfollow'
                }
                if (res.data.unfollow) {
                    this.follow_type = 'follow'
                }
            }).catch(err =>{
                console.log(err)
            })
        }
    },
}
</script>
