<template>
    <div class="modal fade modal-reward" tabindex="-1" role="dialog" aria-labelledby="ModalReward" aria-hidden="true" id="modalReward">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-border-white">
                <div class="modal-header border-0 p-0">
                    <img src="/images/portada.jpg" class="img-fluid support-brand-header ">
                    <div class="head-content d-flex">
                        <img src="/images/profile.jpg" alt="" class="support-img-profile rounded-pill">
                        <div class="d-flex flex-column p-md-3">
                            <a href="/View/Profile/Releases" class="text-white support-user-name">Jhonathan Holland <img src="/images/icons/check.svg" alt="" class="check-icon"></a>
                            <div class="d-flex flex-row justify-content-center align-items-center support-user-type">
                                <button class="btn bg-fifth text-white mr-2">MIXING ENGENIERY</button>
                                <button class="btn bg-white c-fifth d-flex align-items-center justify-content-center">CONTRIBUTOR <img src="/images/icons/music-red.svg" alt="icon-music-red" class="icon"></button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4">
                    <div class="d-flex flex-column text-center align-items-center">
                        <h4 class="font-weigh-bold">Reward A One-off Donation</h4><br>
                        <p class="my-4">
                            By entering an amount below below, you will directly reward  Jonathon Holland  ﬁnancially
                            with a one-off donation. This amount is for this single time only and it doesn’t auto-renew.
                            Noisesharks DOES NOT take any cut from this support.
                        </p> 
                        <div class="divider my-4"></div>
                        <h4 class="font-weigh-bold">Why Support Channel?</h4><br>
                        <p class="my-4">I help msuic enthusiasts to ﬁnd ﬁnancial settelment or growth</p>
                        <div class="divider my-4"></div>
                        <h4 class="font-weigh-bold">Enter Desired One-off Reward Amount </h4>
                        <div class="input-amount my-5">
                            <input  placeholder="0.00" class="c-fifth form-control">
                        </div>
                        <button class="btn bg-fifth rounded-pill text-white font-weigh-bold w-25">CONTINUE</button>
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