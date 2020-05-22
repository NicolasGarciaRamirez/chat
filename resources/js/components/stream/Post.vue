<template>
    <section class="post mt-3">
        <div class="post-head bg-primary p-3 d-md-flex align-items-start justify-content-between">
            <div class="d-flex justify-content-between align-items-center post-user-actions order-md-2">
                <button class="bg-primary align-items-right border-white">FOLLOW 
                    <img src="/images/icons/star.svg" class="c-fifth ml-2">
                </button>
                <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger d-sm-down-none " @click="showModalSupport">SUPPORT 
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="23px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-2">
                    <path fill="#141414" stroke="red" stroke-width="60" d="M775.617,0.807c-91.897,0-177.902,44.438-234.538,118.658C484.384,45.246,398.382,0.807,306.482,0.807
                        C140.316,0.807,5.113,143.518,5.113,319.004c0,137.825,77.957,297.373,231.784,474.343
                        c118.566,136.343,247.543,241.941,284.236,271.054l19.945,15.792l19.889-15.792c36.693-29.112,165.67-134.653,284.237-271.054
                        c153.823-176.912,231.84-336.519,231.84-474.343C1077.045,143.518,941.842,0.807,775.617,0.807"/>
                    </svg>
                </button>
                <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger d-sm-down-none " @click="showModalReward">REWARD 
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="15px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-2">
                    <path fill="#141414" stroke="red" stroke-width="60" d="M1078.159,1.365h-508.24L3.615,515.729h353.029l-204.69,563.042l895.973-777.405H758.889L1078.159,1.365z
                        M569.919,454.482c-0.171-0.055-0.256-0.055-0.344-0.055c-0.171,0-0.256-0.055-0.427-0.055c1.544-1.828,3.175-3.627,4.55-5.564
                        C572.497,450.745,571.209,452.544,569.919,454.482 M725.56,192.275c-6.612,0.167-12.882-0.442-18.895-1.855
                        C712.678,191.25,719.032,191.833,725.56,192.275"/>
                    </svg>
                </button>
                <i class="fas fa-ellipsis-h c-third fa-2x mr-1"  id="dropdownMenuPost"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu bg-primary text-white dowpdown-menu-post p-2" aria-labelledby="dropdownMenuPost">
                    <a href="#" class="dropdown-item">Go To User Profile</a>
                    <a href="#" class="dropdown-item">Message User</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Go To Post</a>
                    <a href="#" class="dropdown-item">Copy Link</a>
                    <a href="#" class="dropdown-item">Hide Post</a>
                    <a href="#" class="dropdown-item">Report</a>
                    <a href="#" class="dropdown-item">Add To Playlist</a>
                </div>
            </div>
            <div class="d-flex align-items-start">
                <img :src="`/images/${post.user.avatar}`" alt="" class="post-user-image rounded-pill">
                <div class="d-flex flex-column pl-md-3">
                    <a :href="`/${post.user.username}/Profile/Releases`" class="text-white post-user-name">{{ post.user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="" class="check-icon"></a>
                    <div class="d-flex align-items-center post-user-type mt-2">
                        <button class="btn bg-fifth text-white mr-2">{{ post.user.personal_information.title }}</button>
                        <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="btn bg-white c-fifth d-flex align-items-center justify-content-center">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-body bg-primary">
            <div class="text p-3">
                {{ post.description }} <span class="c-fifth">#mixingengineer</span> <span class="c-fifth">#m</span>... See More..
            </div>
            <div class="d-flex flex-column mt-1 content img-fluid">
                <img :src="`/images/post/${ post.image }`"  alt="img-post" class="img-fluid cursor-point">
            </div>
            <div class="d-flex flex-row justify-content-between align-items-center pt-2 post-user-actions d-block d-xl-none d-md-none">
                 <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger mx-2  w-100" @click="showModalSupport">SUPPORT 
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="18px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-3">
                    <path fill="#141414" stroke="red" stroke-width="60" d="M775.617,0.807c-91.897,0-177.902,44.438-234.538,118.658C484.384,45.246,398.382,0.807,306.482,0.807
                        C140.316,0.807,5.113,143.518,5.113,319.004c0,137.825,77.957,297.373,231.784,474.343
                        c118.566,136.343,247.543,241.941,284.236,271.054l19.945,15.792l19.889-15.792c36.693-29.112,165.67-134.653,284.237-271.054
                        c153.823-176.912,231.84-336.519,231.84-474.343C1077.045,143.518,941.842,0.807,775.617,0.807"/>
                    </svg>
                </button>
                <button v-if="post.user.subscription_type == 'CONTRIBUTOR'" class="bg-primary border-danger mx-2 w-100" @click="showModalReward">REWARD 
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="15px" height="18px" viewBox="0 0 1078.387 1080" enable-background="new 0 0 1078.387 1080" xml:space="preserve" class="svg-icon ml-3">
                    <path fill="#141414" stroke="red" stroke-width="60" d="M1078.159,1.365h-508.24L3.615,515.729h353.029l-204.69,563.042l895.973-777.405H758.889L1078.159,1.365z
                        M569.919,454.482c-0.171-0.055-0.256-0.055-0.344-0.055c-0.171,0-0.256-0.055-0.427-0.055c1.544-1.828,3.175-3.627,4.55-5.564
                        C572.497,450.745,571.209,452.544,569.919,454.482 M725.56,192.275c-6.612,0.167-12.882-0.442-18.895-1.855
                        C712.678,191.25,719.032,191.833,725.56,192.275"/>
                    </svg>
                </button>
            </div>
            <div class="mt-2 bg-primary post-footer p-3">
                <div>
                    <span class="c-fourth">11k views</span>
                    <span class="ml-1 c-fourth">10m ago</span>
                </div>
                <div class="d-flex c-fourth my-3">
                    <div class="information"><img src="/images/icons/post-percentage-up.svg" alt=""><span>100</span></div>
                    <div class="information"><img src="/images/icons/post-percentage-down-red.svg" alt=""><span class="c-fifth">100</span></div>
                    <div class="information" @click="showModalRegister"><img src="/images/icons/post-flame.svg" alt=""><span>100</span></div>
                    <div class="information"><img src="/images/icons/post-comment.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-up.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-down.svg" alt="">100</div>
                </div>
            </div>
            <comments :post="post" />
        </div>
        
    </section>
</template>

<script>
    import Comments from './comments/Comments'
    export default {
        props:['post'],
        components:{
            Comments
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
            // showModalPost(){
            //     $('#ModalPost').modal('show')
            // }
        }
    }
</script>
