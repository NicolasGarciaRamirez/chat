<template>
    <section>
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalAlert" aria-hidden="true" id="ModalAlert">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center justify-content-center p-2">
                        <div class="d-flex flex-column text-white">
                            <h5 class="font-weight-bold"></h5>
                            <p class="my-3">
                                You need to choose a Profile Title and Type if you would like to post your content! You have been redirected to your profile page so you can do so.
                            </p>
                            <div class="d-flex flex-row justify-content-end mb-2">
                                <button class="btn rounded-pill font-weight-bold text-white bg-primary mx-2" data-dismiss="modal">Cancel</button>
                                <button class="btn rounded-pill font-weight-bold text-white bg-fifth" data-dismiss="modal" @click="$parent.accept_redirect">Ok</button>
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
    props:['options'],
}
</script>

<style>

</style>
