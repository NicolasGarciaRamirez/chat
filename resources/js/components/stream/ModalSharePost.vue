<template>
    <div class="modal fade modal-reward" tabindex="-1" role="dialog" aria-labelledby="ModalShare" aria-hidden="true" id="ModalShare">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4">
                    <div class="d-flex flex-row">
                        <a class="text-white mx-3" :href="`https://twitter.com/share?url=/localhost:8000/${post.user.username}/Post/get/${post.token}&text=${post.description}`">
                            Twitter
                        </a>
                        <a class="text-white" :href="`http://www.facebook.com/share.php?u=/localhost:8000/${post.user.username}/Post/get/${post.token}&title=${post.description}`">
                            Facebook
                        </a>
                    </div>
                    <input type="text" :value="`/localhost:8000/${post.user.username}/Post/get/${post.token}`" class="mt-3 form-control">
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