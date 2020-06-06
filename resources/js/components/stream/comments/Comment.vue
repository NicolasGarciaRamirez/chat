<template>
    <div class="d-flex align-items-center p-3 w-100">
        <img :src="`${comment.user.avatar}`" alt="img-user-comment" class="comment-user-image rounded-pill mr-2">
        <div class="w-100">
            <div class="text-white d-flex align-items-center justify-content-between">
                <div>
                    <span class="font-weight-bold">{{ comment.user.personal_information.full_name }}</span>
                    <span class="ml-2">{{ comment.body }}</span>
                </div>
                <img src="/images/icons/post-flame.svg" alt="flame-red" class="icon float-right">
            </div>
            <div class="comment-footer">
                <span>{{ comment.time_ago }}</span>
                <span class="mx-3">1 Lit</span>
                <span @click="$parent.form_reply = true" class="cursor-pointer">Reply</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['comment'],
    }
</script>
