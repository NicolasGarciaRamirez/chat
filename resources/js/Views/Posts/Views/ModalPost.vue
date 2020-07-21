<template>
  <div class="modal fade post modal-post" tabindex="-1" role="dialog" aria-labelledby="ModalPost" aria-hidden="true" id="ModalPost">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="transform: translate(69pc)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="d-flex flex-row">
                    <div class="d-flex align-items-start flex-column p-3 mt-3">
                        <div class="d-flex justify-content-start align-items-center post-user-actions ">
                            <img :src="`${ post.user.avatar }`" alt="" class="post-user-image rounded-pill" width="50">
                            <a :href="`/View/Profile/Releases/${post.user.id}`" class="text-white post-user-name">{{ post.user.personal_information.full_name }} <img src="/images/icons/check.svg" alt="" class="check-icon" width="18"></a>
                        </div>
                        <div class="post-body bg-primary">
                            <div class="text p-2">
                                {{ post.description }} <span class="c-fifth">#mixingengineer</span> <span class="c-fifth">#m</span>... See More..
                            </div>
                            <comments :post="post" />
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <img :src="`${ post.image }`" width="820" height="720" alt="img-post"  class="img-fluid cursor-point">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Comments from "../../Comments/Components/Comments";
export default {
    props:['post'],
    components:{
        Comments
    }
}
</script>
