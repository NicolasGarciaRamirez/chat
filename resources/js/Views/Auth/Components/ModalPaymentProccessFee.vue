<template>
    <div class="modal fade " tabindex="-1" role="dialog" aria-hidden="true" id="ModalPaymentProccessFee">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0 p-1">
                    <div class="d-flex  flex-row justify-content-center w-100 my-2">
                        <h3 class="font-weight-bold m-0">Payment Processing Fee</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="py-2 px-4">
                        <div class="d-flex justify-content-center text-center mb-2">
                            "Payment Processing Fee" is the fee that our payment provider charges to facilitate the transactions for our percentage mode contributors
                        </div>
                        <div class="d-flex flex-column my-2">
                            <h5 class="my-3">For US Bank Cards ($/USD): <b>2.9%</b> <small><b>+ 30¢</b></small></h5>
                            <h5 class="my-3">For European Cards (€/EUR): <b>1.4%</b> <small><b>+ 0.5€</b></small></h5>
                            <h5 class="my-3">For Non-European Cards (OTHER): <b>2.9%</b> <small><b>+ 0.25€</b></small></h5>
                        </div>
                        <div class="text-center my-3 w-100">
                            <button class="btn rounded-pill bg-fifth text-white font-weight-bold w-50" data-dismiss="modal">GOT IT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalPaymentProccessFee"
    }
</script>
