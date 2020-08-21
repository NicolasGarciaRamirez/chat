<template>
    <section class="profile">
        <div class="img-container wrap">
            <img :src="`${user.cover}`" alt="ImagePortada" class="img-portada">
            <button type="button" class="edit-cover-photo btn text-white rounded-pill mx-4" v-if="auth.token && auth.token == user.token && route_name == `/${auth.username}/Edit` || route_name == `/${auth.username}/Channel/Edit`">
                <label class="m-0 font-weight-bold" for="change-image" @click="type_change_image = 'Cover'">Edit Cover Photo
                    <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 1242.12 1079.31" xml:space="preserve" class="svg-icon" width="1.23rem">
                         <filter id="dropshadow" height="130%">
                            <feGaussianBlur in="SourceAlpha" stdDeviation="3"></feGaussianBlur>
                                 <feOffset dx="2" dy="2" result="offsetblur"></feOffset>
                                 <feComponentTransfer>
                                <feFuncA type="linear" slope="0.5"></feFuncA>
                            </feComponentTransfer>
                                 <feMerge>
                                <feMergeNode></feMergeNode>
                                     <feMergeNode in="SourceGraphic"></feMergeNode>
                            </feMerge>
                        </filter>
                        <g id="Layer_2">
                            <g id="Layer_2-2">
                                <path d="M1188.28,269.77c61.65-49.05,71.86-138.8,22.8-200.45c-6.71-8.44-14.36-16.09-22.8-22.8
                                    c-74.35-62.02-182.42-62.02-256.77,0L128.39,744.08L0,1079.31l385.87-111.98L1188.28,269.77z M905.83,428.11L365.9,895.29
                                    L213.98,761.2l537.08-468.61L905.83,428.11z M802.41,247.66l53.49-44.94l154.78,134.09l-51.35,44.94L802.41,247.66z M982.87,90.74
                                    c44.95-36.27,109.11-36.27,154.06,0c37.23,30.4,42.76,85.21,12.37,122.44c-3.7,4.53-7.84,8.67-12.37,12.37l-77.03,67.05
                                    L905.83,158.5L982.87,90.74z M176.17,819.69l122.68,107.7l-184.02,53.49L176.17,819.69z"/>
                            </g>
                        </g>
                    </svg>
                </label>
            </button>
            <a :href="`/${user.username}/Edit`" class="btn d-flex align-items-center rounded-pill text-white function font-weight-bold border-white edit-profile-button d-md-none d-xl-none" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit` && auth.username === user.username">
                Edit Profile
                <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" viewBox="0 0 1242.12 1079.31" xml:space="preserve" class="svg-icon" width="1.23rem">
                    <filter id="dropshadow" height="130%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="3"></feGaussianBlur>
                        <feOffset dx="2" dy="2" result="offsetblur"></feOffset>
                        <feComponentTransfer>
                            <feFuncA type="linear" slope="0.5"></feFuncA>
                        </feComponentTransfer>
                        <feMerge>
                            <feMergeNode></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                    <g id="Layer_2">
                        <g id="Layer_2-2">
                            <path d="M1188.28,269.77c61.65-49.05,71.86-138.8,22.8-200.45c-6.71-8.44-14.36-16.09-22.8-22.8
                                c-74.35-62.02-182.42-62.02-256.77,0L128.39,744.08L0,1079.31l385.87-111.98L1188.28,269.77z M905.83,428.11L365.9,895.29
                                L213.98,761.2l537.08-468.61L905.83,428.11z M802.41,247.66l53.49-44.94l154.78,134.09l-51.35,44.94L802.41,247.66z M982.87,90.74
                                c44.95-36.27,109.11-36.27,154.06,0c37.23,30.4,42.76,85.21,12.37,122.44c-3.7,4.53-7.84,8.67-12.37,12.37l-77.03,67.05
                                L905.83,158.5L982.87,90.74z M176.17,819.69l122.68,107.7l-184.02,53.49L176.17,819.69z"/>
                        </g>
                    </g>
                </svg>
            </a>
            <div :id="`follow`+user.token" class="follow-movile-button d-lg-none d-md-none mx-lg-3" @click="colorFollow(follow_type)" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit` && auth.username !== user.username">
                <button type="button" class="align-items-right function follow-idle">
                    {{ follow_type === 'unfollow' ? 'FOLLOWING' : 'FOLLOW'}}
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 226.1 215.4" style="enable-background:new 0 0 226.1 215.4;" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <path class="st0" d="M224.9,82.4l-76.1-10.9l-35.6-69L78.7,71.7L2.2,83.8l55.3,54.2l-12.1,76.5l68.6-35.8l69,35.2l-13.3-76.4
                                        L224.9,82.4z M112.9,148.8L77,167.9l6.3-40L54.7,99.3L94.9,93l17.6-36l18.4,36.1L171,99l-28.6,28.6l6.7,39.9L112.9,148.8z"/>
                                </g>
                            </g>
                            <polygon class="st0" points="112.5,54.4 94,92.1 52.1,98.7 82,128.6 75.4,170.5 112.9,150.5 150.8,170.1 143.8,128.3 173.7,98.4
                                131.7,92.2 	"/>
                        </g>
                    </svg>
                </button>
            </div>
            <img :src="`${user.avatar}`" alt="ImageProfile" class="img-profile rounded-circle cursor-pointer" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="content-primary d-xl-none d-lg-none">
                <h3 class="font-weight-bold mb-2">{{ user.profile_information && user.profile_information.artistic_name != null ? user.profile_information.artistic_name  : user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="icon-check" class="icon-check" v-if="user.verification_date"></h3>
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
        <div class="head-container align-items-start mt-1 px-1">
            <div class="text-right order-lg-2 functions mt-lg-1" v-if="auth.token == user.token">
                <a :href="`/${user.username}/Edit`" class="btn d-flex align-items-center rounded-pill function font-weight-bold border-white d-sm-down-none" v-if="route_name !== `/${auth.username}/Edit` && route_name !== `/${auth.username}/Channel/Edit`">
                    Edit Profile
                    <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 1242.12 1079.31" xml:space="preserve" class="svg-icon" width="1.23rem">
                        <g id="Layer_2">
                            <g id="Layer_2-2">
                                <path d="M1188.28,269.77c61.65-49.05,71.86-138.8,22.8-200.45c-6.71-8.44-14.36-16.09-22.8-22.8
                                    c-74.35-62.02-182.42-62.02-256.77,0L128.39,744.08L0,1079.31l385.87-111.98L1188.28,269.77z M905.83,428.11L365.9,895.29
                                    L213.98,761.2l537.08-468.61L905.83,428.11z M802.41,247.66l53.49-44.94l154.78,134.09l-51.35,44.94L802.41,247.66z M982.87,90.74
                                    c44.95-36.27,109.11-36.27,154.06,0c37.23,30.4,42.76,85.21,12.37,122.44c-3.7,4.53-7.84,8.67-12.37,12.37l-77.03,67.05
                                    L905.83,158.5L982.87,90.74z M176.17,819.69l122.68,107.7l-184.02,53.49L176.17,819.69z"/>
                            </g>
                        </g>
                    </svg>
                </a>
                <a href="#" class="btn d-flex align-items-center rounded-pill function mx-3 font-weight-bold border-white" @click="showModalShare">
                    Share Profile
                    <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 966 1080" xml:space="preserve" class="cursor-pointer share-icon ml-2" @click="showModalShare">
                        <g id="Layer_2">
                            <g id="Layer_2-2">
                                <path d="M974,539.86L568.89-0.29v321.93h-85.88c-266.92,0-483.29,263.11-483.29,587.68c0,0,0,0,0,0V1080
                                    l38.5-51.13C168.2,855.96,351.95,757.44,544.6,757.35h24.28V1080L974,539.86z"/>
                            </g>
                        </g>
                    </svg>
                </a>
                <a :href="`/${user.username}/Profile`" class="btn rounded-pill function font-weight-bold border-white text-center">
                    Preview Profile
                </a>
            </div>
            <div class="order-lg-2 functions pb-2 mt-lg-1" v-if="!auth.token || auth.token != user.token">
<!--                <img src="/images/chat.svg" alt="chat" class="svg-icon cursor-pointer">-->
                <svg version="1.1" baseProfile="tiny" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     x="0px" y="0px" viewBox="0 0 966 1080" xml:space="preserve" class="svg-icon cursor-pointer share mx-lg-2" @click="showModalShare">
                    <g id="Layer_2">
                        <g id="Layer_2-2">
                            <path fill="#535353" d="M974,539.86L568.89-0.29v321.93h-85.88c-266.92,0-483.29,263.11-483.29,587.68c0,0,0,0,0,0V1080
                                l38.5-51.13C168.2,855.96,351.95,757.44,544.6,757.35h24.28V1080L974,539.86z"/>
                        </g>
                    </g>
                </svg>
                <div :id="`follow`+user.token" class="mx-3 d-sm-down-none" @click="!disable_follow ? storeFollow(follow_type) : ''" >
                    <button type="button" class="align-items-right follow-idle text-white">
                        {{ follow_type === 'unfollow' ? 'FOLLOWING' : 'FOLLOW'}}
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 226.1 215.4" style="enable-background:new 0 0 226.1 215.4;" xml:space="preserve">
                            <g>
                                <g>
                                    <g>
                                        <filter id="dropshadow" height="130%"> <feGaussianBlur in="SourceAlpha" stdDeviation="3"/> <!-- stdDeviation is how much to blur --> <feOffset dx="2" dy="2" result="offsetblur"/> <!-- how much to offset --> <feMerge> <feMergeNode/> <!-- this contains the offset blurred image --> <feMergeNode in="SourceGraphic"/> <!-- this contains the element that the filter is applied to --> </feMerge> </filter>
                                        <path class="st0" d="M224.9,82.4l-76.1-10.9l-35.6-69L78.7,71.7L2.2,83.8l55.3,54.2l-12.1,76.5l68.6-35.8l69,35.2l-13.3-76.4
				                        L224.9,82.4z M112.9,148.8L77,167.9l6.3-40L54.7,99.3L94.9,93l17.6-36l18.4,36.1L171,99l-28.6,28.6l6.7,39.9L112.9,148.8z"/>
                                    </g>
                                </g>
                                <polygon class="st0" points="112.5,54.4 94,92.1 52.1,98.7 82,128.6 75.4,170.5 112.9,150.5 150.8,170.1 143.8,128.3 173.7,98.4
		                            131.7,92.2 	"/>
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
            <div class="d-md-down-none">
                <h2 class="font-weight-bold mb-2">{{ user.profile_information && user.profile_information.artistic_name != null ? user.profile_information.artistic_name  : user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="icon-check" class="icon-check" v-if="user.verification_date"></h2>
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
            route_name: window.location.pathname,
            disable_follow: false
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
            this.img = URL.createObjectURL(w.target.files[0])
            $('#ModalChangeImage').modal('show')
        },
        getFollow(){
            if(this.user.followers){
                this.user.followers.map(follow =>{
                    if (follow.user.username === Auth.state.username) {
                        $(`#follow`+this.user.token+` button`).addClass('follow-active').removeClass('follow-idle')
                        this.follow_type = 'unfollow'
                    }
                })
            }
        },
        storeFollow(type){
            if (Auth.state.token) {
                this.disable_follow = true
                let request = ''
                if (type === 'follow') {
                    if (Auth.state.username) {
                        this.follow.type = 'Followed'
                    }else{
                        this.follow.type = 'Follower'
                    }
                    request = this.follow
                    this.url = `/${Auth.state.username}/Follow/follow/${this.user.id}`
                }
                if (type === 'unfollow') {
                    request = this.follow
                    if (this.user.followers) {
                        this.user.followers.map(follow =>{
                            if (Auth.state.username === follow.user.username) {
                                this.url = `/${Auth.state.username}/Follow/unfollow/${follow.id}`
                            }
                        })
                    }
                }
                axios.post(this.url, request).then(res =>{
                    this.disable_follow = false
                    if (res.data.follow) {
                        this.user.followers.push(res.data.follow)
                        this.follow_type = 'unfollow'
                        this.$root.$refs.AppNav.followings = res.data.followings
                        this.$root.$refs.modalRelathion.followings = []
                        _.each(res.data.followings, following =>{
                            this.$root.$refs.modalRelathion.followings.push(following.following)
                        })
                        $(`#follow`+this.user.token+` button`).addClass('follow-active').removeClass('follow-idle')
                    }
                    if (res.data.unfollow) {
                        this.follow_type = 'follow'
                        $(`#follow`+this.user.token+` button`).addClass('follow-idle').removeClass('follow-active')
                        this.$root.$refs.AppNav.followings = res.data.followings
                        this.$root.$refs.modalRelathion.followings = []
                        _.each(res.data.followings, following =>{
                            this.$root.$refs.modalRelathion.followings.push(following.following)
                        })
                    }
                }).catch(err =>{
                    this.disable_follow = false
                })
            }else{
                $('#ModalLogin').modal('show')
            }
        }
    },
}
</script>
