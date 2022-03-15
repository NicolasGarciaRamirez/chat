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
                            <a :href="`/View/Profile/Releases/${post.user.id}`" class="text-white post-user-name">
                                {{ post.user.personal_information.full_name }} 
                                <img src="/images/icons/check.svg" alt="" class="check-icon" width="18">
                                <svg class="icon-check d-none" style="transform: translateY(-2px)" version="1.1" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve"> <path fill="#FFC34D" d="M4,11.5l1-4.8C5,6.2,5.7,6,6.1,6.5l2.8,3.8c0.4,0.6-0.1,0.7-2,3C4.5,12,3.8,12.3,4,11.5L4,11.5z"/> <path fill="#FFC34D" d="M17.1,13.2c-1.9-2.2-2.5-2.4-2-3l2.8-3.8c0.3-0.4,1-0.3,1.1,0.3l1,4.8C20.2,12.3,19.4,12.1,17.1,13.2z"/> <path fill="#FFEA80" d="M22,8.9l-4.6,3.4l-4.8-8.4c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-4.8,8.4L2,8.9 C1.5,8.5,0.9,9,1,9.6l1.8,6.9l1.2,0.7l-0.8,0.6l0.5,2.1c0.1,0.3,0.3,0.5,0.6,0.5h15.5c0.3,0,0.6-0.2,0.6-0.5l0.5-2.1l-0.5-0.6 l0.8-0.6L23,9.6C23.1,9,22.5,8.5,22,8.9L22,8.9z"/> <path fill="#FFEA80" d="M23,9.6l-1.8,6.9l-0.8,0.6l0.5,0.6l-0.5,2.1c-0.1,0.3-0.3,0.5-0.6,0.5H12V3.6c0.2,0,0.4,0.1,0.6,0.3 l4.8,8.4L22,8.9C22.5,8.5,23.1,9,23,9.6L23,9.6z"/> <path fill="#FF6A4D" d="M14.5,13.6l-1.9-3.2c-0.1-0.2-0.3-0.3-0.6-0.3c-0.2,0-0.4,0.1-0.6,0.3l-1.9,3.2c-0.1,0.2-0.1,0.5,0,0.7 l1.9,3.2c0.1,0.2,0.3,0.3,0.6,0.3c0.2,0,0.4-0.1,0.6-0.3l1.9-3.2C14.6,14.1,14.6,13.8,14.5,13.6z"/> <path fill="#FF6A4D" d="M14.5,14.3l-1.9,3.2c-0.1,0.2-0.3,0.3-0.6,0.3v-7.7c0.2,0,0.4,0.1,0.6,0.3l1.9,3.2 C14.6,13.8,14.6,14.1,14.5,14.3z"/> <path fill="#FFC34D" d="M7.5,17.2c0,0.4-0.3,0.6-0.6,0.6H3.1l-0.3-1.3h4.1C7.2,16.5,7.5,16.8,7.5,17.2z"/> <path fill="#FFC34D" d="M21.2,16.5l-0.3,1.3h-3.7c-0.4,0-0.6-0.3-0.6-0.6c0-0.4,0.3-0.6,0.6-0.6H21.2z"/> </svg>
                            </a>
                        </div>
                        <div class="post-body bg-primary">
                            <div class="text p-2">
                                {{ post.description }} <span class="c-fifth">#mixingengineer</span> <span class="c-fifth">#m</span>... Show more..
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
import Comments from "../../Comments/Views/Comments";
export default {
    props:['post'],
    components:{
        Comments
    }
}
</script>
