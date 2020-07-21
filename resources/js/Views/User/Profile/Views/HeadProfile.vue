<template>
    <section class="profile">
        <div class="img-container wrap">
            <img :src="`${user.cover}`" alt="ImagePortada" class="img-portada">
            <button type="button" class="edit-cover-photo btn text-white rounded-pill mx-2 w-10" v-if="auth.token && auth.token == user.token && route_name == `/${auth.username}/Edit`">
                <label class="m-0 font-weight-bold" for="change-image" @click="type_change_image = 'Cover'">Edit Cover Photo
                    <i class="cil-pencil ml-2"></i>
                </label>
            </button>
            <img :src="`${user.avatar}`" alt="ImageProfile" class="img-profile rounded-circle cursor-pointer" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu bg-primary text-white" aria-labelledby="dropdownMenuProfile" v-if="auth.token && auth.token == user.token && route_name == `/${auth.username}/Edit`">
<!--                <a href="#" class="dropdown-item">View Image</a>-->
<!--                <a href="#" class="dropdown-item">Edit Crop</a>-->
                <label class="dropdown-item" for="change-image" @click="type_change_image = 'Profile'">
                    Change Image
                </label>
            </div>
            <input type="file" class="d-none" accept=".jpeg,.jpg,.png,.svg" id="change-image"  @change="showChangeImage">
        </div>
        <div class="head-container align-items-center">
            <div class="text-right d-flex justify-content-between align-items-center order-lg-2 functions pb-2" v-if="auth.token == user.token">
                <a :href="`/${user.username}/Edit`" class="btn bg-black rounded-pill text-white function font-weight-bold border-white" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit`">Edit Profile <i class="cil-pencil ml-2"></i></a>
                <a href="#" class="btn bg-black rounded-pill text-white function mx-3 font-weight-bold border-white" @click="showModalShare">Share Profile <i class="cil-share  ml-2"></i></a>
                <a :href="`/${ user.username}/Profile`" class="btn bg-black rounded-pill text-white function font-weight-bold border-white">Preview Profile</a>
            </div>
            <div class="text-right d-flex justify-content-end align-items-center order-lg-2 functions pb-2" v-if="!auth.token || auth.token != user.token">
                <img src="/images/chat.svg" alt="chat" class="icon cursor-pointer">
                <img src="/images/icons/post-up.svg" alt="post-up" class="icon cursor-pointer mx-3">
                <div :id="`follow`+user.token" class="mx-3" @click="colorFollow(follow_type)" >
                    <button type="button" class="bg-primary align-items-right border-white function ">
                        {{ follow_type === 'unfollow' ? 'FOLLOWING' : 'FOLLOW'}}
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
                <h2 class="font-weight-bold mb-3">{{ user.profile_information && user.profile_information.artistic_name != null ? user.profile_information.artistic_name  : user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon" v-if="user.verification_date"></h2>
                <div class="d-flex">
                    <a href="#" class="btn bg-danger rounded-pill text-white mr-3 font-weight-bold">{{ user.profile_information ? user.profile_information.title : 'Profile Title Not Chosen' }}</a>
                    <a href="#" class="btn bg-white rounded-pill c-fifth" v-if="user.subscription_type  == 'CONTRIBUTOR'" >CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="music-red-icon" ></a>
                </div>
            </div>
        </div>
        <modal-change-image />
        <modal-login />
        <modal-share-profile :user="user"></modal-share-profile>
    </section>
</template>

<script>
import ModalChangeImage from "../Components/Includes/ModalChangeImage";
import ModalShareProfile from "../Components/Includes/ModalShareProfile";
import ModalLogin from '../../../Auth/Components/Login';
import Auth from "../../../../helpers/Auth";
import Followers from "../../../../helpers/Followers";

export default {
    props:['user'],
    data(){
        return {
            img:null,
            resource:'',
            type_change_image: '',
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
        ModalLogin,
        ModalShareProfile
    },
    methods: {
        showModalShare(){
            $('#ModalShareProfile').modal('show')
        },
        showChangeImage(w){
            let input = w.target;
            this.resource = w.target.files[0]
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.img = e.target.result;
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
                    this.storeFollow(type)
                } else if (type == 'unfollow') {
                    this.storeFollow(type)
                }
            }else{
                $('#ModalLogin').modal('show')
            }
        },
        storeFollow(type){
            let request = ''
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
                    Followers.set(res.data.following)
                    $(`#follow`+this.user.token+` button`).addClass('function-active').removeClass('function')
                    window.location.reload()
                }
                if (res.data.unfollow) {
                    this.follow_type = 'follow'
                    Followers.set(res.data.following)
                    $(`#follow`+this.user.token+` button`).addClass('function').removeClass('function-active')
                    window.location.reload()
                }
            }).catch(err =>{
                console.log(err)
            })
        }
    },
}
</script>
