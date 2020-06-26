<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalContributor" :data-backdrop="'none'" aria-hidden="true" id="ModalContributor">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex flex-column text-center justify-content-center p-5">
                    <h2 class="font-weight-bold text-white my-2">COMING VERY SOON!</h2>
                    <img class="my-2" src="/images/commingsoon/contributor.svg" alt="">
                    <div class="d-flex flex-column text-center justify-content-center my-2">
                        <p>
                            Very Soon, you will be able to become a Noisesharks Contributor.
                            Contributors will unlock the Support & Reward buttons for their profiles which
                            users can use to support them financially!
                        </p><br>
                        <p>
                            Click below to get notified when we launch this feature.
                        </p>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn rounded-pill text-white bg-fifth w-25">Notify Me</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>