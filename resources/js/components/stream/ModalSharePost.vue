<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalShare" aria-hidden="true" id="ModalShare" ref="ModalShare">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h5 class="font-weight-bold pl-4">Share Post</h5>
                <div class="p-3" v-if="post">
                    <div class="d-flex flex-row align-items-center">
                        <a class="text-white" target="_blank" :href="`https://twitter.com/intent/tweet?url=https://www.noisesharks.com/${post.user.username}/Post/get/${post.token}`">
                            <div class="rounded-circle bg-third m-2 p-3 share-circle">
                                <img src="/images/icons/twitter-white.svg" width="30rem">
                            </div>
                        </a>
                        <a class="text-white"  target="_blank" :href="`http://www.facebook.com/sharer.php?u=https://www.noisesharks.com/${post.user.username}/Post/get/${post.token}`">
                            <div class="rounded-circle bg-third m-3 p-3 share-circle">
                                <img src="/images/icons/facebook-white.svg" width="30rem">
                            </div>
                        </a>
                    </div>
                    <div class="d-flex flex-row justify-content-start c-fourth">
                        <span class="mx-3">Twitter</span>
                        <span class="mx-3">Facebook</span>
                    </div>
<!--                    https://plus.google.com/share?url=//www.noisesharks.com/${post.user.username}/Post/get/${post.token}-->
<!--                    https://www.linkedin.com/shareArticle?mini=true&url=//www.noisesharks.com/${post.user.username}/Post/get/${post.token}-->
                    <div class="d-flex flex-row align-items-end">
                        <input type="text" :value="`https://www.noisesharks.com/${post.user.username}/Post/get/${post.token}`" class="mt-3 form-control w-50 c-fourth">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from '../../helpers/Auth'
export default {
    props:['post']
}
</script>
