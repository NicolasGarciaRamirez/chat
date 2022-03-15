<template>
    <div class="modal fade modal-contributor-form" role="dialog" id="ModalPayment">
        <div class="modal-dialog modal-dialog-centered  modal-md" role="document">
            <div class="modal-content ">
                <div class="modal-body p-1">
                    <div class="d-flex flex-row justify-content-between contributor-form">
                        <div class="d-flex flex-column p-4">
                            <div class="d-flex flex-column p-1">
                                <summary-subscription :user="null" :type="type" :summary="summary" ref="SummarySubscription"></summary-subscription>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Auth from "../../../helpers/Auth";
    import SummarySubscription from "../Components/SummarySubscription";

    export default {
        name: "ModalPayment",
        components: {SummarySubscription},
        props:['type'],
        computed:{
            summary(){
                return {
                    amount: this.type === 'Percentage' ? 10 : 3
                }
            }
        }
    }
</script>
