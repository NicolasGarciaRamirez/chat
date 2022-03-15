<template>
    <section class="" ref="CreditFirstPost">
        <div class="modal fade" z-index="1050" role="dialog" aria-labelledby="getMoreCredit" aria-hidden="true" id="CreditFirstPost">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content modal-border-white  p-3">
                    <div class="modal-header border-0">
                        <div class="w-100 text-center">
                            <button type="button" class="close p-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                <h3><b>Get More Credit!</b></h3>
                                <p>Only contributors can use credits </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body p-1">
                        <public-post-desktop class="d-none d-lg-block"></public-post-desktop>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import PublicPostDesktop from "../../../../Home/post/PublicPostDesktop";
    export default {
        components:{
            PublicPostDesktop
        }
    }
</script>
