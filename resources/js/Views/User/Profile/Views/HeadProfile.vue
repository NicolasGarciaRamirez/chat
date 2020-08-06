<template>
    <section class="profile">
        <div class="img-container wrap">
            <img :src="`${user.cover}`" alt="ImagePortada" class="img-portada">
            <button type="button" class="edit-cover-photo btn text-white rounded-pill mx-4" v-if="auth.token && auth.token == user.token && route_name == `/${auth.username}/Edit` || route_name == `/${auth.username}/Channel/Edit`">
                <label class="m-0 font-weight-bold" for="change-image" @click="type_change_image = 'Cover'">Edit Cover Photo
                    <i class="cil-pencil ml-2"></i>
                </label>
            </button>
            <a :href="`/${user.username}/Edit`" class="btn rounded-pill text-white function font-weight-bold border-white edit-profile-button d-md-none d-xl-none" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit` && auth.username === user.username">
                Edit Profile
                <i class="cil-pencil ml-2"></i>
            </a>
            <div :id="`follow`+user.token" class="follow-movile-button d-lg-none d-md-none mx-lg-3" @click="colorFollow(follow_type)" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit` && auth.username !== user.username">
                <button type="button" class="align-items-right border-white function follow-idle ">
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
            <img :src="`${user.avatar}`" alt="ImageProfile" class="img-profile rounded-circle cursor-pointer" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="content-primary d-md-none d-xl-none ">
                <h3 class="font-weight-bold mb-2">{{ user.profile_information && user.profile_information.artistic_name != null ? user.profile_information.artistic_name  : user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon" v-if="user.verification_date"></h3>
                <div class="d-flex">
                    <span class="text-decoration-none bg-danger text-white mr-1 font-weight-bold">{{ user.profile_information ? user.profile_information.title : 'Profile Title Not Chosen' }}</span>
                    <span class="text-decoration-none bg-white c-fifth d-flex align-items-center font-weight-bold" v-if="user.subscription_type  == 'CONTRIBUTOR'" >CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="music-red-icon" ></span>
                </div>
            </div>
            <div class="dropdown-menu bg-primary text-white pl-2" aria-labelledby="dropdownMenuProfile" v-if="auth.token && auth.token == user.token && route_name == `/${auth.username}/Edit` || route_name == `/${auth.username}/Channel/Edit`">
<!--                <a href="#" class="dropdown-item">View Image</a>-->
<!--                <a href="#" class="dropdown-item">Edit Crop</a>-->
                <label class="dropdown-item" for="change-image" @click="type_change_image = 'Profile'">
                    Change Image
                </label>
            </div>
            <input type="file" class="d-none" accept=".jpeg,.jpg,.png,.svg" id="change-image"  @change="showChangeImage">
        </div>
        <div class="head-container align-items-start mt-1 px-3">
            <div class="text-right order-lg-2 functions" v-if="auth.token == user.token">
                <a :href="`/${user.username}/Edit`" class="btn bg-black rounded-pill text-white function font-weight-bold border-white d-sm-down-none" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit`">Edit Profile <i class="cil-pencil ml-2"></i></a>
                <a href="#" class="btn bg-black rounded-pill text-white function mx-3 font-weight-bold border-white" @click="showModalShare">Share Profile <i class="cil-share  ml-2"></i></a>
                <a :href="`/${user.username}/Profile`" class="btn bg-black rounded-pill text-white function font-weight-bold border-white">Preview Profile</a>
            </div>
            <div class="order-lg-2 functions pb-2" v-if="!auth.token || auth.token != user.token">
                <img src="/images/chat.svg" alt="chat" class="svg-icon cursor-pointer">
                <img src="/images/icons/post-share.svg" alt="post-up" class="svg-icon cursor-pointer mx-lg-3">
                <div :id="`follow`+user.token" class="mx-3 d-sm-down-none" @click="colorFollow(follow_type)" >
                    <button type="button" class="align-items-right border-white follow-idle text-white">
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
                <button class="bg-primary mx-lg-3 mx-sm-n1 function-contributor" v-if="user.subscription_type === 'CONTRIBUTOR' && user.username !== auth.username" >SUPPORT
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="1rem" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M775.617,0.807c-91.897,0-177.902,44.438-234.538,118.658C484.384,45.246,398.382,0.807,306.482,0.807
                        C140.316,0.807,5.113,143.518,5.113,319.004c0,137.825,77.957,297.373,231.784,474.343
                        c118.566,136.343,247.543,241.941,284.236,271.054l19.945,15.792l19.889-15.792c36.693-29.112,165.67-134.653,284.237-271.054
                        c153.823-176.912,231.84-336.519,231.84-474.343C1077.045,143.518,941.842,0.807,775.617,0.807"/>
                     </svg>
                </button>
                <button class="bg-primary mx-lg-3 mx-sm-1 function-contributor" v-if="user.subscription_type === 'CONTRIBUTOR' && user.username !== auth.username">REWARD
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="1rem" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon">
                        <path fill="#141414" stroke="red" stroke-width="60" d="M1078.159,1.365h-508.24L3.615,515.729h353.029l-204.69,563.042l895.973-777.405H758.889L1078.159,1.365z
                        M569.919,454.482c-0.171-0.055-0.256-0.055-0.344-0.055c-0.171,0-0.256-0.055-0.427-0.055c1.544-1.828,3.175-3.627,4.55-5.564
                        C572.497,450.745,571.209,452.544,569.919,454.482 M725.56,192.275c-6.612,0.167-12.882-0.442-18.895-1.855
                        C712.678,191.25,719.032,191.833,725.56,192.275"/>
                    </svg>
                </button>
                <i class="fas fa-ellipsis-h c-third fa-2x mx-1 cursor-pointer"  id="dropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu bg-primary text-white p-2" aria-labelledby="dropdown">
                    <div class="dropdown-item cursor-pointer" >Copy Profile Link</div>
                    <a href="mailto:support@noisesahrks.com" class="dropdown-item">Report</a>
                </div>
            </div>
            <div class="d-sm-down-none">
                <h2 class="font-weight-bold mb-2">{{ user.profile_information && user.profile_information.artistic_name != null ? user.profile_information.artistic_name  : user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="check-icon" class="check-icon" v-if="user.verification_date"></h2>
                <div class="d-flex">
                    <span class="text-decoration-none p-2 bg-danger text-white mr-2 font-weight-bold">{{ user.profile_information ? user.profile_information.title : 'Profile Title Not Chosen' }}</span>
                    <span class="text-decoration-none p-2 bg-white c-fifth font-weight-bold" v-if="user.subscription_type  == 'CONTRIBUTOR'" >CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="music-red-icon" style="width: 0.8rem; margin-bottom: 0.2rem"></span>
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
                        $(`#follow`+this.user.token+` button`).addClass('follow-active').removeClass('follow-idle')
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
                    $(`#follow`+this.user.token+` button`).addClass('follow-active').removeClass('follow-idle')
                    window.location.reload()
                }
                if (res.data.unfollow) {
                    this.follow_type = 'follow'
                    Followers.set(res.data.following)
                    $(`#follow`+this.user.token+` button`).addClass('follow-idle').removeClass('follow-active')
                    window.location.reload()
                }
            }).catch(err =>{
                console.log(err)
            })
        }
    },
}
</script>
