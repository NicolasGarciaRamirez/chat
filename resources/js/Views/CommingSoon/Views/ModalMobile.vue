<template>
    <section>
        <div class="modal fade modal-contributor" z-index="-1000" role="dialog" aria-labelledby="ModalMobile" aria-hidden="true" id="ModalMobile">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content modal-border-white">
                    <div class="modal-header border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body d-flex flex-column text-center justify-content-center align-items-center p-1">
                        <h2 class="font-weight-bold text-white">MOBILE SITE NOTICE</h2>
                        <div class="d-flex flex-column c-fourth text-center justify-content-center my-2 ">
                            <p>
                                We are still working on the apparence <br>
                                of our mobile version.<br>
                                <span class="font-weight-bold">
                                    You can procced but please expect <br>
                                    many appearance issues
                                </span>
                            </p>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn rounded-pill font-weight-bold text-white bg-fifth mb-4" data-dismiss="modal">Procced, But Expect Issues</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "ModalMobile"
    }
</script>
