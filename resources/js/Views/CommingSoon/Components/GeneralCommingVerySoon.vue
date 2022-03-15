<template>
    <section>
        <div class="modal fade modal-contributor" z-index="-1000" role="dialog" aria-labelledby="ModalGeneralCommingVerySoon" aria-hidden="true" id="ModalGeneralCommingVerySoon">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column text-center justify-content-center align-items-center p-1">
                        <h4 class="font-weight-bold text-white">COMING SOON!</h4>
                        <div class="d-flex flex-column text-center justify-content-center my-2 ">
                            <p>
                                This exciting 0% will be available by the of November 2021! <br>
                                Please choose the 15% plan for now and you can switch to the 0% later!
                            </p>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn rounded-pill font-weight-bold text-white bg-fifth my-2" data-dismiss="modal">Got It</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "GeneralCommingSoon"
    }
</script>
