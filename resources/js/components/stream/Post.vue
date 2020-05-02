<template>
    <section class="post mt-3">
        <div class="post-head bg-primary p-2 d-md-flex align-items-start justify-content-between">
            <div class="d-flex justify-content-between align-items-center post-user-actions order-md-2">
                <button class="bg-primary">FOLLOW <img src="/images/icons/star.svg" class="icon c-fifth ml-1"></button>
                <button v-if="user.suscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger" @click="showModalSupport">SUPPORT <img src="/images/icons/heart.svg" class="ml-1"></button>
                <button v-if="user.suscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger" @click="showModalReward">REWARD <img src="/images/icons/lightning.svg" class="ml-1"></button>
                <i class="fas fa-ellipsis-h c-third fa-2x mr-1"  id="dropdownMenuPost"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu bg-primary text-white dowpdown-menu-post" aria-labelledby="dropdownMenuPost">
                    <a href="#" class="dropdown-item">Go To User Profile</a>
                    <a href="#" class="dropdown-item">Message User</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Go To Post</a>
                    <a href="#" class="dropdown-item">Copy Link</a>
                    <a href="#" class="dropdown-item">Hide Post</a>
                    <a href="#" class="dropdown-item">Report</a>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <img src="/images/profile.jpg" alt="" class="post-user-image rounded-pill">
                <div class="d-flex flex-column pl-md-2">
                    <a :href="`/View/Profile/Releases/${user.id}`" class="text-white post-user-name">{{ user.full_name }} <img src="/images/icons/check.svg" alt="" class="check-icon"></a>
                    <div class="d-flex justify-content-center align-items-center post-user-type mt-2">
                        <button class="btn bg-fifth text-white mr-2">MIXING ENGENIERY</button>
                        <button v-if="user.suscription_type == 'CONTRIBUTOR'" class="btn bg-white c-fifth d-flex align-items-center justify-content-center">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-body bg-primary">
            <div class="text p-2">
                {{ post.description }} <span class="c-fifth">#mixingengineer</span> <span class="c-fifth">#m</span>... See More..
            </div>
            <div class="d-flex flex-column mt-1 content">
                <img :src="`/images/post/${ post.image }`"  alt="img-post">
            </div>
            <div class="mt-2 bg-primary post-footer p-2">
                <div>
                    <span class="c-fourth">11k views</span>
                    <span class="ml-1 c-fourth">10m ago</span>
                </div>
                <div class="d-flex c-fourth my-3">
                    <div class="information"><img src="/images/icons/post-percentage-up.svg" alt=""><span>100</span></div>
                    <div class="information"><img src="/images/icons/post-percentage-down-red.svg" alt=""><span class="c-fifth">100</span></div>
                    <div class="information" @click="showModalRegister"><img src="/images/icons/post-flame.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-comment.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-up.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-down.svg" alt="">100</div>
                </div>
            </div>
        </div>
        <comments />
        <modal-support />
        <modal-reward /> 
        <register />
    </section>
</template>

<script>
    import Comments from './comments/Comments'
    import ModalReward from './ModalReward'
    import ModalSupport from './ModalSupport'
    import Register from '../auth/Register'
    
    export default {
        props:['post'],
        data(){
            return {
                user:""
            }
        },
        components:{
            Comments,
            ModalSupport,
            ModalReward,
            Register
        },
        mounted(){
            this.getUserPost()
        },
        methods:{
            showModalSupport(){
                $('#modalSupport').modal('show')
            },
            showModalReward(){
                $('#modalReward').modal('show')
            },
            showModalRegister(){
                $('#ModalRegister').modal('show')
            },
            async getUserPost(){
                await axios.get(`/View/Post/get/${this.post.user_id}`).then(res => {
                    console.log(res)
                    this.user = res.data.user
                })
            }
        }
    }
</script>
