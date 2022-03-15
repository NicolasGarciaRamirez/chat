<template>
    <div class="modal fade" role="dialog" id="AlertMaximumSize">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body c-fourth d-flex flex-column align-items-center justify-content-center p-4">
                    <h2 class='c-mustard font-weight-bold'>Whoa!!.. Tha\'s a big jam!</h2>
                    <br>
                    <p>
                        Please select <b class='text-white'>Link</b> upload instead of <b class='text-white'>Video</b> upload.<br>
                        Or choose upload a file with maximum size 200MB
                    </p>
                    <div class="text-center">
                        <button type="button" class="btn rounded-pill text-white bg-fifth" data-dismiss="modal">Got it!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AlertMaximumSize"
    }
</script>

<style scoped>

</style>
