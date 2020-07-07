<template>
    <section class="profile">
        <div class="img-container wrap">
            <img :src="`${user.cover}`" alt="ImagePortada" class="img-portada">
            <button class="edit-cover-photo btn text-white rounded-pill mr-5 pt-0 pb-0 pl-3 pr-3" @click="showChangeImage" v-if="auth.token && auth.token == user.token && route_name == `/${auth.username}/Edit`">
                <label class="mb-0 font-weight-bol" @click="type_change_image = 'Cover'">Edit Cover Photo </label>
                <i class="cil-pencil ml-2"></i>
            </button>
            <div  class="btn my-2"></div>
            <img :src="`${user.avatar}`" alt="ImageProfile" class="img-profile rounded-circle cursor-pointer" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu bg-primary text-white" aria-labelledby="dropdownMenuProfile" v-if="auth.token && auth.token == user.token && route_name == `/${auth.username}/Edit`">
                <a href="#" class="dropdown-item">View Image</a>
                <a href="#" class="dropdown-item">Edit Crop</a>
                <label class="dropdown-item" for="change-image">
                    Change Image
                </label>
                <input type="file" class="d-none" accept=".jpge,.jpg,.png" id="change-image"  @change="showChangeImage">
            </div>
        </div>
        <div class="head-container align-items-center" style="transform: translateY(-2rem)">

            <div class="text-right d-flex justify-content-between align-items-center order-lg-2 functions pb-2" v-if="auth.token == user.token">
                <a :href="`/${user.username}/Edit`" class="btn bg-black rounded-pill text-white function font-weight-bold border-white" v-if="route_name != `/${auth.username}/Edit`">Edit Profile <i class="cil-pencil ml-2"></i></a>
                <a href="#" class="btn bg-black rounded-pill text-white function mx-3 font-weight-bold border-white">Share Profile <i class="cil-share  ml-2"></i></a>
                <a :href="`/${ user.username}/Profile/WorkHistory`" class="btn bg-black rounded-pill text-white function font-weight-bold border-white">Preview Profile</a>
            </div>

            <div class="text-right d-flex justify-content-end align-items-center order-lg-2 functions pb-2" v-if="!auth.token || auth.token != user.token">
                <img src="/images/chat.svg" alt="chat" class="icon cursor-pointer">
                <img src="/images/icons/post-up.svg" alt="post-up" class="icon cursor-pointer mx-3">
                <div :id="`follow`+user.token" class="mx-3" @click="colorFollow(follow_type)" >
                    <button type="button" class="bg-primary align-items-right border-white function">
                        <svg version="1.2" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px" viewBox="0 0 1179 1080" xml:space="preserve" width="1rem" class="ml-2 mb-1">
                            <g id="Layer_2">
                                <g id="Layer_2-2">
                                    <path fill="#141414" d="M1179,407.04l-402.88-55.63L587.74,0L404.99,352.76L0,414.5L292.81,690.6L228.6,1080l363.37-182.49
                                        l365.48,179.1L886.9,687.89L1179,407.04z"  stroke="white" stroke-width="2em"/>
                                </g>
                            </g>
                        </svg>
                    </button>
                </div>
                <i class="fas fa-ellipsis-h c-third fa-2x mr-1 cursor-pointer"  id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu bg-primary text-white p-2" aria-labelledby="dropdown">
                    <div class="dropdown-item cursor-pointer" >Copy Profile Link</div>
                    <a href="mailto:support@noisesahrks.com" class="dropdown-item">Report</a>
                </div>
            </div>
            <div>
                <h2 class="font-weight-bold">{{ user.profile_information && user.profile_information.artistic_name != null ? user.profile_information.artistic_name  : user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon"></h2>
                <div class="d-flex">
                    <a href="#" class="btn bg-danger text-white mr-3 font-weight-bold">{{ user.profile_information ? user.profile_information.title : 'Profile Title Not Chosen' }}</a>
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
            img:'',
            type_change_image: 'Profile',
            auth: Auth.state,
            follow_type: 'follow',
            follow:{
                type: ''
            },
            route_name: window.location.pathname
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
        showChangeImage(w){
            var input = w.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.imageData = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
            $('#ModalChangeImage').modal('show')
        },
        getFollow(){
            if(this.user.followers){
                this.user.followers.map(follow =>{
                    if (follow.user.username == Auth.state.username) {
                        $(`#follow`+this.user.token+` button`).addClass('function-active').removeClass('function')
                        this.follow_type = 'unfollow'
                    }
                })
            }
        },
        colorFollow(type){
            if (Auth.state.token) {
                if (type == 'follow') {
                    $(`#follow`+this.user.token+` button`).addClass('function-active').removeClass('function')
                    this.store(type)
                } else if (type == 'unfollow') {
                    $(`#follow`+this.user.token+` button`).addClass('function').removeClass('function-active')
                    this.store(type)
                }
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        store(type){
            var request = ''
            if (type == 'follow') {
                if (Auth.state.username) {
                    this.follow.type = 'Followed'
                }else{
                    this.follow.type = 'Follower'
                }
                request = this.follow
                this.url = `/${Auth.state.username}/Follow/follow/${this.user.id}`
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
