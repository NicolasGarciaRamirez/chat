<template>
    <section class="" ref="myCredit">
        <div class="modal fade pr-0" z-index="1050" role="dialog" aria-labelledby="myCredit" aria-hidden="true" id="myCredit">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content modal-border-white p-3 mx-auto" style="max-width: 650px;">
                    <div class="modal-header border-0">
                        <div class="w-100 text-center">
                            <button type="button" class="close p-0" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                <h3 style="font-size: 1rem;"><b>My Credit</b></h3>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body p-1">
                        <div>
                            <div class="text-center mb-3">
                                <!-- style="color: #49FB66" -->
                                <h1 style="font-size: 2rem; color: #49FB66" class="font-weight-bold mb-4 mt-3">${{user.credit}}</h1>
                                This credit can only be used by contributors. <br>
                                This credit will be deducted from the 15% that Noisesharks take.
                            </div>

                            <div class="divider"> </div>

                            <div class="text-center bg-third-secondary p-3 border-radius">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <span>Lifetime credit</span>
                                        <span>$0</span>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <span>Used credit total</span>
                                        <span>- $0</span>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <span><b>Current availible credit</b></span>
                                        <span>$0</span>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-sm btn-red rounded-pill" v-on:click.prevent="showModal()">Get More Credit!</a>
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
        props:['user'],
        methods:{
            showModal(){

                $("#myCredit").modal("hide");
                $("#getMoreCredit").modal("show");
            }
            // Badge downloaded successfully!
        }
    }
</script>
