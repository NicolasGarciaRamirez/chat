<template>
    <section class="post mt-3">
        <div class="post-head bg-primary p-2 d-md-flex align-items-start justify-content-between">
            <div class="d-flex justify-content-between align-items-center post-user-actions order-md-2">
                <button class="bg-primary">FOLLOW <img src="/images/icons/star.svg" class="icon c-fifth ml-1"></button>
                <button class="bg-primary border-danger">SUPPORT <img src="/images/icons/heart.svg" class="ml-1"></button>
                <button class="bg-primary border-danger">REWARD <img src="/images/icons/lightning.svg" class="ml-1"></button>
                <a href="#"><i class="fas fa-ellipsis-h c-third fa-2x"></i></a>
            </div>
            <div class="d-flex align-items-start">
                <img src="/images/profile.jpg" alt="" class="post-user-image rounded-pill">
                <div class="d-flex flex-column pl-md-2">
                    <a href="/Profile/View/Profile/Releases" class="text-white post-user-name">Jhonathan Holland <img src="/images/icons/check.svg" alt="" class="check-icon"></a>
                    <div class="d-flex justify-content-center align-items-center post-user-type">
                        <button class="btn bg-fifth text-white mr-2">MIXING ENGENIERY</button>
                        <button class="btn bg-white c-fifth d-flex align-items-center justify-content-center">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="post-body bg-primary">
            <div class="text p-2">
                This is how I do my mixes. Tell me what you think Also I have rewired the xlr cables in a way that is <span class="c-fifth">#mixingengineer</span> <span class="c-fifth">#m</span>... See More..
            </div>
            <div class="d-flex flex-column mt-1 content">
                <img src="/images/portada.jpg" alt="img-post">
            </div>
            <div class="mt-2 bg-primary post-footer p-2">
                <div>
                    <span class="c-fourth">11k views</span>
                    <span class="ml-1 c-fourth">10m ago</span>
                </div>
                <div class="d-flex c-fourth my-3">
                    <div class="information"><img src="/images/icons/post-percentage-up.svg" alt=""><span>100</span></div>
                    <div class="information"><img src="/images/icons/post-percentage-down-red.svg" alt=""><span class="c-fifth">100</span></div>
                    <div class="information"><img src="/images/icons/post-flame.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-comment.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-up.svg" alt="">100</div>
                    <div class="information"><img src="/images/icons/post-down.svg" alt="">100</div>
                </div>
            </div>
        </div>
        <comments />
    </section>
</template>

<script>
    import Comments from './comments/Comments'
    export default {
        components:{
            Comments
        }
    }
</script>
