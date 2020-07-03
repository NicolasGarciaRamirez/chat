<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalSureDelete" aria-hidden="true" id="ModalSureDelete">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center justify-content-center p-2">
                        <div class="d-flex flex-column">
                            <h5 class="font-weight-bold">Delete Post</h5>
                            <p class="my-3">
                                You are about to delete this post, would like to proceed?
                            </p>
                            <div class="d-flex flex-row justify-content-end mb-2">
                                <button class="btn rounded-pill font-weight-bold text-white bg-primary mx-2" data-dismiss="modal">Cancel</button>
                                <button class="btn rounded-pill font-weight-bold text-white bg-fifth" data-dismiss="modal" @click="$parent.deletePost">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {

}
</script>

<style>

</style>